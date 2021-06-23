<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Marca;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $page = $request['page'] ?: 1;
        $qtd  = $request['qtd'] ?: 3;
        $busca = $request['buscar'];

        Paginator::currentPageResolver(function () use($page){
            return $page;
        });

        if($busca){
            $produtos = Produto::where('descricao', 'LIKE', $busca.'%')->paginate($qtd);
        }else {
            $produtos = Produto::paginate($qtd);
        }

        $produtos = $produtos->appends(Request::capture()->except('page'));

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas         = Marca::all();
        $categorias     = Categoria::all();
        return view('produtos.create', compact('marcas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validarProduto($request);
        if($validator->fails()){
            return redirect()->route('produtos.create')->withErrors($validator->errors());
        }

        $dados = $request->all();
        $produto = Produto::create($dados);
        $produto = Produto::find($produto->id);
        $produto->categorias()->attach($dados['categoria_id']);
        return redirect('/produtos')->with('status', 'Produto adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
       return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $marcas     = Marca::all();
        $categorias = Categoria::all();
        return view('produtos.edit', compact('produto', 'marcas', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $validator = $this->validarProduto($request);
        if($validator->fails()){
            return redirect()->route('produtos.edit', $produto)->withErrors($validator->errors());
        }

        $dados = $request->all();
        $produto->update($dados);
        $produto->categorias()->sync($dados['categoria_id']);
        return redirect('/produtos')->with('status', 'Produto atualizado com sucesso!');
    }

    public function remover($id)
    {
        $produto = Produto::find($id);
        return view('produtos.remove', compact('produto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect('/produtos')->with('status', 'Produto removido com sucesso!');
    }

    public function validarProduto($request)
    {
        $validator = Validator::make($request->all(), [
            'descricao'         => 'required',
            'preco'             => 'required | numeric',
            'cor'               => 'required',
            'peso'              => 'required | numeric'
        ]);
        return $validator;
    }
}
