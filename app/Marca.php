<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = ['nome'];

    public function produtos()
    {
       return $this->hasMany(Produto::class, 'marca_id');
    }
}
