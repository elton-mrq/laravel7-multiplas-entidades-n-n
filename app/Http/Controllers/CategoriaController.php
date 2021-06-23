<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page       = $request['page'] ?: 1;
        $qtd        = $request['qtd'] ?: 2;
        $busca      = $request['buscar'];

        Paginator::currentPageResolver(function () use($page){
            return $page;
        });

        if($busca){
            $categorias = Categoria::where('nome', 'LIKE', $busca.'%')->paginate($qtd);
        }else{
            $categorias = Categoria::paginate($qtd);
        }
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validarCategoria($request);
        if($validator->fails()){
            return redirect()->route('categorias.create')->withErrors($validator->errors());
        }

        Categoria::create($request->all());
        return redirect('/categorias')->with('status', 'Categoria adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validator = $this->validarCategoria($request);
        if($validator->fails()){
            return redirect()->route('categorias.edit', $categoria)->withErrors($validator);
        }

        $categoria->update($request->all());
        return redirect('/categorias')->with('status', 'Categoria atualizada com sucesso!');
    }

    public function remover($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.remove', compact('categoria'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $produtos = $categoria->produtos();
        if($produtos->count()){
            $msg = "Não é possível remover a categoria.
                    Os produtos com id: ";
            foreach($categoria->produtos as $p){
                $msg .= $p->id . ', ';
            }
            $msg .= "estão relacionados!";
            return redirect()->route('categorias.remover', $categoria->id)->with('status', $msg);
        }
        $categoria->delete();
        return redirect('/categorias')->with('status', 'Categoria removida com sucesso!');
    }

    public function produtos($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.produtos', compact('categoria'));
    }

    protected function validarCategoria($request)
    {
        $validator = Validator::make($request->all(), [
            'nome'  => 'required'
        ]);
        return $validator;
    }
}
