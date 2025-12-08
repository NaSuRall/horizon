<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class ActualiteDTO
{
    public function __construct(
        public string $titre,
        public string $contenu,
        public string $imagePath,
    ){}

    public static function formRequest(Request $request): self
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        return new self (
            titre: $request->input('titre'),
            contenu: $request->input('contenu'),
            imagePath: $imagePath,
        );
    }
}
