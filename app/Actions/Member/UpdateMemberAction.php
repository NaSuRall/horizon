<?php

namespace App\Actions\Member;

use App\DTOs\CategorieDTO;
use App\DTOs\MemberDTO;
use App\Models\Activity;
use App\Models\Categorie;
use App\Models\User;

class UpdateMemberAction
{
    public static function execute(MemberDTO $dto, $member): User{
        if ($dto->name !== null) {
            $member->name = $dto->name;
        }
        if ($dto->email !== null) {
            $member->email = $dto->email;
        }
        if ($dto->password !== null) {
            $member->password = $dto->password;
        }
        $member->save();


        Activity::create([
            'type' => 'Marque',
            'action' => 'Update',
            'user_id' => auth()->id(),
            'description' => "{$member->name} Modifier"
        ]);

        return $member;
    }
}
