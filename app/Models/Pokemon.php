<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type1',
        'type2',
        'HP',
        'Attack',
        'Defense',
        'Speed',
        'Special_attack',
        'gif_link',
        'png_link',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];



}
