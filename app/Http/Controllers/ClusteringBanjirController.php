<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClusteringBanjirController extends Controller
{
    public function index()
    {
        return view('all.pages.clustering-banjir');
    }
}
