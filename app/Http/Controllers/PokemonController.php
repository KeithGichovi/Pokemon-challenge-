<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    // public function insertPokemoncsv(Request $request){

    //     $file_path = $request->file('pokemon_csv')->getRealPath();

    //     $pokemon_data = array_map('str_getcsv', file($file_path));

    //     $pokemon_data = array_slice($pokemon_data, 1);

    //     foreach($pokemon_data as $data){
    //         Pokemon::create([
    //             'name' => $data[1],
    //             'type1' => $data[2],
    //             'type2' => $data[3],
    //             'HP' => $data[4],
    //             'Attack' => $data[5],
    //             'Defense' => $data[6],
    //             'Speed' => $data[7],
    //             'Special_attack' => $data[8],
    //             'gif_link' => $data[9],
    //             'png_link' => $data[10],
    //             'description' => $data[11],
    //         ]);
    //     }

    // }

    public function insertPokemoncsv(Request $request) {
        try {
            $file = $request->file('pokemon_csv');
    
            if (!$file) {
                return response()->json(['message' => 'No file uploaded'], 400);
            }
    
            $file_path = $file->getRealPath();
            $pokemon_data = array_map('str_getcsv', file($file_path));
    
            // Remove the header row
            $header = array_shift($pokemon_data);
    
            foreach ($pokemon_data as $data) {
                // Data validation and sanitization
                $name = $data[1];
                $type1 = $data[2];
                $type2 = $data[3];
                $HP = isset($data[4]) ? (int)$data[4] : null;
                $Attack = isset($data[5]) ? (int)$data[5] : null;
                $Defense = isset($data[6]) ? (int)$data[6] : null;
                $Speed = isset($data[7]) ? (int)$data[7] : null;
                $Special_attack = isset($data[8]) ? (int)$data[8] : null;
                $gif_link = $data[9] ?: null;
                $png_link = $data[10] ?: null;
                $description = $data[11] ?: null;
    
                Pokemon::create([
                    'name' => $name,
                    'type1' => $type1,
                    'type2' => $type2,
                    'HP' => $HP,
                    'Attack' => $Attack,
                    'Defense' => $Defense,
                    'Speed' => $Speed,
                    'Special_attack' => $Special_attack,
                    'gif_link' => $gif_link,
                    'png_link' => $png_link,
                    'description' => $description,
                ]);
            }
    
            return response()->json(['message' => 'Pokemon data uploaded successfully'], 200);
    
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    
    public function displayPokemon() {
        $pokemon = Pokemon::all();
        return response()->json($pokemon, 200);
    }

    public function specificPokemon (Request $request, $id) {
        $pokemon = Pokemon::find($id);
        
        if (!$pokemon) {
            return response()->json(['message' => 'Pokemon not found'], 404);
        }
        return response()->json($pokemon, 200);

    }

}
