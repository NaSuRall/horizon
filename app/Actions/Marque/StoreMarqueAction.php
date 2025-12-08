<?php

namespace App\Actions\Marque;

use App\DTOs\MarqueDTO;
use App\Models\Activity;
use App\Models\Marque;

class StoreMarqueAction
{
    public function __construct() {}

    public function execute(MarqueDTO $dto): Marque
    {
        $marques = Marque::create([
            'name' => $dto->name,
            'description' => $dto->description,
        ]);

        Activity::create([
            'type' => 'Marque',
            'action' => 'Crée',
            'user_id' => auth()->id(),
            'description' => "{$marques->name} Modifier"
        ]);
        return $marques;
    }
}
