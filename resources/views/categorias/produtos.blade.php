@extends('layout.base')

@section('title', 'Produtos Categoria');

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">Produtos da Categoria</h3>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Descrição</th>
                                    <th>Detalhes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categoria->produtos as $produto)
                                    <tr>
                                        <td>{{$produto->descricao}}</td>
                                        <td><a href="{{ route('produtos.show', $produto) }}">Listar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <a href="{{ url()->previous() }}" class="btn btn-light">Voltar</a>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
