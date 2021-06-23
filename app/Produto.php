<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    protected $fillable = ['descricao', 'preco', 'cor', 'peso', 'marca_id'];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Categoria', 'categoria_produto');
    }
}
