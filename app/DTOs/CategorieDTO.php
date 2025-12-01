<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CategorieDTO
{
    public function __construct(
        public string $name,
    ){}

    public static function formRequest(Request $request): self
    {
        return new self (
            name: $request->input('name'),
        );
    }
}
