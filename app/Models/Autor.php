<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;
    protected $table = 'autor';
    protected $fillable = ['idAutor','nombre','apellido', 'direccion', 'activo', 'modificado','idInstitucion','created_at', 'updated_at'];
    protected  $primaryKey = 'idArticulo';

    public function autorArticulo(){
        return $this -> hasMany('App\Models\AutorArticulo');
    }
}
