<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Marketing;
use App\Models\Produk;
use Illuminate\Http\Request;

class MarketingController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil input pencarian
        $customer = $request->customer;
        $produk = $request->produk;
        $jenis_pembayaran = $request->jenis_pembayaran;
        $tanggal = $request->tanggal;

        // Query data marketing dengan pencarian
        $marketings = Marketing::with(['produk', 'customer'])
            ->when($customer, fn($query) => $query->whereHas('customer', fn($q) => $q->where('nama_customer', 'like', "%$customer%")))
            ->when($produk, fn($query) => $query->whereHas('produk', fn($q) => $q->where('nama', 'like', "%$produk%")))
            ->when($tanggal, fn($query) => $query->whereDate('tanggal_pembelian', $tanggal)) // Filter berdasarkan tanggal
            ->when($jenis_pembayaran, fn($query) => $query->where('jenis_pembayaran', $jenis_pembayaran))
            ->orderBy('created_at', 'desc') // Urutkan data terbaru di atas
            ->paginate(5); // Batasi 5 data per halaman

        // Ambil semua nama customer dan produk unik
        $customers = Customer::select('nama_customer')->get();
        $produks = Produk::pluck('nama');


        // Kirim data ke tampilan
        return view('marketing.index', compact('marketings', 'customers', 'produks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data produk dan customer dari database
        $produk = Produk::all();
        $customer = Customer::all();

        // Kirim data ke view
        return view('marketing.create', compact('produk', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'customer_id' => 'required',
            'tujuan_pembelian' => 'required|string',
            'jenis_pembayaran' => 'required',
            'keterangan_pembayaran' => 'nullable|string',
            'tanggal_pembelian' => 'required|date',
        ]);
//        dd();
        // Simpan data ke database
        Marketing::create([
            'produk_id' => $request->produk_id,
            'customer_id' => $request->customer_id,
            'tujuan_pembelian' => $request->tujuan_pembelian,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'keterangan_pembayaran' => $request->keterangan_pembayaran,
            'tanggal_pembelian' => $request->tanggal_pembelian,
        ]);

        return redirect()->route('market.index')->with('success', 'Data Marketing Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data marketing berdasarkan ID dengan relasi customer & produk
        $marketing = Marketing::with(['produk', 'customer'])->findOrFail($id);

        // Kirim data ke view
        return view('marketing.show', compact('marketing'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data produk dan customer dari database
        $produk = Produk::all();
        $customer = Customer::all();
        $marketing = Marketing::with(['produk', 'customer'])->findOrFail($id);


        // Kirim data ke view
        return view('marketing.edit', compact('marketing', 'customer', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'produk_id' => 'required',
            'customer_id' => 'required',
            'tujuan_pembelian' => 'required|string|min:10',
            'jenis_pembayaran' => 'required',
            'keterangan_pembayaran' => 'nullable|string',
            'tanggal_pembelian' => 'required|date',
        ]);

        // update data ke database
        $update = Marketing::findOrFail($id);
        $update->update($request->all());

        return redirect()->route('market.index')->with('success', 'Data Marketing Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marketing = Marketing::findOrFail($id);
        $marketing->delete();

        return redirect()->route('market.index')->with('success', 'Data Berhasil di Hapus');
    }
}
