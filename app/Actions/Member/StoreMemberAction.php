<?php

namespace App\Actions\Member;

use App\DTOs\MarqueDTO;
use App\DTOs\MemberDTO;
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
        return $member;
    }
}
