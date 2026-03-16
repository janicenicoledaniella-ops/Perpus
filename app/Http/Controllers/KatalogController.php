<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q'); 
        $bukus = Buku::query();

        if ($query) {
            $bukus->where('judul', 'like', "%{$query}%")
                  ->orWhere('penulis', 'like', "%{$query}%");
        }

        return view('katalog.index', [
            'bukus' => $bukus->get()
        ]);
    }
}
