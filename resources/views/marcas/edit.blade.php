@extends('layout.base')

@section('title', 'Editar Marcas')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Atualize sua marca</div>
                <div class="card-body">
                    <form action="{{route('marcas.update', $marca)}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <h4 class="card-title">Dados da Marca</h4>
                        <hr>
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control @error('nome') is-invalid @enderror " name="nome" value="{{ $marca->nome }}">
                            <span class="invalid-feedback">@error('nome') {{$message}} @enderror</span>
                        </div>
                        <a href="{{ route('marcas.index') }}" class="btn btn-light">Voltar</a>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-2"></div>
    </div>


@endsection
