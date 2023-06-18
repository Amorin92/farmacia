<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;
use App\Models\Laboratorio;
use App\Models\Transportadora;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MedicamentoRequest;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::orderBy('nome')->paginate(10);

    return view('\index', compact('medicamentos'));
    }

    function novo() {
        $medicamento = new Medicamento();
        $medicamento->id = 0;
        $medicamento->lote = 0;
        $medicamento->data_validade = now();
        $medicamento->data_fabricacao = now();
        $medicamento->valor = 0;
        $medicamento->quantidade = 0;
        $laboratorios = Laboratorio::orderBy('id')->get();
        $transportadoras = Transportadora::orderBy('id')->get();

        return view('frmMedicamento', compact('medicamento', 'laboratorios', 'transportadoras'));
      }

      function salvarOld(Request $request) {
        $validated = $request->validate([
            'nome' => 'required',
            'lote' => 'required',
            'data_validade' => 'required',
            'data_fabricacao' => 'required',
            'valor' => 'required',
            'quantidade' => 'required',

            'laboratorios_id' => 'required|exists:laboratorios,id',
            'transportadoras_id' => 'required|exists:transportadoras,id',
            ]);

        if ($request->input('id') == 0) {
          $medicamento = new Medicamento();
        } else {
          $medicamento = Medicamento::find($request->input('id'));
        }
        $medicamento->nome = $request->input('nome');
        $medicamento->lote = $request->input('lote');
        $medicamento->laboratorios_id = $request->input('laboratorios_id');
        $medicamento->data = $request->input('data_validade');
        $medicamento->data = $request->input('data_fabricacao');
        $medicamento->transportadoras_id = $request->input('transportadoras_id');

        $medicamento->save();
        return redirect('medicamento/listar');
      }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'lote' => 'required',
            'laboratorio_id' => 'required',
            'data_validade' => 'required',
            'data_fabricacao' => 'required',
            'transportadoras_id' => 'required',
            'valor' => 'required|numeric|min:0.01',
            'quantidade' => 'required',
        ]);

        if ($request->input('id') == 0) {
            $medicamento = new Medicamento();
          } else {
            $medicamento = Medicamento::find($request->input('id'));
          }

          if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');
            $upload = $file->store('public/imagens');
            $upload = explode("/", $upload);
            $tamanho = sizeof($upload);
            if ($medicamento->imagem != "") {
                Storage::delete("public/imagens/".$medicamento->imagem);
            }
            $medicamento->imagem = $upload[$tamanho-1];
        } else {
            // Define uma foto genérica caso nenhum arquivo seja enviado
            $medicamento->imagem = 'foto_generica.jpg';
        }
        $medicamento->nome = $request->input('nome');
        $medicamento->lote = $request->input('lote');
        $medicamento->laboratorios_id = $request->input('laboratorio_id');
        $medicamento->data_validade = $request->input('data_validade');
        $medicamento->data_fabricacao = $request->input('data_fabricacao');
        $medicamento->transportadoras_id = $request->input('transportadoras_id');
        $medicamento->valor = $request->input('valor');
        $medicamento->quantidade = $request->input('quantidade');
        $medicamento->save();

        if ($request->input('id') == 0) {
            return redirect('medicamento/listar')->with(['msg' => "Medicamento '$medicamento->nome' salvo com sucesso!"]);
        } else {
            return redirect('medicamento/listar')->with(['msg' => "Medicamento '$medicamento->nome' alterado com sucesso!"]);
        }
    }

    function listar() {
        $medicamentos = Medicamento::orderByRaw('nome, id')->paginate(10);
        return view('listagemMedicamento',
                    compact('medicamentos'));
       }

       public function listarTudo()
{
    $medicamentos = Medicamento::orderByRaw('nome, id')->paginate(10);
    return view('listagemCompletaMedicamento',
                    compact('medicamentos'));
}

    public function edit($id)
    {
        $medicamento = Medicamento::find($id);
        $laboratorios = Laboratorio::orderBy('nome')->get();
        $transportadoras = Transportadora::orderBy('nome')->get();
        return view('frmMedicamento', compact('medicamento', 'laboratorios' ,'transportadoras'));
    }

    public function busca(Request $request)
    {
        $termo = $request->input('termo');

        // Converte o termo para minúsculas
        $termo = strtolower($termo);

        $medicamentos = Medicamento::where(function ($query) use ($termo) {
            $query->whereRaw('LOWER(nome) LIKE ?', ['%' . $termo . '%'])
                ->orWhereHas('laboratorios', function ($query) use ($termo) {
                    $query->whereRaw('LOWER(nome) LIKE ?', ['%' . $termo . '%']);
                });
        })->orderBy('nome')->paginate(10);

        return view('medicamentoBusca', compact('medicamentos'));
    }

    public function detalhes($id)
{
    $medicamento = Medicamento::findOrFail($id);
    $laboratorios = Laboratorio::orderBy('nome')->get();
    $transportadoras = Transportadora::orderBy('nome')->get();

    return view('detalheMedicamento', compact('medicamento', 'laboratorios' ,'transportadoras'));

}

function relatorio() {
    $medicamentos = Medicamento::orderBy('nome')->get();
    $pdf = Pdf::loadView('relatorioMedicamento', compact('medicamentos'));
    return $pdf->download('medicamentos.pdf');
  }


    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();

        return redirect('medicamento/listar');
    }
}
