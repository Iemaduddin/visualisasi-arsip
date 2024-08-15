<div class="table-responsive p-0 tab-pane fade show text-sm p-4" id="visualisasi" role="tabpanel"
    aria-labelledby="visualisasi-tab" style="width:100%">
    <div class="container-fluid">
        <p class="text-danger">Fitur Select Option Ruangan Belum Tersedia</p>
        <div class="row">
            <div class="col-md-2 mb-3">
                <label for="selectOption" class="form-label">Silahkan pilih ruangan:</label>
                <select class="form-select form-select-sm" name="selectedOption" id="selectOption">
                    <option>Pilih Ruangan</option>
                    @foreach ($uniqueRoomNames as $room)
                        <option value="{{ $room }}">{{ $room }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <style>
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4 p-1">
            <div id="rakContainer">
                <div class="container-fluid">
                    <!-- Tempat untuk menampilkan rak -->
                    @foreach ($roomGrouping as $room_name => $categories)
                        <div class="mb-4">
                            <h4 class="mb-3">{{ $room_name }}</h4>
                            <div class="row">
                                @foreach ($categories as $rack => $floors)
                                    <div class="col-md-4">
                                        <div class="p-3  border rounded shadow-sm bg-white">
                                            <h5 class="mb-3">{{ $rack }}</h5>
                                            @foreach (array_reverse($floors) as $floor => $columns)
                                                <div class="">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                @foreach ($columns as $column => $file_name)
                                                                    <td class="bg-success">
                                                                        <p class="text-white fw-bold">
                                                                            {{ $file_name }}</p>
                                                                    </td>
                                                                @endforeach
                                                                <!-- Tambahkan kolom kosong jika jumlah kolom kurang dari 2 -->
                                                                @for ($i = count($columns); $i < 2; $i++)
                                                                    <td class="bg-secondary">
                                                                        <p class="text-white fw-bold">
                                                                            Kosong</p>
                                                                    </td>
                                                                @endfor
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
