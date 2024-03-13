<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idProducto';

    ##########  metodos de relaciones  #########
    ## relacion a Marca
    public function relMarca()
    {
        return $this->belongsTo(Marca::class, 'idMarca', 'idMarca');
    }

    ## relacion a Marca
    public function relCategoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }
}
