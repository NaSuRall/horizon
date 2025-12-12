<?php

namespace App\Actions\Actualite;

use App\Models\Activity;
use App\Models\Actualite;

class UpdateActualiteAction
{

    public function execute(Actualite $actualite, $dto){
        if ($dto->titre !== null) {
            $actualite->titre = $dto->titre;
        }
        if ($dto->contenu !== null) {
            $actualite->contenu = $dto->contenu;
        }
        if ($dto->imagePath !== null) {
            $actualite->image = $dto->imagePath;
        }
        $actualite->save();

        Activity::create([
            'type' => 'Actualite',
            'action' => 'update',
            'user_id' => auth()->id(),
            'description' => "{$actualite->titre} crée"
        ]);

        return $actualite;
    }
}
