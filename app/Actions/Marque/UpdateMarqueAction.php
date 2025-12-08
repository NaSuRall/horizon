<?php

namespace App\Actions\Marque;

use App\DTOs\MarqueDTO;
use App\Models\Activity;
use App\Models\Marque;

class UpdateMarqueAction
{
    public function __construct(){}


    public function execute(MarqueDto $dto, $marque): Marque{
        if ($dto->name !== null) {
            $marque->name = $dto->name;
        }
        if ($dto->description !== null) {
            $marque->description = $dto->description;
        }
        $marque->save();


        Activity::create([
            'type' => 'Marque',
            'action' => 'Update',
            'user_id' => auth()->id(),
            'description' => "{$marque->name} Modifier"
        ]);

        return $marque;
    }
}
