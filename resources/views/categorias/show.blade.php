@extends('layout.base')
@section('title', 'Detalhes da Categoria');

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalhes da Categoria</div>
                <div class="card-body">
                    <h4 class="card-title">Sobre a Categoria</h4>
                    <hr>
                    <p class="card-text"><strong>Código: </strong>{{$categoria->id}}</p>
                    <p class="card-text"><strong>Nome: </strong>{{$categoria->nome}}</p>
                </div>
            </div>
            <br>
            <a href="{{ url()->previous() }}" class="btn btn-light">Voltar</a>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
