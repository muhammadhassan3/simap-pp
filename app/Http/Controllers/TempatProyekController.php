<?php
namespace App\Http\Controllers;

use App\Models\TempatProyekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempatProyekController{

    function show(Request $request){
        if($request->has('search')){
            $query = $request->get('search');
            $data = TempatProyekModel::where('nama_tempat', 'LIKE', "%$query%")->get();
        }else{
            $data = TempatProyekModel::all();
        }

        return view('tempat-proyek.index', ["data" => $data]);
    }

    function add(){
        return view('tempat-proyek.add');
    }

    function save(Request $request){
        $id = $request->id;
        $filePath = "";
        if($request->hasFile('foto')){
            echo "ada";
            $foto = $request->file('foto');
            $filePath = Storage::disk("public")->put("tempat-proyek", $foto);
        }
        if(isset($id) && $id != "" && $id != null){
            $tempatProyek = TempatProyekModel::where("id", $id)->first();
        }else{
            $tempatProyek = new TempatProyekModel();
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
        $data = TempatProyekModel::where("id", $id)->first();
        return view('tempat-proyek.edit', ["data" => $data]);
    }

    function delete(Request $request){
        $id = $request->id;
        $data = TempatProyekModel::where("id", $id)->first();
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
