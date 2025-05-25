<?php

use App\Http\Controllers\AktorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\DokumenPenyelesaianProyekController;
use App\Http\Controllers\EvaluasiProyekController;
use App\Http\Controllers\KategoriProyekController;
use App\Http\Controllers\LaporanDetail;
use App\Http\Controllers\LaporanProdukController;
use App\Http\Controllers\LaporanProyekController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\MonitoringProyekController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PelaksanaanProyekController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengajuanProposalController;
use App\Http\Controllers\PengawasProyekController;
use App\Http\Controllers\PenjadwalanProyekController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProyekDisetujuiController;
use App\Http\Controllers\SewaAlatController;
use App\Http\Controllers\TimProyekController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempatProyekController;

Route::get('/', function () {
    return view('welcome');
});

//Hassan
Route::get("/tempat-proyek", [TempatProyekController::class, "show"])->name("show-tempat-proyek");
Route::get("/tempat-proyek/add", [TempatProyekController::class, "add"])->name("add-tempat-proyek");
Route::get("/tempat-proyek/{id}/edit", [TempatProyekController::class, "edit"])->name("edit-tempat-proyek");
Route::post("/tempat-proyek/delete", [TempatProyekController::class, "delete"])->name("delete-tempat-proyek");
Route::post("/tempat-proyek/save", [TempatProyekController::class, "save"])->name("save-tempat-proyek");


//Husna
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');
Route::delete('/customer/{id}/delete', [CustomerController::class, 'destroy'])->name('customer.delete');


//Alin
Route::get('/pengawas-proyek', [PengawasProyekController::class, 'index'])->name('pengawas-proyek.index');
Route::get('/pengawas-proyek/{id}/edit', [PengawasProyekController::class, 'edit'])->name('pengawas-proyek.edit');
Route::put('/pengawas-proyek/{id}', [PengawasProyekController::class, 'update'])->name('pengawas-proyek.update');

//Arisa
Route::resource('aktor', AktorController::class);

//Farah
Route::get('/proyekdisetujui', [ProyekDisetujuiController::class, 'index'])->name('proyekdisetujui.index');
Route::get('/proyekdisetujui/{id}/edit', [ProyekDisetujuiController::class, 'edit'])->name('proyekdisetujui.edit');
Route::put('/proyekdisetujui/{id}', [ProyekDisetujuiController::class, 'update'])->name('proyekdisetujui.update');
Route::get('/proyekdisetujui/{id}/show', [ProyekDisetujuiController::class, 'show'])->name('proyekdisetujui.show');

//Fiqhi
Route::prefix('marketing')->group(function () {
    Route::get('/', [MarketingController::class, 'index'])->name('market.index');
    Route::get('create', [MarketingController::class, 'create'])->name('market.create');
    Route::post('store', [MarketingController::class, 'store'])->name('market.store');
    Route::post('store', [MarketingController::class, 'store'])->name('market.store');
    Route::get('{market}/edit', [MarketingController::class, 'edit'])->name('market.edit');
    Route::put('/{market}', [MarketingController::class, 'update'])->name('market.update');
    Route::delete('/{market}', [MarketingController::class, 'destroy'])->name('market.delete');
});

//Hanny
Route::get('/sewa-alat', [SewaAlatController::class, 'index']);
Route::resource('sewa_alat', SewaAlatController::class);
Route::post('/sewa_alat/store', [SewaAlatController::class, 'store'])->name('sewa_alat.store');
Route::delete('/sewa_alat/{id}', [SewaAlatController::class, 'destroy'])->name('sewa_alat.destroy');
Route::get('/sewa_alat/{id}/edit', [SewaAlatController::class, 'edit'])->name('sewa_alat.edit');
Route::put('/sewa_alat/{id}', [SewaAlatController::class, 'update'])->name('sewa_alat.update');

//Ilham
// Route untuk mengarahkan ke tampilan index pada controller monitoring_proyek
Route::get('/monitoring_proyek', [MonitoringProyekController::class, 'index'])->name('monitoring_proyek.index');
// upload foto
Route::post('/monitoring/upload-foto/{id}', [MonitoringProyekController::class, 'uploadFoto'])->name('monitoring.uploadFoto');
Route::resource('monitoring_proyek', MonitoringProyekController::class);
// Route untuk menampilkan form edit
Route::get('/monitoring_proyek/{id}/edit', [MonitoringProyekController::class, 'edit'])->name('monitoring_proyek.edit');
// Route untuk menyimpan perubahan
Route::put('/monitoring_proyek/{id}', [MonitoringProyekController::class, 'update'])->name('monitoring_proyek.update');
Route::get('monitoring_proyek/reset/{id}', [MonitoringProyekController::class, 'reset'])->name('monitoring_proyek.reset');

