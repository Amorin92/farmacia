<?php

namespace App\Http\Controllers;

use App\Models\Transportadora;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TransportadoraController extends Controller
{
    public function index()
    {
        $transportadoras = Transportadora::all();

        return view('index', compact('transportadoras'));
    }

    function novo() {
        $transportadora = new Transportadora();
        $transportadora->id = 0;
        $tipos = Tipo::orderBy('nome')->get();

        return view('frmTransportadora', compact('transportadora', 'tipos'));
      }

      function salvarOld(Request $request) {
        $validated = $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'endereco' => 'required',

            'tipos_id' => 'required|exists:tipos,id',
            ]);

        if ($request->input('id') == 0) {
          $transportadora = new Transportadora();
        } else {
          $transportadora = Transportadora::find($request->input('id'));
        }
        $transportadora->nome = $request->input('nome');
        $transportadora->cnpj = $request->input('cnpj');
        $transportadora->endereco = $request->input('endereco');
        $transportadora->tipos_id = $request->input('tipos_id');

        $transportadora->save();
        return redirect('transportadora/listar');
      }

    public function store(Request $request)
    {
        if ($request->input('id') == 0) {
            $transportadora = new Transportadora();
          } else {
            $transportadora = Transportadora::find($request->input('id'));
          }

        $transportadora->nome = $request->input('nome');
        $transportadora->cnpj = $request->input('cnpj');
        $transportadora->endereco = $request->input('endereco');
        $transportadora->tipos_id = $request->input('tipos_id');
        $transportadora->save();

        if ($request->input('id') == 0) {
            return redirect('transportadora/listar')->with(['msg' => "Transportadora '$transportadora->nome' salvo com sucesso!"]);
        } else {
            return redirect('transportadora/listar')->with(['msg' => "Transportadora '$transportadora->nome' alterado com sucesso!"]);
        }
    }

    function listar() {
        $transportadoras = Transportadora::orderByRaw('nome, id')->paginate(5);
        return view('listagemTransportadora',
                    compact('transportadoras'));
       }

    public function edit($id)
    {
        $transportadora = Transportadora::find($id);
        $tipos = Tipo::orderBy('id')->get();
        return view('frmTransportadora', compact('transportadora', 'tipos'));
    }

    public function destroy($id)
    {
        $transportadora = Transportadora::findOrFail($id);
        $transportadora->delete();

        /* return redirect('transportadora/listar'); */
        return redirect('transportadora/listar')->with('success', 'Transportadora excluída com sucesso');
    }
}
