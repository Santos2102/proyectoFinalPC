<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorArticulo extends Model
{
    use HasFactory;
    protected $table = 'autorarticulo';
    protected $fillable = ['idArticulo','idAutor','fecha', 'created_at', 'updated_at'];

    public function articulo()
    {
        return $this->hasOne('App\Models\Articulo', 'idArticulo', 'idArticulo');
    }

    public function autor()
    {
        return $this->hasOne('App\Models\Autor', 'idAutor', 'idAutor');
    }
}
