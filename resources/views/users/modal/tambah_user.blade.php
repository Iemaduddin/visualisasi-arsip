<div class="modal fade text-left" id="tambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUser"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTambahUser">Tambah Data User</h4>
                <i class="fa fa-times close cursor-pointer" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nama Lengkap</label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama User" class="form-control" name="nama"
                                    required>
                            </div>
                            <label>NIK</label>
                            <div class="form-group">
                                <input type="text" placeholder="NIK" class="form-control" name="nik" required>
                            </div>
                            <label>Tempat Lahir</label>
                            <div class="form-group">
                                <input type="text" placeholder="Tempat Lahir" class="form-control"
                                    name="tempat_lahir">
                            </div>
                            <label>Tanggal Lahir</label>
                            <div class="form-group">
                                <input type="date" class="form-control" name="tanggal_lahir">
                            </div>
                            <label>Jenis Kelamin</label>
                            <div class="form-group">
                                <select name="jk" class="form-select">
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                            <label>Role</label>
                            <div class="form-group">
                                <select name="role_id" class="form-select">
                                    <option value="1">Admin
                                    </option>
                                    <option value="2">Operator
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control" name="foto">
                            </div>
                            <label>No HP / WA</label>
                            <div class="form-group">
                                <input type="text" placeholder="Nomor HP" class="form-control" name="no_hp">
                            </div>
                            <label>Email</label>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control" name="email" required>
                            </div>
                            <label>Username</label>
                            <div class="form-group">
                                <input type="text" placeholder="Username" class="form-control" name="username"
                                    required>
                            </div>
                            <label>Password</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" placeholder="Password" class="form-control" name="password"
                                        id="tambahPasswordUser" required>
                                    <span class="input-group-text" id="show-password-toggle-tambahUser">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            {{-- eye password Tambah --}}
                            <script>
                                const showPasswordToggle = document.querySelector("#show-password-toggle-tambahUser");
                                const passwordField = document.querySelector("#tambahPasswordUser");

                                showPasswordToggle.addEventListener("click", function() {
                                    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                                    passwordField.setAttribute("type", type);

                                    // Toggle eye icon
                                    const eyeIconClass = type === "password" ? "fa-eye" : "fa-eye-slash";
                                    this.innerHTML = `<i class="fa ${eyeIconClass}" aria-hidden="true"></i>`;
                                });
                            </script>
                        </div>
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
