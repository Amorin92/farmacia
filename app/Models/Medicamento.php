<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public function laboratorios()
    {
        return $this->belongsTo(Laboratorio::class);
    }

    public function transportadoras()
    {
        return $this->belongsTo(Transportadora::class);
    }
}
