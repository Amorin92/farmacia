<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <style>
      * {
        font-family: arial, sans-serif;
      }
      h1 {
        font-size: 3rem;
        text-align: center;
      }
      table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
      }
      th, td {
        border: solid 1px gray;
        padding: 0.5rem;
        font-size: 1.5rem;
        text-align: center;
      }
      img {
        width: 50px;
      }
    </style>
  </head>
  <body>
    <h1>Relatório de Medicamentos</h1>
    <table>
      <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Laboratório</th>
            <th>Data de Validade</th>
            <th>Valor</th>
            <th>Quantidade</th>
        </tr>
      </thead>
      <tbody>
        @foreach($medicamentos as $medicamento)
          <tr>
            <td>
                @if ($medicamento->imagem != "")
                  <img src='{{storage_path("app/public/imagens/$medicamento->imagem")}}'>
                @endif            
            </td>
            <td>{{$medicamento->nome}}</td>
            <td>{{$medicamento->laboratorios->nome}}</td>
            <td>{{date('d/m/Y', strtotime($medicamento->data_validade))}}</td>
            <td>R$ {{ number_format($medicamento->valor, 2, ',', '.') }}</td>
            <td>{{$medicamento->quantidade}}</td>
          </tr>
      @endforeach
      </tbody>
    </table>
  </body>
</html>
