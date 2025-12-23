<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Categorie\StoreCategorieAction;
use App\Actions\Categorie\UpdateCategorieAction;
use App\DTOs\CategorieDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function index()
    {
        try {
            // Pour le tableau (uniquement les parents)
            $categories = Categorie::whereNull('parent_id')
                ->with('children')
                ->paginate(10);

            // Pour les selects (liste des parents possibles)
            $parents = Categorie::whereNull('parent_id')->get();
            $allCategories = Categorie::all();

            return view('dashboard.categorie', compact('categories', "parents", 'allCategories'));

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Erreur lors du chargement des catégories : ' . $e->getMessage());
        }
    }

    public function store(CategorieRequest $request, StoreCategorieAction $categorieAction)
    {
        try {
            $dto = CategorieDTO::formRequest($request);
            $categorieAction->execute($dto);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Catégorie créée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de la catégorie : ' . $e->getMessage());
        }
    }

    public function update(CategorieUpdateRequest $request, UpdateCategorieAction $action, Categorie $categorie)
    {
        try {
            $dto = CategorieDTO::formRequest($request);
            $action->execute($dto, $categorie);

            return redirect()
                ->route('categories.index')
                ->with('success', 'Catégorie mise à jour avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour de la catégorie : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();

            return redirect()
                ->route('categories.index')
                ->with('success', 'Catégorie supprimée avec succès');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression de la catégorie : ' . $e->getMessage());
        }
    }
}
