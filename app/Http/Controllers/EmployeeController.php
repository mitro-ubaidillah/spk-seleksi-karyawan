<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $title = "pegawai";
        return view('employee.index', compact('title'));
    }

    public function kriteria()
    {
        $no = 0;
        $title = "kriteria";
        $kriteria = Kriteria::oldest()->simplePaginate(5);
        return view('employee.kriteria', compact('kriteria', 'no', 'title'));
    }

    public function bobot()
    {
        $title = "Nilai Standar";
        $no = 0;
        $bobot = Bobot::oldest()->simplePaginate(5);
        return view('employee.bobot', compact('bobot','no','title'));
    }
}
