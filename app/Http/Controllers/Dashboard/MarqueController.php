<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Marque\StoreMarqueAction;
use App\Actions\Marque\UpdateMarqueAction;
use App\DTOs\MarqueDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarqueRequest;
use App\Http\Requests\MarqueUpdateRequest;
use App\Models\Marque;

class MarqueController extends Controller
{
    public function index()
    {
        $marques = Marque::paginate(9);
        return view('dashboard.marque', compact('marques'));
    }

    public function store(MarqueRequest $request, StoreMarqueAction $action)
    {
        try {
            $dto = MarqueDTO::formRequest($request);
            $action->execute($dto);

            return redirect()
                ->route('marques.index')
                ->with('success', 'Marque créée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de la marque : ' . $e->getMessage());
        }
    }

    public function update(MarqueUpdateRequest $request, UpdateMarqueAction $action, Marque $marque)
    {
        try {
            $dto = MarqueDTO::formRequest($request);
            $action->execute($dto, $marque);

            return redirect()
                ->route('marques.index')
                ->with('success', 'Marque modifiée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification de la marque : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $marque = Marque::findOrFail($id);
            $marque->delete();

            return redirect()
                ->route('marques.index')
                ->with('success', 'Marque supprimée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression de la marque : ' . $e->getMessage());
        }
    }
}
