<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DocumentTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Commands\Show;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class TemplateController extends Controller
{
    public function index() {
        $dataTemp = DocumentTemplate::latest()->get();
        return view('dashboard.temp.index', compact('dataTemp'));
    }
    public function create(){
        return view('dashboard.temp.addtemp');
    }
    public function detail(string $id){
        $dataTemp = DocumentTemplate::find($id);
        return view('dashboard.temp.detail', compact('dataTemp'));
    }
    public function edit($id)
    {
        $dataTemp = DocumentTemplate::findOrFail($id);
        $updatedBy = $dataTemp->updatedBy;
        return view('dashboard.temp.edit', compact('dataTemp', 'updatedBy'));
    }

    public function update(Request $request, $id)
    {
        $dataTemp = DocumentTemplate::find($id);
        $validatedData = $request->validate([
            'template_name' => 'required',
            'template_description' => 'required',
            'func' => 'required',
        ]);
        
        // Check if a file is uploaded
        if ($request->hasFile('tempdoc')) {
            $td = $request->file('tempdoc');
            $tempDoc = $td->getClientOriginalName();
    
           
            // Move the uploaded file to the appropriate directory
            $td->move(public_path() . '/tempdoc', $tempDoc);
    
            // Delete the old file if it exists
            if (!empty($dataTemp->template_file_name)) {
                // You should prepend the directory name to the path
                Storage::delete('tempdoc/' . $dataTemp->template_file_name);
            }
    
            // Update the template_file_name attribute
            $dataTemp->template_file_name = $tempDoc;
        }
    
        // Update other attributes and save the model
        $dataTemp->update($validatedData);
        $dataTemp->updated_at = Carbon::now();
    
        $dataTemp->save();
    
        return redirect()->route('templates')->with('success', 'Document Template updated successfully.');
    }



    public function store(Request $request) {
        // Check if a file was uploaded
        $file = $request->file('tempdoc');
        $tempDoc = $file->getClientOriginalName();
    
        // Find an existing template with the same name
        $existingTemplate = DocumentTemplate::where('template_name', $request->template_name)->first();
    
        if ($existingTemplate) {
            // If a template with the same name exists, increment the version by 1.0
            $version = $existingTemplate->version + 1.0;
        } else {
            // If it's a new template, start with version 1.0
            $version = 1.0;
        }
    
        // Create the new template
        $dtTemp = new DocumentTemplate();
        $dtTemp->template_name = $request->template_name;
        $dtTemp->version = $version;  // Set the version
        $dtTemp->template_description = $request->template_description;
        $dtTemp->func = $request->func;
        $dtTemp->template_file_name = $tempDoc;
        $dtTemp->created_at = Carbon::now();
        $dtTemp->updated_at = Carbon::now();
    
        /** @var App\Models\User $user */
        $user = Auth::user();
    
        $dtTemp->created_by = $user->id;
        $dtTemp->updated_by = $user->id;
        $dataTemp = DocumentTemplate::where('created_by', $user->id)->get();
        $dataTemp = DocumentTemplate::where('updated_by', $user->id)->get();
        $file->move(public_path() . '/tempdoc', $tempDoc);
    
        $dtTemp->save();
    
        return redirect()->route('templates');
    }
    
    

    public function destroy($id){   
        $dataTemp = DocumentTemplate::find($id);   
        if (!$dataTemp) {
            return redirect()->route('templates')->with('error', ' not found.');
        }  
        $dataTemp->delete();
        return redirect()->route('templates')->with('success', 'Document Template deleted successfully.');
}

}
