<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $table = 'articulo';
    protected $fillable = ['idArticulo','titulo','resumen', 'contenido', 'activo', 'created_at', 'updated_at'];
    protected  $primaryKey = 'idArticulo';

    public function autorArticulo(){
        return $this -> hasMany('App\Models\AutorArticulo');
    }
}
