<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\HasilSeleksi;
use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\KriteriaParent;
use App\Models\NilaiKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;

class SeleksiPegawaiController extends Controller
{
    public function index()
    {
        $no = 0;
        $dataKriteria = Kriteria::all();
        $dataKaryawan = NilaiKaryawan::oldest()->simplePaginate(10);
        $title = "Seleksi Calon Pegawai";
        return view('seleksi.indexSeleksi', compact('dataKaryawan','no','title','dataKriteria'));
    }

    public function seleksi()
    {
        $title = "Seleksi Calon Pegawai";
        $dataNilai = NilaiKaryawan::all();
        $dataKaryawan = Karyawan::all();
        $parents = KriteriaParent::all();
        $nilaiIdeal = Bobot::all();
        $oldRangking = HasilSeleksi::all();
        $no = 0;
        
        foreach ($dataNilai as $data) {
            $i = 0;
            $nilai = explode(",",$data->nilai);
            $kriteria_id = explode(",", $data->kriteria_id);
            foreach($nilaiIdeal as $item){
                // dd(count($nilaiIdeal));
                if($kriteria_id[$i] == $item->kriteria_id){
                    switch ($nilai[$i] - $item->nilai_ideal) {
                        case 0:
                            $gap[$data->karyawan->name][$i] = [5,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case 1:
                            $gap[$data->karyawan->name][$i] = [4.5,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case -1:
                            $gap[$data->karyawan->name][$i] = [4,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case 2:
                            $gap[$data->karyawan->name][$i] = [3.5,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case -2:
                            $gap[$data->karyawan->name][$i] = [3,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case 3:
                            $gap[$data->karyawan->name][$i] = [2.5,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case -3:
                            $gap[$data->karyawan->name][$i] = [2,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        case 4:
                            $gap[$data->karyawan->name][$i] = [1.5,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                        default:
                            $gap[$data->karyawan->name][$i] = [1,$item->kriteria->name,$item->kriteria->kriteriaParent->name,$item->kriteria->kelompok];
                            break;
                    }
                }
                $i++;
            }
        }
        // dd($gap);
        $temp = 0;
        foreach($parents as $parent){   
            foreach ($gap as $key => $value) {
                $i = 0;
                $nilaiCF[$key][$parent->name.'_utama'] = 0;
                $nilaiSF[$key][$parent->name.'_sekunder'] = 0;
                $totalCF = 0;
                $totalSF = 0;
                foreach ($nilaiIdeal as $data) {
                    // $x+=1;
                    if($value[$i][2] == $parent->name){
                        if($value[$i][3] == "utama"){
                            $nilaiCF[$key][$parent->name.'_utama'] += $value[$i][0];
                            $totalCF+=1;
                        }else{
                            $nilaiSF[$key][$parent->name.'_sekunder'] += $value[$i][0];
                            $totalSF+=1;
                        }
                    }
                    $i++;
                }
                $result[$key][$parent->name] = ((($nilaiCF[$key][$parent->name.'_utama']/$totalCF) / 60) * 100) + (($nilaiSF[$key][$parent->name.'_sekunder']/$totalSF) / 40) * 100;
                $finalResult[$key][$temp] = (($result[$key][$parent->name] / $parent->alokasi)*100);
            }
            $temp++;
        }
        // dd($finalResult);
        foreach($dataNilai as $item){
            $i = 0;
            $totalFinalResult[$item->karyawan->name] = 0;
            foreach($finalResult as $key => $data){
                // dd($data);
                // dd($data[$i]);
                if($key == $item->karyawan->name){
                    $totalFinalResult[$key] = $data[$i] + $data[++$i];
                }
            }
        }
        $i = 0;
        arsort($totalFinalResult);
        if(count($oldRangking) != 0){
            foreach($oldRangking as $old){
                $oldName[$i++] = $old->name;
            }
            $temp = 0;
            foreach($totalFinalResult as $x => $x_value){
                $rangking[$x] = [$x_value];
                if($oldName[$temp++] != $x){
                    HasilSeleksi::create(['name'=>$x, 'nilai'=>$x_value]);
                }
            }
        }else{
            foreach($totalFinalResult as $x => $x_value){
                $rangking[$x] = [$x_value];
                HasilSeleksi::create(['name'=>$x, 'nilai'=>$x_value]);
            }
        }


        // dd($rangking);
        return view('seleksi.hasil', compact('rangking','dataKaryawan','no','title'));
    }

    public function cetak()
    {
        $rangking = HasilSeleksi::all();
        $dataKaryawan = Karyawan::all();
        $no = 0;
        $title = "Seleksi Calon Pegawai";

        $data = PDF::loadview('seleksi.cetak',compact('dataKaryawan','no','rangking'));
        return $data->download('laporan.pdf');
    }

    public function deleteAll()
    {
        $rangking = HasilSeleksi::all();
        foreach($rangking as $data){
            $id = $data->id;
            $deleteData = HasilSeleksi::findOrFail($id);
            $deleteData->delete();
        }
        
        return redirect('/seleksi-karyawan')->with('success','Data Perangkingan berhasil dihapus');
    }
} 
