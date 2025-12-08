<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    protected $table = 'categories';

    protected $fillable = ['name'];

    public function marques()
    {
        return $this->hasMany(Marque::class);
    }
    public function produits() {
        return $this->belongsToMany(Produit::class, 'categorie_produit');
    }


}
