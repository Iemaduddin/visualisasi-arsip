<div class="modal fade text-left" id="detailDataUser-{{ $user->id ?? auth()->user()->user_id }}" tabindex="-1"
    role="dialog" aria-labelledby="modalDetailDataUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="card card-profile position-relative">
                <img src="/img/bg-profile.jpg" alt="Image placeholder" style="height: 250px; object-fit: cover;">
                <i class="fa fa-times close text-light-secondary fs-4 cursor-pointer position-absolute top-0 end-0 p-3"
                    data-bs-dismiss="modal" aria-label="Close"></i>
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                        <div class="mt-lg-n7 mb-2 mb-lg-0">
                            <a href="javascript:;">
                                @if ($user->foto == null)
                                    <img src="/img/default.png"
                                        class="rounded-circle img-fluid border border-3 border-white">
                                @else
                                    <img src="{{ asset('storage/' . $user->foto) }}"
                                        class="rounded-circle img-fluid border border-3 border-white">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="text-start mt-4">
                        <div class="text-center mt-0">
                            <p><b>{{ $user->nama }}</b><br>{{ $user->role->name }}
                            </p>
                            {{-- {!! QrCode::size(100)->generate($user->nik) !!} --}}
                        </div><br>
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td class="text-bold">NIK</td>
                                    <td colspan="2" class="text-end">{{ $user->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Tempat, Tanggal Lahir</td>
                                    <td colspan="2" class="text-end">{{ $user->tempat_lahir }},
                                        {{ $user->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Jenis Kelamin</td>
                                    <td colspan="2" class="text-end">{{ $user->jk }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td class="text-bold">No. HP/WA</td>
                                    <td colspan="2" class="text-end">{{ $user->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Email</td>
                                    <td colspan="2" class="text-end">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Username</td>
                                    <td colspan="2" class="text-end">{{ $user->username }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
