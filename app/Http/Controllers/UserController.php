<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Import a lot of Users
     * @param Request $request
     */
    public function import(Request $request)
    {
        $request->validateWithBag('userImportation', [
            'file' => 'required|mimes:xlsx,xls|max:10240', // Adjust max file size as needed
        ]);

        Excel::import(new UsersImport(), $request->file('file'));

        return redirect()->route('user.index')->with('success', __('Users imported successfully!'));
    }

    /**
     * Download import user model file
     */
    public function downloadModel() 
    {
        $filePath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'UserImportModel.xlsx'); // Remplacez avec le chemin correct de votre fichier

        if (file_exists($filePath)) {
            return Response::download($filePath, 'UserImportModel.xlsx');
        } else {
            return redirect()->route('user.index')->with('error',  __("This file doesn't exist"));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make("P@ssW0rd123"),
        ]);
        $user->assignRole(Role::findOrFail($request->role));

        event(new Registered($user));

        return redirect()->route('user.index')->with(['success' => __('User created successfully!')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = Role::all();

        return view('users.show', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles(Role::findOrFail($request->role));
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return redirect()->route('user.index')->with(['success' => __('User updated successfully!')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user->delete()) {
            return redirect()->route('user.index')->with(['error' => __('A few things went wrong. Please try again later.')]);
        }

        return redirect()->route('user.index')->with(['success' => __('User deleted successfully!')]);
    }

}
