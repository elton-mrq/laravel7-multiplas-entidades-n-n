@extends('layout.base')
@section('title', 'Detalhes da Marca')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card border-danger ">
                <h3 class="card-header border-danger">Deseja realmente remover a Categoria?</h3>
                <div class="card-body text-danger">

                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <p class="card-text"><strong>Código: </strong>{{$categoria->id}}</p>
                        <p class="card-text"><strong>Nome: </strong>{{$categoria->nome}}</p>
                        <br>
                        <button type="submit" class="btn btn-danger">Remover</button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-light">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
