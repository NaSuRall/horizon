<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        try {
            $activities = Activity::paginate(10);

            return view('dashboard.activity', compact('activities'));

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Erreur lors du chargement des activités : ' . $e->getMessage());
        }
    }
}
