<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Actualite\StoreActualiteAction;
use App\Actions\Produit\StoreProduitAction;
use App\DTOs\ActualiteDTO;
use App\DTOs\ProduitDTO;
use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;

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
    public function store(StoreActualiteAction $action , Request $request){
        $dto = ActualiteDTO::formRequest($request);
        $actualites = $action->execute($dto);

        return redirect()->route('actualite.index')->with('success', 'Produit créé avec succès');
    }

    public function update()
    {

    }

    public function delete()
    {

    }


}
