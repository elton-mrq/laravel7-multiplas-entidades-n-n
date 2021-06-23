<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
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
            $marcas = Marca::where('nome', 'LIKE', $busca.'%')->paginate($qtd);
        }else{
            $marcas = Marca::paginate($qtd);
        }

        $marcas = $marcas->appends(Request::capture()->except('page'));
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validarMarca($request);
        if($validator->fails()){
            return redirect()->route('marcas.create')->withErrors($validator);
        }

        $dados = $request->all();
        Marca::create($dados);

        return redirect('marcas')->with('status', 'Marca adicionada com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return view('marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $validator = $this->validarMarca($request);
        if($validator->fails()){
            return redirect()->route('marcas.edit', $marca)->withErrors($validator);
        }

        $dados = $request->all();
        $marca->update($dados);

        return redirect()->route('marcas.index')->with('status', 'Marca atualizada com sucesso');
    }

    public function remover($id)
    {
        $marca = Marca::find($id);
        return view('marcas.remove', compact('marca'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $produtos = $marca->produtos;
        if($produtos->count()){
            $msg = "Não é possível remover a marca.
                   Os produtos com id: ";
            foreach($produtos as $produto){
                $msg .= $produto->id . ', ';
            }
            $msg .= "estão relacionados com a marca!";
            return redirect()->route('marcas.remover', $marca->id)->with('status', $msg);
        }

        $marca->delete();
        return redirect('/marcas')->with('status', 'Marca removida com sucesso!');
    }

    public function produtos($id)
    {
        $marca = Marca::find($id);

        return view('marcas.produtos', compact('marca'));
    }

    protected function validarMarca($request)
    {
        $validator = Validator::make($request->all(), [
            'nome'      => 'required'
        ]);

        return $validator;
    }


}
