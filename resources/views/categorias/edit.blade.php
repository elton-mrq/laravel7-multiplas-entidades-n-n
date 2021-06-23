@extends('layout.base')

@section('title', 'Adicionar Marcas')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualize sua categoria</div>
                <div class="card-body">
                    <form action="{{route('categorias.update', $categoria)}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <h4 class="card-title">Dados da Categoria</h4>
                        <hr>
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror " name="nome" value="{{ $categoria->nome }}">
                            <span class="invalid-feedback">@error('nome') {{$message}} @enderror</span>
                        </div>
                        <a href="{{ route('categorias.index') }}" class="btn btn-light">Voltar</a>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection

