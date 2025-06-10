<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;
use App\Models\Country;
use App\Models\Team;

class ManagerController extends Controller
{

    public function create()
    {
        if(Auth::user()->manager){
         return redirect()->route('manager.show')->with('info','You are already a manager');
        }

        $countries = Country::all();

        return view('manager.create', compact('countries'));

    }


    public function store(Request $request)
    {

        $validatedInfo = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'sur_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'country_id' => 'required|exists:countries,id',
        ]);

            $manager = Auth::user()->manager()->create([
            'first_name' => $validatedInfo['first_name'],
            'middle_names' => $validatedInfo['middle_names'],
            'sur_name' => $validatedInfo['sur_name'],
            'date_of_birth' => $validatedInfo['date_of_birth'],
            'height' => $validatedInfo['height'],
            'weight' => $validatedInfo['weight'],
            'country_id' => $validatedInfo['country_id'],
            'weekly_wage' => 500,
            'contract_end_date' => now()->addYears(3)->format('Y-m-d')
        ]);

        return redirect()->route('manager.show')->with('info' ,'You are now a manager');
    }

    public function show()
    {

        $manager = Auth::user()->manager;
        return view('manager.show', compact('manager'));

    }
    public function choose_team()
    {

        $manager = Auth::user()->manager;
        $teams = Team::all();
        return view('manager.choose_team', compact('teams'));

    }
    public function assign_team(Request $request)
    {

         $user = Auth::user();

        if (!$user->manager || $user->manager->team) {
            return redirect()->route('manager.show')->with('warning', 'Invalid request: Manager not found or already assigned to a team.');
        }

        $validated = $request->validate([
            'team_id' => [
                'required',
                'exists:teams,id',

            ],
        ]);

        $manager = $user->manager;
        $manager->team_id = $validated['team_id'];
        $team_name = Team::find($validated['team_id'])->name;
        $manager->save();

        return redirect()->route('manager.show')->with('info', "You are the manager of $team_name");


    }


}
