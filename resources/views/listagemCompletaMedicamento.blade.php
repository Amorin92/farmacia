@extends('template')

@section('conteudo')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif



  <h1>Listagem Completa dos Medicamentos</h1>
  <a href="listar" class="btn btn-primary">Voltar</a>
  <a href="relatorio" class="btn btn-primary">Relatório</a>
  <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Lote</th>
            <th>Laboratório</th>
            <th>Data de Validade</th>
            <th>Data de Fabricação</th>
            <th>Transportadora</th>
            <th>Valor</th>
            <th>Quantidade</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($medicamentos as $medicamento)
          <tr>
            <td>{{$medicamento->id}}</td>
            <td>
              @if ($medicamento->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$medicamento->imagem}}">
              @endif            </td>
            <td>{{$medicamento->nome}}</td>
            <td>{{$medicamento->lote}}</td>
            <td>{{$medicamento->laboratorios->nome}}</td>
            <td>{{date('d/m/Y', strtotime($medicamento->data_validade))}}</td>
            <td>{{date('d/m/Y', strtotime($medicamento->data_fabricacao))}}</td>
            <td>{{$medicamento->transportadoras ? $medicamento->transportadoras->nome : '-'}}</td>
            <td>R$ {{ number_format($medicamento->valor, 2, ',', '.') }}</td>
            <td>{{$medicamento->quantidade}}</td>
            <td><a class='btn btn-primary' href='edit/{{$medicamento->id}}'>Editar</a></td>
            <td><a class='btn btn-danger' href='destroy/{{$medicamento->id}}'>Excluir</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
  {{ $medicamentos->onEachSide(1)->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
@endsection
