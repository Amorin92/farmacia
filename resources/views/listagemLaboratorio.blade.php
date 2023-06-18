@extends('template')

@section('conteudo')
    <h1>Listagem de Laboratórios</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="novo" class="btn btn-primary">Novo</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laboratorios as $laboratorio)
                <tr>
                    <td>{{ $laboratorio->id }}</td>
                    <td>{{ $laboratorio->nome }}</td>
                    <td>{{ $laboratorio->endereco }}</td>
                    <td><a class='btn btn-primary' href='edit/{{ $laboratorio->id }}'>Editar</a></td>
                    {{-- <td><a class='btn btn-danger' href='destroy/{{ $laboratorio->id }}'>Deletar</a></td> --}}
                    <td>
                        <form action="destroy/{{$laboratorio->id}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja deletar este item?')">Deletar</button>
                        </form>
                      </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $laboratorios->onEachSide(1)->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
@endsection

