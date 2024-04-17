<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';

    protected $fillable = [
        'naam' => 'required|max:255',
        'beschrijving' => 'required',
        'prijs' => 'required|numeric',
        'afbeelding' => 'sometimes|image|max:1024',
        'categorie' => 'required',
    ];
}
