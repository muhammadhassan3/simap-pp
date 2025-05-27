<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="text-center mt-4">
                <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
            </div>
            <div class="modal-body text-center">
                <h5 class="fw-bold mt-2">Konfirmasi Penghapusan</h5>
                <p class="mb-2">Apakah Anda yakin ingin menghapus data ini?</p>
                <small class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan.</small>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <div class="row w-100">
                    <div class="col-6 pe-1">
                        <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </button>
                    </div>
                    <div class="col-6 ps-1">
                        <form id="deleteForm" method="POST" class="w-100">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100 text-white" style="background-color: #DE3F00;">
                                <i class="bi bi-trash me-1"></i> Ya
                            </button>
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
