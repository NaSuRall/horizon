<?php
namespace App\DTOs;

use Illuminate\Http\Request;

class ProduitDTO
{
    public function __construct(
        public ?string $name,
        public ?string $description,
        public ?float $price,
        public ?string $ref,
        public ?int $marque_id,
        public array $imagePaths = [],
        public ?array $categories = []
    ) {}

    public static function formRequest(Request $request): self
    {
        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('produits', 'public');
            }
        }

        return new self(
            name: $request->input('name') ?: null,
            description: $request->input('description') ?: null,
            price: $request->filled('price') ? (float) $request->input('price') : null,
            ref: $request->input('ref') ?: null,
            marque_id: $request->filled('marque_id') ? (int) $request->input('marque_id') : null,
            imagePaths: $imagePaths,
            categories: $request->input('categories', [])
        );
    }
}
