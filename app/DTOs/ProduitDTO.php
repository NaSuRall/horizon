<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ProduitDTO
{
 public function __construct(
     public string $name,
     public string $description,
     public int $price,
     public int $ref,
     public int $marque_id,
     public string $image,
 ){}


    public function formRequest(Request $request): self {

     return new self(
         name: $request->input('name'),
         description: $request->input('description'),
         price: $request->input('price'),
         ref: $request->input('ref'),
         marque_id: $request->input('marque_id'),
         image: $request->input('image'),
     );

    }
}
