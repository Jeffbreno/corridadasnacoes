<?php

namespace App\Model\Entity;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
        'titulo',
        'link_pagamento'

    ];
    public $timestamps = true;
    const CREATED_AT = 'dt_cadastro';
    const UPDATED_AT = 'dt_alteracao';
}
