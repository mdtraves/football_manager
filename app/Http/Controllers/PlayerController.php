<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function index(){
        $players = Player::all()->sortByDesc('overall_rating');
        return view('players.index', compact('players'));
    }
    public function show(Request $request){
        $player = Player::where('id', request('id'))->get();
        return view('players.show', compact('player'));
    }
}
