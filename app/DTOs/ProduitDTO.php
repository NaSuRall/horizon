<?php
namespace App\DTOs;

use Illuminate\Http\Request;

class ProduitDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
        public float $price,
        public string $ref,
        public int $marque_id,
        public ?string $imagePath,
        public array $categories = []
    ) {}

    public static function formRequest(Request $request): self
    {
        // Gestion de l'image uploadée
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        return new self(
            name: $request->input('name'),
            description: $request->input('description'),
            price: (float) $request->input('price'),
            ref: $request->input('ref'),
            marque_id: (int) $request->input('marque_id'),
            imagePath: $imagePath,
            categories: $request->input('categories', [])
        );
    }
}
