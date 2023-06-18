<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipo;

class TipoController extends Controller
{
    protected $table = 'tipos';

    public function store(Request $request)
    {
        $tipos = new Tipo();
        $tipos->nome = $request->nome;
        $tipos->save();
    }

    function create() {
        $tipos = new Tipo();
        $tipos->id = 0;
      }

      function novo() {
        $tipos = new Tipo();
        $tipos->id = 0;
      }

      function listar() {
        $tipos = Tipo::orderByRaw('nome, id')->paginate(10);
       }
}
