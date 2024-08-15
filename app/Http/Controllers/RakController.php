<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rak;
use App\Exports\RaksExport;
use App\Imports\RaksImport;
use Illuminate\Http\Request;
use App\Models\RevisionHistory;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $rak = Rak::where('rak_address', 'like', 'T0%')
            ->orWhere('rak_address', 'like', 'T1%')->get();
        $rakAddress = []; // Nama Rak T

        // Mengambil rak_address 3 karakter pertama
        foreach ($rak as $r) {
            if (!in_array(substr($r->rak_address, 0, 3), $rakAddress)) {
                array_push($rakAddress, substr("$r->rak_address", 0, 3));
            }
        }
        $rakAddressUnique = array_unique($rakAddress);

        $revisions = RevisionHistory::all();
        $uniqueRak = [];
        foreach ($rak as $a) {
            if (!in_array(substr($a->rak_address, 0, 3), $uniqueRak)) {
                array_push($uniqueRak, substr($a->rak_address, 0, 3));
            }
        }

        $uniqueColumn = [];
        foreach ($rak as $r) {
            if (!in_array(substr($r->rak_address, 5), $uniqueColumn)) {
                array_push($uniqueColumn, substr("$r->rak_address", 5));
            }
        }
        $uniquePartNo = [];
        foreach ($rak as $r) {
            if (!in_array($r->part_no, $uniquePartNo)) {
                array_push($uniquePartNo, $r->part_no);
            }
        }


        $uniqueColumnList = [];
        foreach ($uniqueColumn as $i => $uc) {
            $uniqueColumnList[$i] = [];
            foreach ($rak as $r) {
                if (substr("$r->rak_address", 5) === $uc) {
                    array_push($uniqueColumnList[$i], $r);
                }
            }
        }
        $uniqueTingkat = [];
        foreach ($uniqueColumnList as $i => $ucl) {
            $uniqueTingkat[$i] = [];
            foreach ($ucl as $u) {
                foreach ($uniqueColumn as $uc) {
                    if (substr($u->rak_address, 5) == $uc) {
                        if (!in_array($u->rak_address, $uniqueTingkat[$i])) {
                            array_push($uniqueTingkat[$i], $u->rak_address);
                        }
                    }
                }
            }
        }

        $uniqueTingkatList = [];
        $groupedPartNo = [];
        foreach ($uniqueTingkat as $i => $ut) {
            $uniqueTingkatList[$i] = [];
            $groupedPartNo[$i] = [];
            foreach ($ut as $j => $u) {
                $uniqueTingkatList[$i][$j] = [];
                $groupedPartNo[$i][$j] = [];
                foreach ($rak as $r) {
                    if ($r->rak_address == $u) {
                        array_push($uniqueTingkatList[$i][$j], $r);
                        if (!in_array($r->part_no, $groupedPartNo[$i][$j])) {
                            array_push($groupedPartNo[$i][$j], $r->part_no);
                        }
                    }
                }
            }
        }
        $volumeRak = 6 * 5 * 6;
        $jumlahKolomKosong = [];
        $totalJumlahKolom = 0;
        $totalJumlahKolomKosongTemp = 0;
        $totalPerT = [];
        foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
            $jumlahKolomKosong[$a] = [];
            $totalJumlahKolom += $volumeRak;
            foreach ($uniqueTingkat as $b => $ut) {
                $jumlahKolomKosong[$a][$b] = $volumeRak;
                $totalJumlahKolomKosongTemp += $volumeRak;
            }
        }
        foreach ($uniqueTingkatList as $i => $tingkatList) {
            foreach ($tingkatList as $j => $rakList) {
                foreach ($rakList as $rak) {
                    $jumlahKolomKosong[$i][$j] -= $rak->max_qty_box;
                    $totalJumlahKolom -= $rak->max_qty_box;
                    $totalJumlahKolomKosongTemp -= $rak->max_qty_box;
                    $totalPerT = $totalJumlahKolomKosongTemp;
                }
            }
        }

        $longest = [];
        foreach ($uniqueTingkatList as $i => $utl) {
            $longest[$i] = 0;
            foreach ($utl as $u) {
                if (count($u) > $longest[$i]) {
                    $longest[$i] = count($u);
                }
            }
        }

        return view('rak.rak-management', compact('rak', 'longest', 'uniqueTingkatList', 'revisions', 'rakAddressUnique'));
    }

    public function saveDataSizeRak(Request $request)
    {
        $filePath = public_path('sizeRak.json');
        $jsonData = json_decode(File::get($filePath), true);
        $jsonData[$request->index] = json_decode($request->data, true);
        file_put_contents($filePath, json_encode($jsonData));
        toast('Berhasil Update Rak 👌', 'success');
        return response()->json($request->data);
    }
    // if ($request->hasFile('file')) {
    //     $file = $request->file('file');
    //     $file->move(public_path(), 'dataSizeRak.json');
    //     // toast('Berhasil Update Rak', 'success');
    //     return response()->json(['message' => 'Data saved successfully']);
    // } else {
    //     return response()->json(['error' => 'No file uploaded'], 400);
    // }

    public function getDataSizeRak()
    {
        $filePath = public_path('sizeRak.json');
        $jsonData = File::get($filePath);
        return response()->json($jsonData);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getRakData(Request $request)
    {
        // Ambil pilihan rak dari permintaan
        $selectedOption = $request->input('selectedOption');
        // Ambil jumlah kolom rak  dari permintaan
        $jmlKolom = $request->input('jmlKolom');
        // Ambil tingkat rak dari permintaan
        $jmlTingkat = $request->input('jmlTingkat');

        // Ambil data rak sesuai dengan pilihan dari database atau sumber data lainnya
        $rak = Rak::where('rak_address', 'like', $selectedOption . '-%')
            ->get();

        $uniqueColumn = [];
        foreach ($rak as $r) {
            if (!in_array(substr($r->rak_address, 5), $uniqueColumn)) {
                array_push($uniqueColumn, substr("$r->rak_address", 5));
            }
        }

        $uniquePartNo = [];
        foreach ($rak as $r) {
            if (!in_array($r->part_no, $uniquePartNo)) {
                array_push($uniquePartNo, $r->part_no);
            }
        }

        $uniqueColumnList = [];
        foreach ($uniqueColumn as $i => $uc) {
            $uniqueColumnList[$i] = [];
            foreach ($rak as $r) {
                if (substr("$r->rak_address", 5) === $uc) {
                    array_push($uniqueColumnList[$i], $r);
                }
            }
        }
        $uniqueTingkat = [];
        foreach ($uniqueColumnList as $i => $ucl) {
            $uniqueTingkat[$i] = [];
            foreach ($ucl as $u) {
                foreach ($uniqueColumn as $uc) {
                    if (substr($u->rak_address, 5) == $uc) {
                        if (!in_array($u->rak_address, $uniqueTingkat[$i])) {
                            array_push($uniqueTingkat[$i], $u->rak_address);
                        }
                    }
                }
            }
        }
        $uniqueTingkatList = [];
        $groupedPartNo = [];
        foreach ($uniqueTingkat as $i => $ut) {
            $uniqueTingkatList[$i] = [];
            $groupedPartNo[$i] = [];
            foreach ($ut as $j => $u) {
                $uniqueTingkatList[$i][intval(explode('-', $u)[1]) - 1] = [];
                $groupedPartNo[$i][intval(explode('-', $u)[1]) - 1]  = [];
                foreach ($rak as $r) {
                    if ($r->rak_address == $u) {
                        array_push($uniqueTingkatList[$i][intval(explode('-', $u)[1]) - 1], $r);
                        if (!in_array($r->part_no, $groupedPartNo[$i][intval(explode('-', $u)[1]) - 1])) {
                            array_push($groupedPartNo[$i][intval(explode('-', $u)[1]) - 1], $r->part_no);
                        }
                    }
                }
            }
        }
        $longest = [];
        foreach ($uniqueTingkatList as $i => $utl) {
            $longest[$i] = 0;
            foreach ($utl as $u) {
                if (count($u) > $longest[$i]) {
                    $longest[$i] = count($u);
                }
            }
        }
        // Ubah data menjadi format JSON dan kirimkan sebagai respons
        return response()->json(['rak' => $rak, 'longest' => $longest, 'uniqueTingkatList' => $uniqueTingkatList, 'jmlKolom' => $jmlKolom, 'jmlTingkat' => $jmlTingkat]);
    }

    public function summarySlot(Request $request)
    {
        $rak = Rak::where('rak_address', 'like', 'T0%')
            ->orWhere('rak_address', 'like', 'T1%')->get();

        $uniqueRak = [];
        foreach ($rak as $a) {
            if (!in_array(substr($a->rak_address, 0, 3), $uniqueRak)) {
                array_push($uniqueRak, substr($a->rak_address, 0, 3));
            }
        }
        $totalTKosong = 0; //Total Rak yang kosong
        $totalTerisi = 0;
        $totalPerT = []; // Total Per T
        $rakAddress = []; // Nama Rak T
        $totalT = []; //Total keseluruhan
        foreach ($uniqueRak as $idx => $a) {
            $rak = Rak::where('rak_address', 'like', $a . '%')->get();
            $uniqueColumn = [];
            foreach ($rak as $r) {
                if (!in_array(substr($r->rak_address, 5), $uniqueColumn)) {
                    array_push($uniqueColumn, substr("$r->rak_address", 5));
                }
            }
            // Mengambil rak_address 3 karakter pertama
            foreach ($rak as $r) {
                if (!in_array(substr($r->rak_address, 0, 3), $rakAddress)) {
                    array_push($rakAddress, substr("$r->rak_address", 0, 3));
                }
            }
            $rakAddressUnique = array_unique($rakAddress);


            $uniquePartNo = [];
            foreach ($rak as $r) {
                if (!in_array($r->part_no, $uniquePartNo)) {
                    array_push($uniquePartNo, $r->part_no);
                }
            }

            $uniqueColumnList = [];
            foreach ($uniqueColumn as $i => $uc) {
                $uniqueColumnList[$i] = [];
                foreach ($rak as $r) {
                    if (substr("$r->rak_address", 5) === $uc) {
                        array_push($uniqueColumnList[$i], $r);
                    }
                }
            }
            $uniqueTingkat = [];
            foreach ($uniqueColumnList as $i => $ucl) {
                $uniqueTingkat[$i] = [];
                foreach ($ucl as $u) {
                    foreach ($uniqueColumn as $uc) {
                        if (substr($u->rak_address, 5) == $uc) {
                            if (!in_array($u->rak_address, $uniqueTingkat[$i])) {
                                array_push($uniqueTingkat[$i], $u->rak_address);
                            }
                        }
                    }
                }
            }
            $uniqueTingkatList = [];
            $groupedPartNo = [];
            foreach ($uniqueTingkat as $i => $ut) {
                $uniqueTingkatList[$i] = [];
                $groupedPartNo[$i] = [];
                foreach ($ut as $j => $u) {
                    $uniqueTingkatList[$i][intval(explode('-', $u)[1]) - 1] = [];
                    $groupedPartNo[$i][intval(explode('-', $u)[1]) - 1]  = [];
                    foreach ($rak as $r) {
                        if ($r->rak_address == $u) {
                            array_push($uniqueTingkatList[$i][intval(explode('-', $u)[1]) - 1], $r);
                            if (!in_array($r->part_no, $groupedPartNo[$i][intval(explode('-', $u)[1]) - 1])) {
                                array_push($groupedPartNo[$i][intval(explode('-', $u)[1]) - 1], $r->part_no);
                            }
                        }
                    }
                }
            }
            $longest = [];
            foreach ($uniqueTingkatList as $i => $utl) {
                $longest[$i] = 0;
                foreach ($utl as $u) {
                    if (count($u) > $longest[$i]) {
                        $longest[$i] = count($u);
                    }
                }
            }

            $filePath = public_path('sizeRak.json');
            $jsonData = File::get($filePath);
            $jsonData = json_decode($jsonData, true);

            $volumeRak = [];
            $totalJumlahKolom = 0;
            $totalKolomTerisi = 0;
            $totalTAll = 0;
            // Kosong Kolom
            foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
                $vol = 0;
                for ($i = 0; $i < $jsonData[$idx][$a][0]; $i++) {
                    $vol += $jsonData[$idx][$a][1][$i] * $jsonData[$idx][$a][2][$i];
                }
                $vol *= 2;
                array_push($volumeRak, $vol);
            }

            // Jumlah Kolom yang tersedia per T
            foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
                $totalJumlahKolom += $volumeRak[$a];
                $totalTAll += $volumeRak[$a];
            }
            // foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
            //     foreach ($uniqueTingkat as $b => $unique) {
            //         foreach ($unique as $c => $rak) {
            //             if ($rak->max_qty_box <= 6) {
            //                 $totalJumlahKolom -= $rak->max_qty_box;
            //                 $totalKolomTerisi += $rak->max_qty_box;
            //             } else {
            //                 $totalJumlahKolom -= 6;
            //                 $totalKolomTerisi += $rak->max_qty_box;
            //             }
            //             $totalTerisi += $rak->max_qty_box;
            //         }
            //     }
            // }
            foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
                for ($i = 0; $i < $jsonData[$idx][$a][0]; $i++) {
                    if (isset($uniqueTingkat[$i])) {
                        foreach ($uniqueTingkat[$i] as $c => $rak) {

                            $totalJumlahKolom -= $rak->max_qty_box;
                            $totalKolomTerisi += $rak->max_qty_box;

                            $totalTerisi += $rak->max_qty_box;
                            // if ($rak->max_qty_box <= $jsonData[$idx][$a][2][$i]) {
                            //     $totalJumlahKolom -= $rak->max_qty_box;
                            //     $totalKolomTerisi += $rak->max_qty_box;
                            // } else {
                            //     $totalJumlahKolom -= $jsonData[$idx][$a][2][$i];
                            //     $totalKolomTerisi += $rak->max_qty_box;
                            // }
                            // $totalTerisi += $rak->max_qty_box;
                        }
                    }
                }
            }

            array_push($totalPerT, $totalJumlahKolom);
            // array_push($totalPerTIsi, $totalKolomTerisi);
            array_push($totalT, $totalTAll);
            $totalTKosong += $totalJumlahKolom;
        }
        $totalPerTIsi = array_map(function ($a, $b) {
            return $a - $b;
        }, $totalT, $totalPerT);
        $totalTIsi = array_sum($totalPerTIsi);

        return response()->json([
            'totalTKosong' => $totalTKosong,
            'totalPerT' => $totalPerT,
            'totalPerTIsi' => $totalPerTIsi,
            'totalTIsi' => $totalTIsi,
            'rakAddress' => $rakAddressUnique,
            'totalT' => $totalT,
        ]);
    }
    public function summaryColumn(Request $request)
    {
        $rak = Rak::where('rak_address', 'like', 'T0%')
            ->orWhere('rak_address', 'like', 'T1%')->get();

        $uniqueRak = [];
        foreach ($rak as $a) {
            if (!in_array(substr($a->rak_address, 0, 3), $uniqueRak)) {
                array_push($uniqueRak, substr($a->rak_address, 0, 3));
            }
        }
        $totalTKosong = 0; //Total Rak yang kosong
        $totalTerisi = 0;
        $totalPerT = []; // Total Per T
        $rakAddress = []; // Nama Rak T
        $totalT = []; //Total keseluruhan
        $apc = [];
        foreach ($uniqueRak as $idx => $a) {
            $rak = Rak::where('rak_address', 'like', $a . '%')->get();
            $uniqueColumn = [];
            foreach ($rak as $r) {
                if (!in_array(substr($r->rak_address, 5), $uniqueColumn)) {
                    array_push($uniqueColumn, substr("$r->rak_address", 5));
                }
            }
            // Mengambil rak_address 3 karakter pertama
            foreach ($rak as $r) {
                if (!in_array(substr($r->rak_address, 0, 3), $rakAddress)) {
                    array_push($rakAddress, substr("$r->rak_address", 0, 3));
                }
            }
            $rakAddressUniqueKolom = array_unique($rakAddress);


            $uniquePartNo = [];
            foreach ($rak as $r) {
                if (!in_array($r->part_no, $uniquePartNo)) {
                    array_push($uniquePartNo, $r->part_no);
                }
            }

            $uniqueColumnList = [];
            foreach ($uniqueColumn as $i => $uc) {
                $uniqueColumnList[$i] = [];
                foreach ($rak as $r) {
                    if (substr("$r->rak_address", 5) === $uc) {
                        array_push($uniqueColumnList[$i], $r);
                    }
                }
            }

            $uniqueTingkat = [];
            foreach ($uniqueColumnList as $i => $ucl) {
                $uniqueTingkat[$i] = [];
                foreach ($ucl as $u) {
                    foreach ($uniqueColumn as $uc) {
                        if (substr($u->rak_address, 5) == $uc) {
                            if (!in_array($u->rak_address, $uniqueTingkat[$i])) {
                                array_push($uniqueTingkat[$i], $u->rak_address);
                            }
                        }
                    }
                }
            }
            $uniqueTingkatList = [];
            $groupedPartNo = [];
            foreach ($uniqueTingkat as $i => $ut) {
                $uniqueTingkatList[$i] = [];
                $groupedPartNo[$i] = [];
                foreach ($ut as $j => $u) {
                    $uniqueTingkatList[$i][intval(explode('-', $u)[1]) - 1] = [];
                    $groupedPartNo[$i][intval(explode('-', $u)[1]) - 1]  = [];
                    foreach ($rak as $r) {
                        if ($r->rak_address == $u) {
                            array_push($uniqueTingkatList[$i][intval(explode('-', $u)[1]) - 1], $r);
                            if (!in_array($r->part_no, $groupedPartNo[$i][intval(explode('-', $u)[1]) - 1])) {
                                array_push($groupedPartNo[$i][intval(explode('-', $u)[1]) - 1], $r->part_no);
                            }
                        }
                    }
                }
            }
            array_push($apc, $uniqueTingkatList);
            $longest = [];
            foreach ($uniqueTingkatList as $i => $utl) {
                $longest[$i] = 0;
                foreach ($utl as $u) {
                    if (count($u) > $longest[$i]) {
                        $longest[$i] = count($u);
                    }
                }
            }

            $filePath = public_path('sizeRak.json');
            $jsonData = File::get($filePath);
            $jsonData = json_decode($jsonData, true);

            $volumeRak = [];
            $totalJumlahKolom = 0;
            $totalKolomTerisi = 0;
            $totalTAll = 0;
            // Kosong Kolom
            foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
                $vol = 0;
                for ($i = 0; $i < $jsonData[$idx][$a][0]; $i++) {
                    $vol += $jsonData[$idx][$a][1][$i] * $jsonData[$idx][$a][2][$i];
                }
                $vol *= 2;
                array_push($volumeRak, $vol);
            }

            // Jumlah Kolom yang tersedia per T
            foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
                $totalJumlahKolom += $volumeRak[$a];
                $totalTAll += $volumeRak[$a];
            }
            // foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
            //     foreach ($uniqueTingkat as $b => $unique) {
            //         foreach ($unique as $c => $rak) {
            //             if ($rak->max_qty_box <= 6) {
            //                 $totalJumlahKolom -= $rak->max_qty_box;
            //                 $totalKolomTerisi += $rak->max_qty_box;
            //             } else {
            //                 $totalJumlahKolom -= 6;
            //                 $totalKolomTerisi += $rak->max_qty_box;
            //             }
            //             $totalTerisi += $rak->max_qty_box;
            //         }
            //     }
            // }
            foreach ($uniqueTingkatList as $a => $uniqueTingkat) {
                for ($i = 0; $i < $jsonData[$idx][$a][0]; $i++) {
                    if (isset($uniqueTingkat[$i])) {
                        foreach ($uniqueTingkat[$i] as $c => $rak) {

                            $totalJumlahKolom -= $rak->max_qty_box;
                            $totalKolomTerisi += $rak->max_qty_box;

                            $totalTerisi += $rak->max_qty_box;
                            // if ($rak->max_qty_box <= $jsonData[$idx][$a][2][$i]) {
                            //     $totalJumlahKolom -= $rak->max_qty_box;
                            //     $totalKolomTerisi += $rak->max_qty_box;
                            // } else {
                            //     $totalJumlahKolom -= $jsonData[$idx][$a][2][$i];
                            //     $totalKolomTerisi += $rak->max_qty_box;
                            // }
                            // $totalTerisi += $rak->max_qty_box;
                        }
                    }
                }
            }

            array_push($totalPerT, $totalJumlahKolom);
            // array_push($totalPerTIsi, $totalKolomTerisi);
            array_push($totalT, $totalTAll);
            $totalTKosong += $totalJumlahKolom;
        }
        // dd($apc);
        $kosongKolom = [];
        $terisiKolom = [];
        $jumlahKolomAllPerT = [];
        $jumlahKolomAll = 0;
        for ($i = 0; $i < count($uniqueRak); $i++) {
            $jumlahKosongRakSatuKolom = 0;
            $jumlahTerisiRakSatuKolom = 0;
            foreach ($apc[$i] as $a => $until) {
                // Tingkat
                for ($b = $jsonData[$i][$a][0] - 1; $b >= 0; $b--) {
                    // Kolom
                    for ($c = 0; $c < $jsonData[$i][$a][2][$b]; $c++) {
                        if (isset($until[$b]) && isset($until[$b][$c])) {
                            $jumlahTerisiRakSatuKolom++;
                            $temp = 0;
                            for ($e = 0; $e < 2; $e++) {
                                for ($f = 0; $f < $jsonData[$i][$a][1][$b]; $f++) {
                                    if ($temp >= ($jsonData[$i][$a][1][$b] * 2) - $until[$b][$c]->max_qty_box) {
                                    } else {
                                    }
                                    $temp++;
                                }
                            }
                        } else {
                            $jumlahKosongRakSatuKolom++;
                            for ($e = 0; $e < 2; $e++) {
                                for ($f = 0; $f < $jsonData[$i][$a][1][$b]; $f++) {
                                }
                            }
                        }
                    }
                }
            }
            $kosongKolom[$i] = $jumlahKosongRakSatuKolom;
            $terisiKolom[$i] = $jumlahTerisiRakSatuKolom;
            $jumlahKolomAllPerT[$i] = $kosongKolom[$i] + $terisiKolom[$i];
        }
        $jumlahKosongKolom = array_sum($kosongKolom);
        $jumlahTerisiKolom = array_sum($terisiKolom);
        return response()->json([
            'kosongKolom' => $kosongKolom,
            'terisiKolom' => $terisiKolom,
            'jumlahKosongKolom' => $jumlahKosongKolom,
            'rakAddressKolom' => $rakAddressUniqueKolom,
            'jumlahTerisiKolom' => $jumlahTerisiKolom,
            'jumlahKolomAllPerT' => $jumlahKolomAllPerT,
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $raks = new Rak;
        $raks->code_no = $request->code_no;
        $raks->part_no = $request->part_no;
        $raks->rak_address = $request->rak_address;
        $raks->min_qty = $request->min_qty;
        $raks->min_packing = $request->min_packing;
        $raks->unit = $request->unit;
        $raks->part_group = $request->part_group;
        $raks->lead_time_by_air = $request->lead_time_by_air;
        $raks->lead_time_by_sea = $request->lead_time_by_sea;
        $raks->max_stock = $request->max_stock;
        $raks->min_stock = $request->min_stock;
        $raks->max_qty_box = ceil($request->max_stock / $request->min_packing);
        $raks->save();

        toast('Berhasil Menambahkan Data 👌', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function show(Rak $rak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function edit(Rak $rak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rak_id)
    {
        $raks = Rak::findOrFail($rak_id);
        $raks->update($request->all());
        toast('Berhasil Update Data 👌', 'success');;
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function destroy($rak_id)
    {
        Rak::destroy($rak_id);
        toast('Data berhasil dihapus 👌', 'success');
        return back();
    }

    public function deleteAll()
    {
        Rak::query()->truncate();
        toast('Data berhasil dihapus 👌', 'success');
        return back();
    }
    public function export_excel()
    {
        return Excel::download(new RaksExport, 'data-rak-' . Carbon::now()->translatedFormat('l, j F Y H:i:s') . '.xlsx');
    }

    public function import_excel(Request $request)
    {
        Rak::truncate();
        Excel::import(new RaksImport, $request->file('fileRak'));
        // Ambil data rak sesuai dengan pilihan dari database atau sumber data lainnya
        $rak = Rak::where('rak_address', 'like', 'T0%')
            ->orWhere('rak_address', 'like', 'T1%')
            ->get();
        $uniqueColumn = [];
        foreach ($rak as $r) {
            if (!in_array(substr($r->rak_address, 5), $uniqueColumn)) {
                array_push($uniqueColumn, substr("$r->rak_address", 5));
            }
        }

        $uniquePartNo = [];
        foreach ($rak as $r) {
            if (!in_array($r->part_no, $uniquePartNo)) {
                array_push($uniquePartNo, $r->part_no);
            }
        }

        $uniqueColumnList = [];
        foreach ($uniqueColumn as $i => $uc) {
            $uniqueColumnList[$i] = [];
            foreach ($rak as $r) {
                if (substr("$r->rak_address", 5) === $uc) {
                    array_push($uniqueColumnList[$i], $r);
                }
            }
        }
        $uniqueTingkat = [];
        foreach ($uniqueColumnList as $i => $ucl) {
            $uniqueTingkat[$i] = [];
            foreach ($ucl as $u) {
                foreach ($uniqueColumn as $uc) {
                    if (substr($u->rak_address, 5) == $uc) {
                        if (!in_array($u->rak_address, $uniqueTingkat[$i])) {
                            array_push($uniqueTingkat[$i], $u->rak_address);
                        }
                    }
                }
            }
        }
        $filePath = public_path('sizeRak.json');
        $jsonData = File::get($filePath);
        $jsonData = json_decode($jsonData, true);

        $highestValues = []; // Inisialisasi array untuk menyimpan nilai tertinggi dari setiap kelompok
        $part = [];
        // Iterasi melalui setiap array dalam $uniqueTingkat
        foreach ($uniqueTingkat as $array) {
            // Iterasi melalui setiap string dalam array saat ini
            foreach ($array as $tingkat) {
                // dd($tingkat);
                // Pisahkan string menjadi bagian-bagian berdasarkan tanda '-'
                $parts = explode('-', $tingkat);
                $part[] = explode('-', $tingkat);;
                // Ambil kelompok pertama sebagai kunci untuk array nilai tertinggi
                $groupKey = $parts[0];

                // Ambil dua digit terakhir
                $lastTwoDigits = intval(end($parts));

                // Periksa apakah dua digit terakhir dimulai dengan '0'
                if ($lastTwoDigits >= 10) {
                    // Jika dua digit terakhir lebih besar dari atau sama dengan 10,
                    // maka gunakan angka tersebut
                    $highestValues[$groupKey] = $lastTwoDigits;
                } else {
                    // Jika dua digit terakhir kurang dari 10, hilangkan '0' di depan (jika ada) dan gunakan angka yang tersisa
                    $highestValues[$groupKey] = intval(ltrim(end($parts), '0'));
                }
                // Perbarui nilai tertinggi jika diperlukan
                if (!isset($highestValues[$groupKey]) || intval($lastTwoDigits) > $highestValues[$groupKey]) {
                    $highestValues[$groupKey] = $lastTwoDigits;
                }
            }
        }

        // Iterasi melalui JSON
        foreach ($highestValues as $key => $value) {
            // Mendapatkan indeks dari JSON berdasarkan kunci yang sesuai
            $jsonIndex = intval(substr($key, 1)) - 1;

            // Mengambil nilai JSON dari indeks yang sesuai
            $jsonValue = $jsonData[$jsonIndex];

            // Memeriksa apakah nilai JSON adalah array
            if (is_array($jsonValue)) {

                // Memeriksa apakah jumlah elemen baru perlu ditambahkan jika kurang dari $value
                $countToAdd = $value - count($jsonValue);
                for ($i = 0; $i < $countToAdd; $i++) {
                    $jsonValue[] = [$jsonValue[0][0], $jsonValue[0][1], $jsonValue[0][2]]; // Gunakan elemen pertama sebagai template
                }

                // Memperbarui nilai JSON dengan nilai yang sesuai dari $highestValues
                $jsonData[$jsonIndex] = $jsonValue;
            }
        }


        // untuk save
        file_put_contents('sizeRak.json', json_encode($jsonData));

        toast('Berhasil Menambahkan Data 👌', 'success');
        return back();
    }
    public function downloadTemplate()
    {
        $filePath = 'template-import-data/template-data-rak.xlsx';
        $filename = 'template-data-rak.xlsx';

        return response()->file(storage_path("app/public/{$filePath}"), [
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
    public function getData()
    {
        $no = 1;
        $rak = Rak::select(['id', 'code_no', 'part_no', 'rak_address', 'min_qty', 'min_packing', 'unit', 'part_group', 'lead_time_by_air', 'lead_time_by_sea', 'max_stock', 'min_stock', 'max_qty_box'])
            ->where(function ($query) {
                $query->where('rak_address', 'like', 'T0%')
                    ->orWhere('rak_address', 'like', 'T1%');
            })
            ->orderBy('rak_address');

        return DataTables::of($rak)
            ->editColumn('id', function ($rak) use (&$no) {
                return '<h6 class="mb-0 text-sm">' . $no++ . '</h6>';
            })
            ->editColumn('code_no', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->code_no . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('part_no', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->part_no . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('rak_address', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->rak_address . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('min_qty', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->min_qty . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('min_packing', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->min_packing . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('unit', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->unit . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('part_group', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->part_group . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('lead_time_by_air', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->lead_time_by_air . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('lead_time_by_sea', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->lead_time_by_sea . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('max_stock', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->max_stock . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('min_stock', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->min_stock . '</h6>
                            </div>
                        </div>';
            })
            ->editColumn('max_qty_box', function ($rak) {
                return '<div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $rak->max_qty_box . '</h6>
                            </div>
                        </div>';
            })
            ->addColumn('action', function ($rak) {
                if (auth()->user()->role_id == 1) {
                    $detailModal = view('rak.modal.detail_rak', ['rak' => $rak])->render();
                    $updateModal = view('rak.modal.update_rak', ['rak' => $rak])->render();

                    return '
                    <div
                        class="d-flex px-3 ps-2 py-1 justify-content-center align-items-center gap-1"><button class="btn btn-outline-dark btn-xs" data-bs-toggle="modal" data-bs-target="#detailDataRak-' . $rak->id . '">
                                <i class="fa fa-info text-dark"></i>
                            </button>
                            ' . $detailModal . '
                            <button class="btn btn-outline-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateDataRak-' . $rak->id . '">
                                <i class="fa fa-pencil text-primary cursor-pointer"></i>
                            </button>
                            ' . $updateModal . '
                            <form action="' . route('rak.destroy', $rak->id) . '" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button type="submit" class="btn btn-outline-danger btn-xs confirm-delete">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>
                            </form>
                    </div> ';
                } else {
                    return '';
                }
            })

            ->rawColumns(['id', 'code_no', 'part_no', 'rak_address', 'min_qty', 'min_packing', 'unit', 'part_group', 'lead_time_by_air', 'lead_time_by_sea', 'max_stock', 'min_stock', 'max_qty_box', 'action'])
            ->make(true);
    }
}
