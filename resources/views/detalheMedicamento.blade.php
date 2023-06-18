@extends('template')

@section('conteudo')
    <div class="row">
        <div class="col-md-4">
            <img src="/storage/imagens/{{ $medicamento->imagem }}" alt="Imagem do Medicamento" class="img-fluid">
        </div>
        <div class="col-md-8">
            <h2>{{ $medicamento->nome }}</h2>
            <p><strong>Valor:</strong> R$ {{ number_format($medicamento->valor, 2, ',', '.') }}</p>
            <p><strong>Quantidade:</strong> {{ $medicamento->quantidade }}</p>
            <p><strong>Laboratório:</strong> {{ $medicamento->laboratorios->nome }}</p>
            <p><strong>Lote:</strong> {{ $medicamento->lote }}</p>
            <p><strong>Data de Validade:</strong> {{ date('d/m/Y', strtotime($medicamento->data_validade)) }}</p>
            <p><strong>Data de Fabricação:</strong> {{ date('d/m/Y', strtotime($medicamento->data_fabricacao)) }}</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ url('/') }}" class="btn btn-primary animated-button">
                <span class="button-text">Voltar</span>
                <span class="button-circle"></span>
            </a>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .animated-button {
        position: relative;
        overflow: hidden;
    }

    .animated-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(30, 136, 229, 0.8);
        transform: skewX(-30deg);
        transition: all 0.3s ease-in-out;
    }

    .animated-button:hover::before {
        left: 100%;
    }

    .button-text {
        position: relative;
        z-index: 2;
    }
</style>
@endpush
