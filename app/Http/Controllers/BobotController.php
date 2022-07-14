<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\KriteriaParent;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    public function index()
    {
        $no = 1;
        $title = "nilai standar";
        $bobot = Bobot::oldest()->simplePaginate(5);
        return view('admin.bobot.index', compact('bobot','no','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "nilai standar";
        $kriteria = Kriteria::all();
        $parent = KriteriaParent::all();
        return view('admin.bobot.create', compact('kriteria','title','parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->all());
        $i = 0;
        $kriteria = Kriteria::all();
        foreach ($kriteria as $data) {
            $id = str_replace(" ","_",$data->name).'_id';
            $nilai = str_replace(" ","_",$data->name).'_nilai';
            $data = [
                'kriteria_id'   => $request->$id,
                'nilai_ideal'   =>  $request->$nilai
            ];
            $validate = $request->validate([
                'kriteria_id' => 'unique:bobots,id_kriteria'
            ]);
            if($validate){
                Bobot::create($data);
            }
            // $data_id[$i++] = $request->$id;
        }
        // dd($data_id);
        if($validate){
            return redirect()->route('bobot.index')->with('success', 'Data berhasil update!');
        }else{
            return redirect()->route('bobot.index')->with('error', 'Data sudah ada!');
        }
    }
    public function edit($id)
    {
        $bobot = Bobot::findOrFail($id);
        $kriteria = Kriteria::all();
        $title = "nilai standar";
        return view('admin.bobot.edit', compact('bobot', 'kriteria', 'title'));
    }

    public function update(Request $request, $id)
    {
        $bobot = Bobot::findOrFail($id);
        $rules = ['nilai_ideal' => 'required'];

        if($request->kriteria_id != $bobot->kriteria_id){
            $rules['kriteria_id'] = 'required|unique:bobots,kriteria_id';
        }

        $validateData = $request->validate($rules);
        $update = Bobot::where('id', $bobot->id)->update($validateData);

        if($update)
        {
            return redirect()->route('bobot.index')->with('success', 'Data berhasil diubah!');
        }else
        {
            return redirect()->route('bobot.index')->with('error', 'Data gagal diubah!');
        }
    }

    public function destroy($id)
    {
        $bobot = Bobot::findOrFail($id);
        $bobot->delete();
        return redirect()->route('bobot.index')->with('success', 'Data berhasil dihapus!');

    }
}
