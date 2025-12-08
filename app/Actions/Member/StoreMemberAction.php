<?php

namespace App\Actions\Member;

use App\DTOs\MarqueDTO;
use App\DTOs\MemberDTO;
use App\Models\Activity;
use App\Models\User;

class StoreMemberAction
{
    public function __construct(){}


    public function execute(MemberDTO $dto){
        $member = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => password_hash($dto->password, PASSWORD_DEFAULT)

        ]);


        Activity::create([
            'type' => 'Utilisateur',
            'action' => 'Crée',
            'user_id' => auth()->id(),
            'description' => "{$member->name} Crée"
        ]);
        return $member;
    }
}
