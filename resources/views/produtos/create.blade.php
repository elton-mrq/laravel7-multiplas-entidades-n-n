@extends('layout.base')

@section('title', 'Adicionar Produtos')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cadastre seu produto</div>
                <div class="card-body">
                    <form action="{{ route('produtos.store') }}" method="POST">
                        {{ csrf_field() }}
                        <h4 class="card-title">Dados do Produto</h4>
                        <hr>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control @error('descricao') is-invalid @enderror " name="descricao">
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="preco">Preço</label>
                                <input type="text" class="form-control @error('preco') is-invalid @enderror" name="preco">
                            </div>

                            <div class="col-md-4">
                                <label for="cor">Cor</label>
                                <input type="text" class="form-control @error('cor') is-invalid @enderror" name="cor">
                            </div>

                            <div class="col-md-4">
                                <label for="peso">Peso</label>
                                <input type="text" class="form-control @error('peso') is-invalid @enderror" name="peso">
                            </div>
                        </div>
                        <br>
                        <h4 class="card-title">Marca</h4>
                        <hr>
                        <div class="form-group">
                            <label for="marca_id">Selecione a Marca do Produto</label>
                            <select name="marca_id" class="form-control">
                                @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <h4 class="card-title">Categorias</h4>
                        <div class="form-group">
                            <label for="categoria_id">Selecione as Categorias do Produto</label>
                            <select multiple name="categoria_id[]" class="form-control">
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <a href="{{ route('produtos.index') }}" class="btn btn-light">Voltar</a>
                        <button class="btn btn-primary" type="submit">Adicionar</button>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div>
    </div><!--row-->

@endsection
