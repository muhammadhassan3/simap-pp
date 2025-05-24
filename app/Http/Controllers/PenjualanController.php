<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with(['customer', 'detailPenjualan.produk']);

        if ($request->has('cari') && $request->cari != '') {
            $cari = $request->cari;
            $tanggal = null;

            // Parsing jika input dd-mm-yyyy
            try {
                $tanggal = \Carbon\Carbon::createFromFormat('d-m-Y', $cari)->format('Y-m-d');
            } catch (\Exception $e) {
                //
            }

            $query->where(function ($q) use ($cari, $tanggal) {
                $q->whereHas('customer', function ($sub) use ($cari) {
                    $sub->where('nama_customer', 'like', '%' . $cari . '%');
                })->orWhere('jenis_pembayaran', 'like', '%' . $cari . '%');


                if ($tanggal) {
                    $q->orWhereDate('tanggal_penjualan', $tanggal);
                }


                if (is_numeric($cari) && intval($cari) >= 1 && intval($cari) <= 31) {
                    $q->orWhereRaw('DAY(tanggal_penjualan) = ?', [(int)$cari]);
                }
            });
        }

        $penjualan = $query->orderBy('tanggal_penjualan', 'desc')->orderBy('created_at', 'desc')->paginate(10);

        return view('penjualan.index', compact('penjualan'));
    }

    public function store(Request $request)
    {
        $request->validate(['id_customer' => 'required|exists:customer,id', 'tanggal_penjualan' => 'required|date', 'jenis_pembayaran' => 'required|string', 'id_produk' => 'nullable|array', 'id_produk.*' => 'exists:produk,id',]);

        $penjualan = Penjualan::create(['id_customer' => $request->id_customer, 'tanggal_penjualan' => $request->tanggal_penjualan, 'jenis_pembayaran' => $request->jenis_pembayaran, 'total_harga' => 0,]);

        $total = 0;

        // Hanya proses produk yang dicentang
        if ($request->has('id_produk')) {
            foreach ($request->id_produk as $produk_id) {
                $produk = Produk::findOrFail($produk_id);
                $qty = $request->qty[$produk_id] ?? 0;
                $unit = $request->unit[$produk_id] ?? 'kg';

                if ($qty > 0) {
                    $harga = $produk->harga; // harga per kg


                    if ($unit === 'ton') {
                        $harga = $harga * 1000;
                    }

                    $subtotal = $harga * $qty;
                    $total += $subtotal;

                    DetailPenjualan::create(['id_penjualan' => $penjualan->id, 'id_produk' => $produk_id, 'qty' => $qty, 'unit' => $unit, 'harga_satuan' => $harga, 'total_harga' => $subtotal,]);
                }


            }
        }

        $penjualan->update(['total_harga' => $total]);

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil disimpan.')->with('highlight_id', $penjualan->id);
    }

    public function create(Request $request)
    {

        $customers = Customer::whereDoesntHave('penjualan')->get();
        $produkList = Produk::all();
        return view('penjualan.create', compact('customers', 'produkList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['id_customer' => 'required|exists:customer,id', 'tanggal_penjualan' => 'required|date', 'jenis_pembayaran' => 'required|string', 'id_produk' => 'nullable|array', 'id_produk.*' => 'exists:produk,id',]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update(['id_customer' => $request->id_customer, 'tanggal_penjualan' => $request->tanggal_penjualan, 'jenis_pembayaran' => $request->jenis_pembayaran,]);


        $penjualan->detailPenjualan()->delete();

        $total = 0;
        if ($request->has('id_produk')) {
            foreach ($request->id_produk as $produk_id) {
                $produk = Produk::findOrFail($produk_id);
                $qty = $request->qty[$produk_id] ?? 0;
                $unit = $request->unit[$produk_id] ?? 'kg';

                if ($qty > 0) {
                    $harga = $produk->harga; // harga per kg


                    if ($unit === 'ton') {
                        $harga = $harga * 1000;
                    }

                    $subtotal = $harga * $qty;
                    $total += $subtotal;

                    DetailPenjualan::create(['id_penjualan' => $penjualan->id, 'id_produk' => $produk_id, 'qty' => $qty, 'unit' => $unit, 'harga_satuan' => $harga, 'total_harga' => $subtotal,]);
                }


            }
        }

        $penjualan->update(['total_harga' => $total]);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['customer', 'detailPenjualan.produk'])->findOrFail($id);

        return view('detail_penjualan.show', compact('penjualan'));
    }

    public function edit($id)
    {
        $penjualan = Penjualan::with('detailPenjualan')->findOrFail($id);
        $customers = Customer::all();
        $produk = Produk::all();

        return view('penjualan.edit', compact('penjualan', 'customers', 'produk'));
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus');
    }
}
