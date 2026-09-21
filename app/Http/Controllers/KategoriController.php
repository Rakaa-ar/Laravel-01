<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Pest\Support\View;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();

        return View('kategori.index', compact('kategoris'));


    }
}
