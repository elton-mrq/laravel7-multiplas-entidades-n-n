@extends('layout.base')

@section('title', 'Produtos da Marca')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">Detalhes do Produto</h3>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <td>Descrição</td>
                                <td>Informações</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marca->produtos as $produto)
                                <tr>
                                    <td>{{ $produto->descricao }}</td>
                                    <td><a href="{{ route('produtos.show', $produto) }}">Detalhar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <a href="{{ url()->previous() }}" class="btn btn-light">Voltar</a>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
