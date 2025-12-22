<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

    protected $table = 'categories';

    protected $fillable = ['name, parent_id',
        'name',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function marques()
    {
        return $this->hasMany(Marque::class);
    }
    public function produits() {
        return $this->belongsToMany(Produit::class, 'categorie_produit');
    }


}
