<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\pinjambuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        return view('anggota.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Ambil data riwayat peminjaman beserta informasi buku terkait
        $riwayatPeminjaman = PinjamBuku::with('book')  // Load relasi book
        ->where('user_id', Auth::id())  // Menampilkan riwayat untuk user yang sedang login
        ->get();

    return view('anggota.create', compact('riwayatPeminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required | exists:books,id',
            'tanggal_pinjam' => 'required | date',
            'tanggal_kembali' => 'required | date | after_or_equal:tanggal_pinjam',
        ]);

        $books = book::findOrFail($request->book_id);
        // cek ketersediaan buku
        if (!$books->status) {
            return back();
        }

        pinjambuku::create([
            'user_id'           => Auth::id(),
            'book_id'           => $books->id,
            'tanggal_pinjam'    => $request->tanggal_pinjam,
            'tanggal_kembali'   => $request->tanggal_kembali,
            'status'            => 'borrowed',
        ]);

        $books->update([
            'status'        => false,
            'loan_status'   => 'borrowed',
        ]);

        return redirect()->back()->with('success', 'buku berhasil dipinjam');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
