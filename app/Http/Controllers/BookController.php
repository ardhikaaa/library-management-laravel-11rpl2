<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\pinjambuku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'    =>'required',
            'penulis'       =>'required',
            'kategori'      =>'required',
            'tahun_terbit'  =>'required|integer',
            'jumlah_stok'   =>'required|integer',
            'status'        =>'required|boolean',
            'deskripsi'     =>'required',
        ]);

        book::create($request->all());

        return redirect('books');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = book::findOrFail($id);
        return view('books.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul_buku'    =>'required',
            'penulis'       =>'required',
            'kategori'      =>'required',
            'tahun_terbit'  =>'required|integer',
            'jumlah_stok'   =>'required|integer',
            'status'        =>'required|boolean',
            'deskripsi'     =>'required',
        ]);

        $books = book::findOrFail($id);
        $books->update($request->all());
        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = book::findOrFail($id);
        $books->delete();
        return redirect('books');
    }

    public function inform()
    {
        $riwayatPeminjaman = pinjambuku::all();

        return view ('books.inform', compact('riwayatPeminjaman'));
    }

    public function status(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $status_pinjaman = pinjambuku::findOrFail($id);

        $status_pinjaman->update([
            'status' => $request->status,
        ]);

        $status = book::findOrFail($status_pinjaman->book_id);

        $status->update([
            'status' => $request->status === 'available',
            'status_pinjaman' => $request->status
        ]);


        return redirect()->route('books.inform')->with(['success' => 'data berhasil diubah']);
    }

    public function perpanjang(Request $request, $id)
{
    // Validasi tanggal kembali
    $request->validate([
        'tanggal_kembali' => 'required|date|after_or_equal:today', // pastikan tanggal lebih besar atau sama dengan hari ini
    ]);

    // Temukan data pinjam buku berdasarkan ID
    $pinjamBuku = pinjambuku::findOrFail($id);

    // Update tanggal kembali
    $pinjamBuku->tanggal_kembali = $request->tanggal_kembali;
    $pinjamBuku->save(); // Simpan perubahan ke database

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Peminjaman berhasil diperpanjang.');
}

}