//Nisa
Route::get('/penjadwalan_proyek', [PenjadwalanProyekController::class, 'index'])->name('penjadwalan_proyek.index');
Route::get('/penjadwalan_proyek/tambah', [PenjadwalanProyekController::class, 'create'])->name('penjadwalan_proyek.create');
Route::post('/penjadwalan_proyek/store', [PenjadwalanProyekController::class, 'store'])->name('penjadwalan_proyek.store');
Route::get('/penjadwalan_proyek/edit/{id}', [PenjadwalanProyekController::class, 'edit'])->name('penjadwalan_proyek.edit');
Route::put('/penjadwalan_proyek/update/{id}', [PenjadwalanProyekController::class, 'update'])->name('penjadwalan_proyek.update');
Route::delete('/penjadwalan_proyek/delete/{id}', [PenjadwalanProyekController::class, 'delete'])->name('penjadwalan_proyek.delete');
Route::get('/getSupervisor/{id}', [PenjadwalanProyekController::class, 'getSupervisor'])->name('penjadwalan_proyek.getSupervisor');
Route::get('/get-supervisor/{id}', [PenjadwalanProyekController::class, 'getSupervisor']);

Route::get('/penjadwalan-proyek', [PenjadwalanProyekController::class, 'index'])->name('penjadwalan-proyek.index');
Route::get('/penjadwalan-proyek/tambah', [PenjadwalanProyekController::class, 'create'])->name('penjadwalan-proyek.create');
Route::post('/penjadwalan-proyek/store', [PenjadwalanProyekController::class, 'store'])->name('penjadwalan-proyek.store');
Route::get('/penjadwalan-proyek/edit/{id}', [PenjadwalanProyekController::class, 'edit'])->name('penjadwalan-proyek.edit');
Route::put('/penjadwalan-proyek/update/{id}', [PenjadwalanProyekController::class, 'update'])->name('penjadwalan-proyek.update');
Route::delete('/penjadwalan-proyek/delete/{id}', [PenjadwalanProyekController::class, 'delete'])->name('penjadwalan-proyek.delete');
Route::get('/supervisor/{id}', [PenjadwalanProyekController::class, 'getSupervisor'])->name('supervisor.get');

//Restu
// Route utama evaluasi proyek
Route::get('/evaluasi', [EvaluasiProyekController::class, 'index'])->name('evaluasi.index');
Route::get('/evaluasi/{id}/edit', [EvaluasiProyekController::class, 'edit'])->name('evaluasi.edit');
Route::put('/evaluasi/{id}', [EvaluasiProyekController::class, 'update'])->name('evaluasi.update');
// Route untuk menambahkan otomatis proyek selesai ke evaluasi_proyek
Route::get('/evaluasi/tambah-dari-proyek', [EvaluasiProyekController::class, 'tambahEvaluasiDariProyek']);

//Rizal
Route::get('/laporan',[LaporanProyekController::class, "show"]);
Route::get('/laporan/{id}', [LaporanDetail::class, 'detail'])->name('detail');
Route::get('/convert/{id}', [LaporanDetail::class, 'convert'])->name('convert');

//Safinka
Route::prefix('pengajuan_proposal')->group(function () {
    Route::get('/', [PengajuanProposalController::class, 'index'])->name('pengajuan_proposal.index');
    Route::get('/create', [PengajuanProposalController::class, 'create'])->name('pengajuan_proposal.create');
    Route::post('/', [PengajuanProposalController::class, 'store'])->name('pengajuan_proposal.store');
    Route::get('/{id}/edit', [PengajuanProposalController::class, 'edit'])->name('pengajuan_proposal.edit');
    Route::put('/{id_pengajuan_proposal}', [PengajuanProposalController::class, 'update'])->name('pengajuan_proposal.update');
    Route::delete('/{id}', [PengajuanProposalController::class, 'destroy'])->name('pengajuan_proposal.destroy');
    Route::put('/proposal/update-status/{id_pengajuan_proposal}/{status}', [PengajuanProposalController::class, 'updateStatus'])
        ->name('proposal.updateStatus');
});

//Alfiah
Route::resource('/produk', ProdukController::class);

//Davin
Route::get('/tim-proyek', [TimProyekController::class, 'index'])->name('tim-proyek.index');
Route::get('/tim-proyek/{id}', [TimProyekController::class, 'detail'])->where(['id' => '[0-9]+'])->name('tim-proyek.detail');
Route::get('/tim-proyek/{id}/edit', [TimProyekController::class, 'edit'])->name('tim-proyek.edit');
Route::put('/tim-proyek/{id}', [TimProyekController::class, 'update'])->name('tim-proyek.update');
Route::delete('/tim-proyek/{id}', [TimProyekController::class, 'destroy'])->name('tim-proyek.destroy');
Route::get('/tim-proyek/create', [TimProyekController::class, 'create'])->name('tim-proyek.create');
Route::post('/tim-proyek', [TimProyekController::class, 'store'])->name('tim-proyek.store');
Route::get('/tim-proyek/{id}/search', [TimProyekController::class, 'detail'])->name('tim-proyek.search');

