<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class CategorieDTO
{
    public function __construct(
        public string $name,
        public ?int $parent_id
    ){}

    public static function formRequest(Request $request): self
    {
        return new self (
            name: $request->input('name'),
            parent_id: $request->input('parent_id'),
        );
    }
}
