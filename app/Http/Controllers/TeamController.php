<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
     public function index()
    {
        $teams = Team::all()->sortByDesc('overall_rating');
        return view('teams.index', compact('teams'));
    }
     public function show(string $id)
    {
        $team = Team::findOrFail($id);
        return view('teams.show', compact('team'));
    }
}
