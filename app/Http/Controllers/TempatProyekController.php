<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KategoriProyek;
use App\Models\TempatProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempatProyekController{

    function show(Request $request){
        if($request->has('search')){
            $query = $request->get('search');
            $data = TempatProyek::where('nama_tempat', 'LIKE', "%$query%")->get();
        }else{
            $data = TempatProyek::all();
        }

        return view('tempat-proyek.index', ["data" => $data]);
    }

    function add(){
        $customer = Customer::all();
        $kategoriProyek = KategoriProyek::all();
        return view('tempat-proyek.add', ['customer' => $customer, 'kategoriProyek' => $kategoriProyek]);
    }

    function save(Request $request){
        $request->validate([
            'nama_tempat' => 'required',
            'alamat' => 'required',
            'id_customer' => 'required',
            'id_kategori_proyek' => 'required',
        ]);

        $id = $request->id;
        $filePath = "";
        if($request->hasFile('foto')){
            echo "ada";
            $foto = $request->file('foto');
            $filePath = Storage::disk("public")->put("tempat-proyek", $foto);
        }
        if(isset($id) && $id != "" && $id != null){
            $tempatProyek = TempatProyek::where("id", $id)->first();
        }else{
            $tempatProyek = new TempatProyek();
        }
        $tempatProyek->nama_tempat = $request->nama_tempat;
        $tempatProyek->alamat = $request->alamat;
        $tempatProyek->id_customer = $request->id_customer;
        $tempatProyek->id_kategori_proyek = $request->id_kategori_proyek;
        $tempatProyek->foto = $filePath;
        $tempatProyek->save();

        return redirect()->route('show-tempat-proyek');
    }

    function edit(int $id){
        $customer = Customer::all();
        $kategoriProyek = KategoriProyek::all();
        $data = TempatProyek::where("id", $id)->first();
        return view('tempat-proyek.edit', ["data" => $data, 'customer' => $customer, 'kategoriProyek' => $kategoriProyek]);;
    }

    function delete(Request $request){
        $id = $request->id;
        $data = TempatProyek::where("id", $id)->first();
        $data->delete();

        return redirect()->route("show-tempat-proyek");
    }

    function test(){
        $data = array(
            "pembelian" => array(
                "total_beli" => 10000,
            ),
            "penyewaan" =>array(
                "total_sewa" => 10000
            )
        );
    }
}
