@extends('layout.base')
@section('title', 'Detalhes da Marca');

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card border-danger">
                <h3 class="card-header border-danger">Deseja realmente excluir o produto?</h3>
                <div class="card-body text-danger">
                    <form action="{{ route('produtos.destroy', $produto) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <p class="card-text"><strong>Código: </strong>{{$produto->id}}</p>
                        <p class="card-text"><strong>Descrição: </strong>{{$produto->descricao}}</p>
                        <p class="card-text"><strong>Preço: </strong>R$ {{number_format($produto->preco, '2', ',', '.')}}</p>
                        <p class="card-text"><strong>Marca: </strong>{{$produto->marca->nome}}</p>
                        <br>
                        <button type="submit" class="btn btn-danger">Remover</button>
                        <a href="{{ route('produtos.index') }}" class="btn btn-light">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

@endsection
