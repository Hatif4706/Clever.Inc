<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\DocumentTemplate as ModelsDocumentTemplate;

class CheckDocumentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $resourceId = $request->route('id'); // Assuming 'id' is the parameter name in your route

        // Retrieve the resource based on the 'id' parameter
        $resource = ModelsDocumentTemplate::find($resourceId);

        if ($resource && $resource->created_by === auth()->id()) {
            return $next($request);
        }

        return abort(403, 'You do not have permission to access this resource.');
        }
}
