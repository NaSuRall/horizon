<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Marque\StoreMarqueAction;
use App\Actions\Marque\UpdateMarqueAction;
use App\DTOs\MarqueDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarqueRequest;
use App\Http\Requests\MarqueUpdateRequest;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index()
    {
        $marques = Marque::paginate(9);
        return view('dashboard.marque', compact('marques'));
    }

    public function update(MarqueUpdateRequest $request, UpdateMarqueAction $action, Marque $marque ){

        $dto = MarqueDTO::formRequest($request);
        $marques = $action->execute($dto, $marque);

        return redirect()->route('marques.index', ['marques' => $marques]);

    }

    public function store(MarqueRequest $request, StoreMarqueAction $marqueAction)
    {
        $dto = MarqueDTO::formRequest($request);
        $marques = $marqueAction->execute($dto);
        return redirect()->route('marques.index', ['marques' => $marques]);
    }

    public function destroy($id){
       $marque = Marque::findOrFail($id);
       $marque->delete();
       return redirect()->route('marques.index', ['marques' => $marque]);
    }
}
