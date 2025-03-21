<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ResortsController extends Controller
{
    public function index()
    {
        return Inertia::render('Resorts', [
            'currentView' => 'home',
        ]);
    }

    public function continentsPage()
    {
        return Inertia::render('Resorts', [
            'currentView' => 'continents',
        ]);
    }

    public function countryPage()
    {
        return Inertia::render('Resorts', [
            'currentView' => 'country',
        ]);
    }

    public function areaPage()
    {
        return Inertia::render('Resorts', [
            'currentView' => 'area',
        ]);
    }

    public function resort()
    {
        return Inertia::render('Resorts', [
            'currentView' => 'resort',
        ]);
    }


}
