<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserRequest $request): View
    {
        $search = $request->search;
        $role = $request->role;
        $perPage = $request->perpage ?? 10;
        $order = $request->order ?? 'asc';
        $sort = $request->sort ?? 'created_at';

        $users = User::with('roles')
            ->whereHas('roles', function($q) use($role) {
                $role ? $q->where('name', $role) : $q;
            })
            ->where(function (Builder $query) use($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone_number', 'like', "%$search%");
            })
            ->orderBy($sort, $order)
            ->paginate($perPage)
            ->withQueryString();

        return view('dashboard.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_picture')) {
            $user['profile_picture'] = $request->file('profile_picture')
                ->store('public');
        }

        User::create($validated)->assignRole($validated['role']);

        return redirect()
            ->route('users.index')
            ->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('dashboard.users.detail', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('dashboard.users.edit', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // If the previous role was a Vendor shouldn't be able to change roles
        if ($user->hasRole('Vendor')) {
            unset($validated['role']);
        }

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')
                ->store('public');
        }

        $user->update($validated);
        $user->syncRoles($request->role);

        return redirect()->route('users.index')
            ->with('success', 'User edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        Storage::delete($user->profile_picture);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
