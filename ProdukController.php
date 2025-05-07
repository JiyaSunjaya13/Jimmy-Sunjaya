<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

// TODO: tuliskan kode controller untuk produk anda disini
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Produk::query();

        $name = $request->query('name');
        $kategori = $request->query('kategori');
        $n = intval($request->query('n') ?? 3);
        if ($n <=0 || $n > 100) {
            $n = 10;
        }
        if (!is_null($name)) {
            $query = $query->where('nama', 'like', "%{$name}%");
        }
        if (!is_null($kategori)) {
            $query = $query->where('kategori', 'like', "%{$kategori}%");
        }

        $items = $query->orderBy('id')->cursorPaginate($n);
        return view('produk', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('produk',
            [
                'action' => route('produk.store'),
                'item' => new Produk()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Produk::create([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
        $b = Produk::find($id);
        if (is_null($b)) {
            return abort(404);
        }

        return view('produk',
            [
                'action' => route('produk', $id),
                'update' => $b
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
        $b = Produk::findOrFail($id); // if (is_null($)) { return abort(404); }

        $b->update([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
        ]);

        return redirect(route('produk', $id));
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Produk $produk)
        {
            //
            $produk->delete();


            return redirect()->route('produk.index');
        }
    }
