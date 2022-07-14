<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\NilaiKaryawan;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DataKaryawanController extends Controller
{
    public function index()
    {
        $no = 0;
        $dataKriteria = Kriteria::all();
        $dataKaryawan = NilaiKaryawan::oldest()->simplePaginate(10);
        $title = "Data Karyawan";
        return view('seleksi.index', compact('dataKaryawan','no','title','dataKriteria'));
    }

    public function create()
    {
        $title = "Data Karyawan";
        $kriteria = Kriteria::all();
        return view('seleksi.create', compact('title','kriteria'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $karyawan = Karyawan::all();
        $i = 0;
        $kriteria = Kriteria::all();
        foreach($kriteria as $data)
        {
            $kriteriaName = str_replace(" ", "_",$data->name);
            if($request->$kriteriaName >= 95){
                $nilai[$i] = 5;
            }else if($request->$kriteriaName >= 80){
                $nilai[$i] = 4;
            }else if($request->$kriteriaName >= 70){
                $nilai[$i] = 3;
            }else if($request->$kriteriaName >= 60){
                $nilai[$i] = 2;
            }else{
                $nilai[$i] = 1;
            }
            $karyawan_id[$i] = $request->$kriteriaName."_id";
            $i++;
        }
        // dd($nilai);
        $validateDataKaryawan = $request->validate([
            'name'  =>  'required|unique:karyawans,name',
            'tgl_lahir' =>  'required',
            'alamat'    =>  'required'
        ]);
        // dd($nilai);
        $resultNilai = implode(",", $nilai);
        // dd($resultNilai);

        Karyawan::create($validateDataKaryawan);

        $id_karyawan = Karyawan::where('name', $request->name)->select('id')->get();
        // $id_karyawan = Karyawan::findOrFail($request->name);
        foreach($id_karyawan as $data){
            // dd($id_karyawan);
            $_id = $data->id;
        }
        NilaiKaryawan::create(['id_karyawan' => $_id, 'nilai' => $resultNilai]);

        return redirect()->route('data-karyawan.index')->with('success', 'data karyawan berhasil ditambahkan!');
    }

    public function show($id){
        $dataKaryawan = NilaiKaryawan::findOrFail($id);
        $nilai = explode(",",$dataKaryawan->nilai);
        $kriteria = Kriteria::all();
        $i = 0;
        $title = "Data Karyawan";
        // dd($nilai);

        return view('seleksi.show', compact('dataKaryawan','nilai','kriteria','i','title'));
    }

    public function edit($id)
    {
        $dataKaryawan = NilaiKaryawan::findOrFail($id);
        $nilai = explode(",",$dataKaryawan->nilai);
        $kriteria = Kriteria::all();
        $i = 0;
        $title = "Data Karyawan";
        // dd($nilai);

        return view('seleksi.edit', compact('dataKaryawan','nilai','kriteria','i','title'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $dataNilai = NilaiKaryawan::findOrFail($id);
        $kriteria = Kriteria::all();
        $i = 0;

        foreach($kriteria as $data)
        {
            $kriteriaName = str_replace(" ", "_",$data->name);
            $nilai[$i] = $request->$kriteriaName;
            $i++;
        }
        $resultNilai = implode(",",$nilai);
        $rules = [
            'tgl_lahir' => 'required',
            'alamat'    => 'required'
        ];
        if($dataNilai->karyawan->name != $request->name){
            $rules = ['name'  =>  'required|unique:karyawans,name'];
        }
        $validateDataKaryawan = $request->validate($rules);
        // dd($validateDataKaryawan);
        NilaiKaryawan::where('id', $dataNilai->id)->update(['nilai'=>$resultNilai]);
        Karyawan::where('id', $dataNilai->id_karyawan)->update($validateDataKaryawan);

        return redirect()->route('data-karyawan.index')->with('success', 'Data berhasil diubah!');

    }

    public function destroy($id)
    {
        $dataNilai = NilaiKaryawan::findOrFail($id);
        $dataKaryawan = Karyawan::findOrFail($dataNilai->karyawan->id);
        $dataNilai->delete();
        $dataKaryawan->delete();

        return redirect()->route('data-karyawan.index')->with('success', 'Data berhasil dihapus!');
    }

    public function deleteAll()
    {
        $dataNilai = NilaiKaryawan::all();

        foreach($dataNilai as $data)
        {
            $idNilai = $data->id;
            $idKaryawan = $data->karyawan->id;
            $deleteNilai = NilaiKaryawan::findOrFail($idNilai);
            $deleteKaryawan = Karyawan::findOrFail($idKaryawan);
            $deleteNilai->delete();
            $deleteKaryawan->delete();
        }

        return redirect()->route('data-karyawan.index')->with('success', 'Data Calon Pegawai berhasi dihapus semua!');
    }
}
