<div class="modal fade text-left" id="updateDataLocation-{{ $loc->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalUpdateDataLocation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalUpdateDataLocation">Update Data Location</h4>
                <i class="fa fa-times close cursor-pointer" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <form action="{{ route('locations.update', $loc->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label>Nama Ruangan</label>
                    <div class="form-group">
                        <input type="text" placeholder="Nama Ruangan" class="form-control" name="room_name"
                            value="{{ $loc->room_name }}" required>
                    </div>
                    <label>Nama Rak</label>
                    <div class="form-group">
                        <input type="text" placeholder="Nama Rak" class="form-control" name="rack_name"
                            value="{{ $loc->rack_name }}" required>
                    </div>
                    <label>Lantai</label>
                    <div class="form-group">
                        <input type="number" min="0" placeholder="Lantai" class="form-control" name="floor"
                            value="{{ $loc->floor }}" required>

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
