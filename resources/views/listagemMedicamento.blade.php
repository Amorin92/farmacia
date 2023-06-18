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

  <h1>Listagem de Medicamentos</h1>
  <div class="d-flex">
    <div class="mb-3 mr-3">
      <a href="novo" class="btn btn-primary">Novo</a>
    </div>
    <div class="mb-3 ml-3" style="margin-left: 1.5rem;">
      <a href="listarTudo" class="btn btn-primary">Listagem Completa</a>
    </div>
  </div>

  <div class="row">
    @foreach($medicamentos as $medicamento)
      <div class="col-md-3">
        <div class="card mb-4 medicamento-card">
          <div class="medicamento-nome">{{$medicamento->nome}}</div>
          <a href="listarTudo">
            <img class="card-img-top medicamento-imagem medicamento-imagem-hover" src="/storage/imagens/{{$medicamento->imagem}}" alt="Imagem do Medicamento">
          </a>
          <div class="card-body">
            <div class="medicamento-info">
                <div class="medicamento-valor">Valor: <br><strong>R$ {{ number_format($medicamento->valor, 2, ',', '.') }}</strong></div>
              <div class="medicamento-quantidade">Quantidade: <br><strong> {{$medicamento->quantidade}}</strong></div>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Laboratório: {{$medicamento->laboratorios->nome}}</li>
              <li class="list-group-item">Lote: {{$medicamento->lote}}</li>
              <li class="list-group-item">Data de Validade: {{date('d/m/Y', strtotime($medicamento->data_validade))}}</li>
              <li class="list-group-item">Data de Fabricação: {{date('d/m/Y', strtotime($medicamento->data_fabricacao))}}</li>
            </ul>
          </div>
          <div class="card-footer footer-white">
            <a class='btn btn-primary btn-block' href='edit/{{$medicamento->id}}'>Editar</a>
            <a class='btn btn-danger btn-block btn-excluir' href='destroy/{{$medicamento->id}}'>Excluir</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <script>
    var buttons = document.querySelectorAll('.btn-excluir');
    buttons.forEach(function(button) {
      button.addEventListener('click', function(event) {
        event.preventDefault(); // Evita o comportamento padrão do link

        // Exibe a caixa de diálogo personalizada
        Swal.fire({
          title: 'Deseja realmente excluir este item?',
          showCancelButton: true,
          confirmButtonText: 'Sim',
          cancelButtonText: 'Não'
        }).then((result) => {
          if (result.isConfirmed) {
            // Se o usuário escolher "Sim", redireciona para a página de exclusão
            window.location.href = this.href;
          }
        });
      });
    });
  </script>

  {{ $medicamentos->onEachSide(1)->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
@endsection
