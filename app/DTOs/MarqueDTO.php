<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class MarqueDTO
{
     public function __construct(
         public string $name,
         public string $description,
     ){}

    public static function formRequest(Request $request): self
    {
         return new self (
             name: $request->input('name'),
             description: $request->input('description'),
         );
    }

}
