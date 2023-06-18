<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorio;

class LaboratorioController extends Controller
{
    public function index()
    {
        $laboratorio = Laboratorio::all();

        return view('index', compact('laboratorio'));
    }

    public function create()
    {
        return view('frmLaboratorio');
    }

    public function store(Request $request)
    {
        $laboratorio = new Laboratorio;
        $laboratorio->nome = $request->nome;
        $laboratorio->endereco = $request->endereco;
        $laboratorio->save();

        if ($request->input('id') == 0) {
            return redirect('laboratorio/listar')->with(['msg' => "Laboratório '$laboratorio->nome' salvo com sucesso!"]);
        } else {
            return redirect('laboratorio/listar')->with(['msg' => "Laboratório '$laboratorio->nome' alterado com sucesso!"]);
        }

    }

    public function listar()
    {
        $laboratorios = Laboratorio::orderByRaw('nome, id')->paginate(5);
        return view('listagemLaboratorio', compact('laboratorios'));
    }

    function novo() {
        $laboratorio = new Laboratorio();
        $laboratorio->id = 0;
        return view('frmLaboratorio', compact('laboratorio'));
      }

    public function edit($id)
    {
        $laboratorio = Laboratorio::findOrFail($id);

        return view('frmLaboratorio', compact('laboratorio'));
    }

    public function update(Request $request, $id)
    {
        $laboratorio = Laboratorio::findOrFail($id);
        $laboratorio->nome = $request->nome;
        $laboratorio->endereco = $request->endereco;
        $laboratorio->save();

        return redirect('/laboratorio');
    }

    public function destroy($id)
    {
        $laboratorio = Laboratorio::findOrFail($id);
        $laboratorio->delete();

        return redirect('laboratorio/listar')->with('success', 'Laboratório excluído com sucesso');
    }
}
