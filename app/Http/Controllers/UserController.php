<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
     *
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
}
