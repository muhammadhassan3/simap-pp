<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', compact('customers'));
    }


    public function create()
    {
        return view('customer.create_cust');
    }

    // Menyimpan data customer baru
    public function store(Request $request)
    {
        // Validasi input sesuai dengan skema tabel
        $request->validate([
            'no_identitas' => 'required|string|max:16',
            'nama_customer' => 'required|string|max:40',
            'alamat' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:50|unique:customer,email',
        ]);

        // Simpan data customer ke database
        Customer::create([
            'no_identitas' => $request->no_identitas,
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        // Redirect kembali ke halaman daftar customer
        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $customers = Customer::findOrFail($id);
        return view('customer.edit_cust', compact('customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_identitas' => 'required|string|max:16',
            'nama_customer' => 'required|string|max:40',
            'alamat' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:50|unique:customer,email,'.$id,
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $customers = Customer::findOrFail($id); // Cari customer berdasarkan ID
        $customers->delete(); // Hapus customer

        return redirect()->route('customer.index')->with('success', 'Customer berhasil dihapus!');
    }


}
