<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\KriteriaParent;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $no = 1;
        $kriteria = Kriteria::oldest()->simplePaginate(5);
        return view('admin.kriteria.index', compact('kriteria','no'));
    }

    public function create()
    {
        $parents = KriteriaParent::all();
        return view('admin.kriteria.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'  =>  'required|unique:kriterias,name',
            'id_parent'   =>  'required',
            'kelompok'  =>  'required'
        ]);

        Kriteria::create($validateData);
        return redirect()->route('kriteria.index')->with('success','Data Kriteria Berhasil Ditambahkan!');
    }

    public function edit(Kriteria $kriteria)
    {   
        dd($kriteria);
        // $kriteria = Kriteria::findOrFail($id);
        $parents = KriteriaParent::all();
        return view('admin.kriteria.edit', compact('kriteria','parents'));
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $rules = [
            'id_parent' =>  'required',
            'kelompok'  =>  'required'
        ];

        if($request->name != $kriteria->name){
            $rules['name'] = 'required|unique:kriterias,name';
        }
        $validateData = $request->validate($rules);
        Kriteria::where('id', $kriteria->id)->update($validateData);
        return redirect()->route('kriteria.index')->with('success', 'Data Berhasil di Ubah!');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Data Berhasil di hapus!');
    }
}
