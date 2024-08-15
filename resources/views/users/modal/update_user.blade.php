<div class="modal fade text-left" id="updateDataUser-{{ $user->id ?? auth()->user()->user_id }}" tabindex="-1"
    role="dialog" aria-labelledby="modalUpdateDataUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalUpdateDataUser">Update Data User</h4>
                <i class="fa fa-times close cursor-pointer" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row text-start">
                        <div class="col-sm-6">
                            <label>Nama Lengkap</label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama User" class="form-control" name="nama"
                                    value="{{ $user->nama }}" required>
                            </div>
                            <label>NIK</label>
                            <div class="form-group">
                                <input type="text" placeholder="NIK" class="form-control" name="nik"
                                    value="{{ $user->nik }}" required>
                            </div>
                            <label>Tempat Lahir</label>
                            <div class="form-group">
                                <input type="text" placeholder="Tempat Lahir" class="form-control"
                                    name="tempat_lahir" value="{{ $user->tempat_lahir }}">
                            </div>
                            <label>Tanggal Lahir</label>
                            <div class="form-group">
                                <input type="date" class="form-control"
                                    name="tanggal_lahir"value="{{ $user->tanggal_lahir }}">
                            </div>
                            <label>Jenis Kelamin</label>
                            <div class="form-group">
                                <select name="jk" class="form-select">
                                    <option value="Pria" {{ $user->jk == 'Pria' ? 'selected' : '' }}>Pria
                                    </option>
                                    <option value="Wanita" {{ $user->jk == 'Wanita' ? 'selected' : '' }}>Wanita
                                    </option>
                                </select>
                            </div>
                            <label>Role</label>
                            <div class="form-group">
                                <select name="role_id" class="form-select">
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Operator
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
                                <input type="text" placeholder="Nomor HP" class="form-control" name="no_hp"
                                    value="{{ $user->no_hp }}">
                            </div>
                            <label>Email</label>
                            <div class="form-group">
                                <input type="email" placeholder="Email" class="form-control" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <label>Username</label>
                            <div class="form-group">
                                <input type="text" placeholder="Username" class="form-control" name="username"
                                    value="{{ $user->username }}" required>
                            </div>
                            <label>Password</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" placeholder="Password" class="form-control" name="password"
                                        id="updatePasswordUser-{{ $user->id }}">
                                    <span class="input-group-text"
                                        id="show-password-toggle-updateUser-{{ $user->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            {{-- eye password Update user --}}
                            <script>
                                const showPasswordToggle{{ $user->id }} = document.querySelector(
                                    "#show-password-toggle-updateUser-{{ $user->id }}");
                                const passwordField{{ $user->id }} =
                                    document.querySelector("#updatePasswordUser-{{ $user->id }}");

                                showPasswordToggle{{ $user->id }}.addEventListener("click", function() {
                                    const type = passwordField{{ $user->id }}.getAttribute("type") === "password" ?
                                        "text" :
                                        "password";
                                    passwordField{{ $user->id }}.setAttribute("type", type);

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
