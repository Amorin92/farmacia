<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportadora extends Model
{

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }


    public function tipos()
    {
        return $this->belongsTo(Tipo::class);
    }
}
