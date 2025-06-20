<!-- Modal Hapus Customer -->
<div class="modal fade" id="hapusCustomerModal" tabindex="-1" aria-labelledby="hapusCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusCustomerLabel">Hapus Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-wrap">Apakah anda yakin akan menghapus Customer ini? <strong>Customer yang dihapus tidak
                        dapat dikembalikan lagi.</strong></p>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-top: -12px;">
                    Tidak, kembali
                </button>
                <form style="margin: 0;" id="formHapusCustomer" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function showModalHapus(customerId) {
        let formHapus = document.getElementById("formHapusCustomer");
        formHapus.action = "/customer/" + customerId + "/delete";
    }
</script>
