<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program; // Import the Program model

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function editPrograms()
    {
        $programs = Program::all(); 

        return view('admin.edit-programs', compact('programs'));
    }

    public function recommendPrograms()
    {
        return view('admin.recommend-programs');
    }

    public function manageMembers()
    {
        return view('admin.manage-members');
    }
}
