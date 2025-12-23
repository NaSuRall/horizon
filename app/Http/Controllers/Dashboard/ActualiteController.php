<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Actualite\StoreActualiteAction;
use App\Actions\Actualite\UpdateActualiteAction;
use App\DTOs\ActualiteDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActualiteUpdateRequest;
use App\Http\Requests\ArticleRequest;
use App\Models\Actualite;

class ActualiteController extends Controller
{
    public function show()
    {
        $actualites = Actualite::latest()->paginate(6);
        return view('site.actualite', compact('actualites'));
    }

    public function index()
    {
        $actualites = Actualite::paginate(9);
        return view('dashboard.actualite', compact('actualites'));
    }

    public function store(StoreActualiteAction $action, ArticleRequest $request)
    {
        try {
            $dto = ActualiteDTO::formRequest($request);
            $action->execute($dto);

            return redirect()
                ->route('actualite.index')
                ->with('success', 'Actualité créée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de l’actualité : ' . $e->getMessage());
        }
    }

    public function update(ActualiteUpdateRequest $request, Actualite $actualite, UpdateActualiteAction $action)
    {
        try {
            $dto = ActualiteDTO::formRequest($request);
            $action->execute($actualite, $dto);

            return redirect()
                ->route('actualite.index')
                ->with('success', 'Actualité modifiée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la modification de l’actualité : ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $actualite = Actualite::findOrFail($id);
            $actualite->delete();

            return redirect()
                ->route('actualite.index')
                ->with('success', 'Actualité supprimée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression de l’actualité : ' . $e->getMessage());
        }
    }
}
