<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'nombre',
    ];


    public function users(){
        return $this->hasMany(User::class);
    }
}
