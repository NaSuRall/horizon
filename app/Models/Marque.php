<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    protected $table = 'marque';
    protected $fillable = ["name", "description", "created_at", "updated_at"];


    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

}
