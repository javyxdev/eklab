<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria_examen;
use App\Models\Deta_orden;
use App\Models\Orden;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $loggeduser = Auth::user()->name;
        $categoriasCount = Categoria_examen::all()->count();
        $pacientesCount = Paciente::all()->count();
        $ordensCount = Orden::all()->count();
        $detaOrdenCount = Deta_orden::all()->count();
        return view ('admin.index',compact('loggeduser','categoriasCount','pacientesCount','ordensCount','detaOrdenCount'));
    }
}
