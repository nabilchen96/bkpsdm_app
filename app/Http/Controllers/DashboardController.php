<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $pegawai = DB::table('pegawais')->count();
        $pi = DB::table('ujian_dinas')->where('jenis_ujian', 'Penyesuaian Ijazah')->count();
        $pr = DB::table('ujian_dinas')->where('jenis_ujian', 'Pindah Ruang')->count();
        $prajab = DB::table('prajabatans')->count();

        return view('backend.dashboard', [
            'pegawai' => $pegawai, 
            'pi' => $pi, 
            'pr' => $pr, 
            'prajab' => $prajab
        ]);
    }
}