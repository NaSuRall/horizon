<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Member\StoreMemberAction;
use App\Actions\Member\UpdateMemberAction;
use App\DTOs\MemberDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){

        $members = User::paginate(9);
        return view('dashboard.member', ['members' => $members]);
    }


    public function store(MemberRequest $request, StoreMemberAction $action ){

        $dto = MemberDTO::formRequest($request);
        $members = $action->execute($dto);

        return redirect()->route('members.index', ['members' => $members]);

    }

    public function update(MemberUpdateRequest $request, UpdateMemberAction $action, User $member)
    {
        $dto = MemberDTO::formRequest($request);
        $members = $action->execute($dto , $member);
        return redirect()->route('members.index', ['members' => $members]);
    }

    public function destroy($id)
    {
        $members = User::findOrFail($id);
        $members->delete();
        return redirect()->route('members.index', ['members' => $members]);
    }

}
