<div class="modal fade text-left" id="tambahLocation" tabindex="-1" role="dialog" aria-labelledby="modalTambahlocation"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTambahlocation">Tambah Data Location</h4>
                <i class="fa fa-times close cursor-pointer" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <form action="{{ route('locations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>Nama Ruangan</label>
                    <div class="form-group">
                        <input type="text" placeholder="Nama Ruangan" class="form-control" name="room_name" required>
                    </div>
                    <label>Nama Rak</label>
                    <div class="form-group">
                        <input type="text" placeholder="Nama Rak" class="form-control" name="rack_name" required>
                    </div>
                    <label>Lantai</label>
                    <div class="form-group">
                        <input type="number" min="0" placeholder="Lantai" class="form-control" name="floor"
                            required>
                    </div>
                    <label>Kolom</label>
                    <div class="form-group">
                        <input type="number" min="0" placeholder="Kolom" class="form-control" name="column"
                            required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn bg-gradient-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
