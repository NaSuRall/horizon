<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Categorie\StoreCategorieAction;
use App\Actions\Categorie\UpdateCategorieAction;
use App\Actions\Marque\StoreMarqueAction;
use App\Actions\Marque\UpdateMarqueAction;
use App\DTOs\CategorieDTO;
use App\DTOs\MarqueDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;
use App\Http\Requests\CategorieUpdateRequest;
use App\Http\Requests\MarqueRequest;
use App\Http\Requests\MarqueUpdateRequest;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::paginate(9);
        return view('dashboard.categorie', compact('categories'));
    }

    public function store(CategorieRequest $request, StoreCategorieAction $categorieAction)
    {
        $dto = CategorieDTO::formRequest($request);
        $categories = $categorieAction->execute($dto);
        return redirect()->route('categories.index', ['categories' => $categories]);
    }

    public function update(CategorieUpdateRequest $request, UpdateCategorieAction $action, Categorie $categorie ){
        $dto = CategorieDTO::formRequest($request);
        $categories = $action->execute($dto, $categorie);
        return redirect()->route('categories.index', ['categories' => $categories]);
    }

    public function destroy($id){
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('categories.index', ['categories' => $categorie]);
    }

}
