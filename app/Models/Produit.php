<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = ["name", "description", "price", "ref", "image", "marque_id"];




    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_produit');
    }

}
