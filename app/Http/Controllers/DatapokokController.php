<?php

namespace App\Http\Controllers;

use App\Models\datapokok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatapokokController extends Controller
{
    public function index()
    {
        $poin=Auth::user();
         if ($poin->role==1) {
            $data=datapokok::where('nrp', $poin->nrp)
            ->orderBy('nrp')
            ->first();
            dd($data);
        }else{
        if (!empty($_GET['NRP'])) {
            $data=datapokok::where('nrp', $_GET['NRP'])
            ->orderBy('nrp')
            ->first();
            dd($data);
        // return \view('das');
        }

    }

    }
}
