@extends('layout.base')

@section('title', 'Adicionar Produtos')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header">Atualize os dados do seu produto</h4>
                <div class="card-body">
                    <form action="{{ route('produtos.update', $produto) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <h5 class="card-title">Dados do Produto</h5>
                        <hr>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control @error('descricao') is-invalid @enderror " name="descricao" value="{{ $produto->descricao }}">
                        </div>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="preco">Preço</label>
                                <input type="text" class="form-control @error('preco') is-invalid @enderror" name="preco" value="{{ $produto->preco }}" >
                            </div>

                            <div class="col-md-4">
                                <label for="cor">Cor</label>
                                <input type="text" class="form-control @error('cor') is-invalid @enderror" name="cor" value="{{ $produto->cor }}">
                            </div>

                            <div class="col-md-4">
                                <label for="peso">Peso</label>
                                <input type="text" class="form-control @error('peso') is-invalid @enderror" name="peso" value="{{ $produto->peso }}">
                            </div>
                        </div>
                        <br>
                        <h5 class="card-title">Marca</h5>
                        <hr>
                        <div class="form-group">
                            <label for="marca_id">Selecione a Marca do Produto</label>
                            <select name="marca_id" class="form-control">
                                @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}" {{ (isset($produto->marca_id) && $produto->marca_id == $marca->id ? 'selected' : '') }} >{{$marca->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <h5 class="card-title">Categorias</h5>
                        <div class="form-group">
                            <label for="categoria_id">Selecione as Categorias do Produto</label>
                            <select multiple name="categoria_id[]" id="" class="form-control">
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}"
                                        @foreach($produto->categorias as $c)
                                            @if($categoria->id == $c->id)
                                                selected = "selected"
                                            @endif
                                        @endforeach >{{$categoria->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('produtos.index') }}" class="btn btn-light">Voltar</a>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div>
    </div><!--row-->

@endsection
