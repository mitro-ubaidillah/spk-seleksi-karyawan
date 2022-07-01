<?php

namespace App\Http\Controllers;


use App\Models\KriteriaParent;
use Illuminate\Http\Request;

class ParentKriteriaController extends Controller
{
    public function index()
    {
        $parents = KriteriaParent::oldest()->simplePaginate(5);
        $no = 1;
        return view('admin.kriteria.createKelompok', compact('parents','no'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'  =>  'required|unique:kriteria_parents,name'
        ]);

        KriteriaParent::create($validateData);
        return redirect()->route('kriteria-parent.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $parent = KriteriaParent::findOrFail($id);
        // $title = "Ubah Kriteria";
        return view('admin.kriteria.editKelompok', compact('parent'));
    }

    public function update(Request $request, $id)
    {
        $parent = KriteriaParent::findOrFail($id);
        if($request->name != $parent->name){
            $validateData = $request->validate([
                'name'  => 'required|unique:kriteria_parents,name'
            ]);
        }
        KriteriaParent::where('id', $parent->id)->update($validateData);
        return redirect()->route('kriteria-parent.index')->with('success', 'Data Berhasil di Ubah!');
    }

    public function destroy($id)
    {
        $parent = KriteriaParent::findOrFail($id);
        $parent->delete();
        return redirect()->route('kriteria-parent.index')->with('success', 'Data Berhasil di hapus!');
    }
}
