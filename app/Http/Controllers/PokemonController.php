<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    public function insertPokemoncsv(Request $request){

    }

    public function displayPokemon(Request $request){
        $pokemon = Pokemon::all();

        return response()->json(['pokemon' => $pokemon], 200);

    }

}