//Dea
Route::resource('kategori_proyek', KategoriProyekController::class)->parameters([
    'kategori_proyek' => 'id'
]);

//Erlangga
Route::get('/dokumen', [DokumenPenyelesaianProyekController::class, 'index'])->name('dokumen.index');
Route::get('/dokumen/create', [DokumenPenyelesaianProyekController::class, 'create'])->name('dokumen.create');
Route::post('/dokumen', [DokumenPenyelesaianProyekController::class, 'store'])->name('dokumen.store');
Route::get('/dokumen/{id}/edit', [DokumenPenyelesaianProyekController::class, 'edit'])->name('dokumen.edit');
Route::put('/dokumen/{id}', [DokumenPenyelesaianProyekController::class, 'update'])->name('dokumen.update');
Route::delete('/dokumen/{id}', [DokumenPenyelesaianProyekController::class, 'destroy'])->name('dokumen.destroy');

//Refina
Route::get('/detail-penjualan/{id}', [DetailPenjualanController::class, 'show'])->name('detail-penjualan.show');
Route::get('/detail_penjualan/{id}/{detail_id}', [DetailPenjualanController::class, 'show'])->name('detail_penjualan.show');
Route::get('detail_penjualan/{id}', [PenjualanController::class, 'show'])->name('detail_penjualan.show');
//Resource route untuk penjualan (semua CRUD)
Route::resource('penjualan', PenjualanController::class);

//Syam
Route::resource('/pekerja', PekerjaController::class);

//Yusuf
// ROUTE PELAKSANAAN
Route::get('pelaksanaan/{id}', [PelaksanaanProyekController::class, 'index'])->name('pelaksanaan.index');
Route::get('pelaksanaan/{id}/create', [PelaksanaanProyekController::class, 'create'])->name('pelaksanaan.create');
Route::post('pelaksanaan', [PelaksanaanProyekController::class, 'store'])->name('pelaksanaan.store');
Route::get('pelaksanaan/{id}/edit/{kode}', [PelaksanaanProyekController::class, 'edit'])->name('pelaksanaan.edit');
Route::put('pelaksanaan/{id}/update/{kode}', [PelaksanaanProyekController::class, 'update'])->name('pelaksanaan.update');
Route::put('pelaksanaan/{id}/confirm/{kode}', [PelaksanaanProyekController::class, 'confirm'])->name('pelaksanaan.confirm');
Route::put('pelaksanaan/{id}/finish', [PelaksanaanProyekController::class, 'finish'])->name('pelaksanaan.finish');
Route::delete('pelaksanaan/{id}/delete/{kode}', [PelaksanaanProyekController::class, 'destroy'])->name('pelaksanaan.destroy');
// ROUTE PROYEK DITERIMA
Route::get('proyek', [ProyekDisetujuiController::class, 'index'])->name('proyek.index');
Route::get('proyek/{id}', [MonitoringProyekController::class, 'index'])->name('proyek.detail');
//Route::put('proyek/{id}/update', [MonitoringProyekController::class, 'updateKeterangan'])->name('proyek.update.keterangan');

//Anas
Route::get('/laporan', [LaporanProdukController::class, "show"]);
Route::get('/cetak', [LaporanProdukController::class, "convert"]);

//Rista
Route::get('/pembelian', [PembelianController::class, 'tampil'])->name('pembelian.tampil');
Route::get('/pembelian/tambah', [PembelianController::class, 'tambah'])->name('pembelian.tambah');
// Route::get('/pembelian/tambah', DetailPembelian::class)->name('pembelian.tambah');
Route::post('/pembelian/simpan', [PembelianController::class, 'simpan'])->name('pembelian.simpan');
Route::get('/pembelian/edit/{id}', [PembelianController::class, 'edit'])->name('pembelian.edit');
Route::put('/pembelian/update/{id}', [PembelianController::class, 'update'])->name('pembelian.update');
Route::post('/pembelian/delete/{id}', [PembelianController::class, 'delete'])->name('pembelian.delete');
Route::get('/pembelian/detail/{id}', [PembelianController::class, 'detail'])->name('pembelian.detail');

//Lintang
Route::get('/', function () {
    return view('auth.login');
});
// Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Proses Login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Dashboard (Harus login dulu)
Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('auth.dashboard', ['user' => $user]);
})->name('dashboard');
Route::get('/profilemanagement', [AuthController::class, "profile"])->name("profile");
Route::post('/profilemanagement', [AuthController::class, "updateProfile"])->name("updateprofile");
Route::post('/profilemanagement/editPassword', [AuthController::class, "updatePassword"])->name("updatepassword");
Route::post('/profile/delete', [AuthController::class, 'deleteAccount'])->name('deleteaccount');
