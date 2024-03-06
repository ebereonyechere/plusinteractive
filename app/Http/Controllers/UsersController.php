<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', User::class)) {
            abort(403);
        }

        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', User::class)) {
            abort(403);
        }

        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        // Assign roles to the user
        foreach ($request->safe()->only('roles')['roles'] as $id) {
            DB::table('role_user')->insert(['role_id' => $id, 'user_id' => $user->id]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user)
    {
        if ($request->user()->cannot('create', $user)) {
            abort(403);
        }

        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        // Delete previously assigned roles
        foreach ($user->roles as $role) {
            DB::table('role_user')->where('role_id', $role->id)->where('user_id', $user->id)->delete();
        }

        // Assign roles to the user
        foreach ($request->safe()->only('roles')['roles'] as $id) {
            DB::table('role_user')->insert(['role_id' => $id, 'user_id' => $user->id]);
        }

        return redirect()->route('users.index');
    }
}
