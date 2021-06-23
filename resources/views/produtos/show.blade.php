@extends('layout.base')

@section('title', 'Detalhes do Produto')

@section('content')

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <h3 class="card-header">Detalhes da Produto</h3>
            <div class="card-body">
                <h4 class="card-title">Sobre a Produto</h4>
                <hr>
                <p class="card-text"><strong>Código: </strong>{{ $produto->id }}</p>
                <p class="card-text"><strong>Descrição: </strong>{{ $produto->descricao }}</p>
                <p class="card-text"><strong>Preço: </strong>R$ {{ number_format($produto->preco, '2', ',', '.') }}</p>
                <p class="card-text"><strong>Cor: </strong>{{ $produto->cor }}</p>
                <p class="card-text"><strong>Peso: </strong>{{ $produto->peso }}</p>
                <p class="card-text"><strong>Marca: </strong>{{ $produto->marca->nome }}</p>
                <p class="card-text"><strong>Categorias:</strong></p>
                <ul>
                    @foreach($produto->categorias as $categoria)
                        <li><a href="{{ route('categorias.show', $categoria) }}">{{$categoria->nome}}</a></li>
                    @endforeach
                </ul>

            </div>
        </div>
        <br>
        <a href="{{ url()->previous() }}" class="btn btn-light">Voltar</a>
    </div>
    <div class="col-md-1"></div>
</div>

@endsection
