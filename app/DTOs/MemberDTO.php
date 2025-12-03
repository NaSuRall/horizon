<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class MemberDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $password,
    ){}

    public static function formRequest(Request $request): self{

        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password')
        );
    }
}
