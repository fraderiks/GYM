<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program; // ⭐ Make sure to import your Program model

class HomepageController extends Controller
{
    /**
     * Display the homepage with dynamic exercise programs.
     */
    public function index()
    {
        // ⭐ Fetch all programs from the 'programs' table using the Program model
        $programs = Program::all();

        // ⭐ Pass the fetched programs to the 'homepage.index' view
        return view('homepage.index', compact('programs'));
    }

    /**
     * Display a single program (if you have individual program pages).
     */
    public function program($id)
    {
        // This is for a specific program page, not directly related to the homepage list.
        // You might fetch a single program here:
        // $program = Program::findOrFail($id);
        // return view('homepage.program', compact('program'));
        return view('homepage.program', ['id' => $id]);
    }
}
