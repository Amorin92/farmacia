<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }
}
