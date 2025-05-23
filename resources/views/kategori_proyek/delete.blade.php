<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="deleteModalLabel">Hapus Kategori Proyek</h5>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Kategori Proyek ini?
                <strong>Kategori yang dihapus tidak dapat dikembalikan.</strong>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-6">
                        <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal">Tidak, kembali</button>
                    </div>
                    <div class="col-6">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100 text-white" style="background-color: #DE3F00;">Ya, hapus</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function showDeleteModal(element) {
        let url = element.getAttribute('data-url');
        document.getElementById('deleteForm').setAttribute('action', url);

        let modalInstance = new bootstrap.Modal(document.getElementById('deleteModal'));
        modalInstance.show();
    }
</script>