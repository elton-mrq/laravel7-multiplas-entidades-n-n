@extends('layout.base')
@section('title', 'Detalhes da Marca');

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalhes da Marca</div>
                <div class="card-body">
                    <h4 class="card-title">Sobre a Marca</h4>
                    <hr>
                    <p class="card-text"><strong>Código: </strong>{{$marca->id}}</p>
                    <p class="card-text"><strong>Nome: </strong>{{$marca->nome}}</p>
                </div>
            </div>
            <br>
            <a href="{{ route('marcas.index') }}" class="btn btn-light">Voltar</a>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
