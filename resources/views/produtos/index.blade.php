@extends('layout.base')

@section('title', 'Lista de Produtos')

@section('content')

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        @if(session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                {{session('status')}}
            </div>
        @endif
    </div>
    <div class="col-md-1"></div>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <h3 class="card-header">Lista de Produtos</h3>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="float-right">
                            <span></span>
                            <form class="form-inline" action="{{ route('produtos.index', 'buscar') }}" method="GET">
                              <input class="form-control mr-sm-2" type="search" placeholder="Descrição do Produto" aria-label="Search" name="buscar">
                              <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Marca</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->id }}</td>
                                    <td>{{ $produto->descricao }}</td>
                                    <td>R$ {{ number_format($produto->preco, '2', ',', '.') }}</td>
                                    <td>{{ $produto->marca->nome }}</td>
                                    <td>
                                        <a href="{{ route('produtos.edit', $produto) }}"><span class="material-icons">edit</span></a>
                                        <a href="{{ route('produtos.remover', $produto->id) }}"><span class="material-icons">delete</span></a>
                                        <a href="{{ route('produtos.show', $produto) }}"><span class="material-icons">info</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="mx-auto">
                        {{ $produtos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">Adicionar</a>
    </div>
    <div class="col-md-1"></div>
</div>
@endsection
