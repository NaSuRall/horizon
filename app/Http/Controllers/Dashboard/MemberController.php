<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Member\StoreMemberAction;
use App\Actions\Member\UpdateMemberAction;
use App\DTOs\MemberDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::paginate(9);
        return view('dashboard.member', ['members' => $members]);
    }

    public function store(MemberRequest $request, StoreMemberAction $action)
    {
        try {
            $dto = MemberDTO::formRequest($request);
            $action->execute($dto);

            return redirect()
                ->route('members.index')
                ->with('success', 'Membre créé avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du membre : ' . $e->getMessage());
        }
    }

    public function update(MemberUpdateRequest $request, UpdateMemberAction $action, User $member)
    {
        try {
            $dto = MemberDTO::formRequest($request);
            $action->execute($dto, $member);

            return redirect()
                ->route('members.index')
                ->with('success', 'Membre modifié avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification du membre : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $member = User::findOrFail($id);
            $member->delete();

            return redirect()
                ->route('members.index')
                ->with('success', 'Membre supprimé avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression du membre : ' . $e->getMessage());
        }
    }
}
