<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index() {
        $programs = Program::limit(4)->get();
        return view('homepage.index', ['programs' => $programs]);
    }

    public function program(int $id) {
        $program = Program::findOrFail($id);
        return view('homepage.program', ['program' => $program]);
    }
}
