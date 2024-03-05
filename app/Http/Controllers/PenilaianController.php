<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\KurikulumInstrumen;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class PenilaianController extends Controller
{
    public function index()
    {
        $auditors = User::where('role', 'Auditor')->get();
        $kurikulums = KurikulumInstrumen::where('is_aktif', '1')->get();

        return view('backend.penilaian_ami.index', [
            'auditors' => $auditors,
            'kurikulums' => $kurikulums,
        ]);
    }

    public function detail($id)
    {

        // $data = DB::table('jadwal_amis as ja')
        //     ->leftjoin('kurikulum_instrumens as ki', 'ki.id', '=', 'ja.kurikulum_instrumen_id')
        //     ->leftjoin('butir_instrumens as bi', 'bi.kurikulum_instrumen_id', '=', 'ki.id')
        //     // ->leftjoin('grup_instrumens as gi', 'gi.id', '=', 'bi.grup_instrumen_id')
        //     ->leftjoin('jawabans as j', 'j.butir_instrumen_id', '=', 'bi.id')
        //     // ->leftjoin('jawabans as j', 'j.jadwal_ami_id', '=', 'ja.id')
        //     ->select(
        //         'ja.id as jadwal_ami_id',
        //         // 'ja.kurikulum_instrumen_id',
        //         'bi.nama_instrumen',
        //         // 'bi.id as butir_instrumen_id',
        //         // 'bi.grup_instrumen_id',
        //         // 'bi.kode_instrumen',
        //         // 'gi.nama_grup_instrumen',
        //         'j.skor'

        //     )
        //     ->where('ja.id', $id)
        //     ->get();

        $data = DB::table('jadwal_amis as ja')
            ->leftjoin('kurikulum_instrumens as ki', 'ki.id', '=', 'ja.kurikulum_instrumen_id')
            ->leftjoin('butir_instrumens as bi', 'bi.kurikulum_instrumen_id', '=', 'ki.id')
            ->leftjoin('grup_instrumens as gi', 'gi.id', '=', 'bi.grup_instrumen_id')
            ->leftjoin('jawabans as j', function ($join) {
                $join->on('j.butir_instrumen_id', '=', 'bi.id')
                    ->whereColumn('j.jadwal_ami_id', '=', 'ja.id'); // Make sure to match jadwal_ami_id
            })
            ->select(
                'ja.id as jadwal_ami_id',
                'ja.kurikulum_instrumen_id',
                'bi.nama_instrumen',
                'bi.id as butir_instrumen_id',
                'bi.grup_instrumen_id',
                'bi.kode_instrumen',
                'gi.nama_grup_instrumen',
                'j.skor'
            )
            ->where('ja.id', $id)
            ->get();


        // dd($data);

        $jadwal_amis = DB::table('jadwal_amis')
            ->select('jadwal_amis.*', 'users.name as name', 'auditor1.name as auditor1', 'auditor2.name as auditor2', 'auditor3.name as auditor3', 'kurikulum_instrumens.nama_kurikulum')
            ->leftJoin('users as users', 'users.id', 'jadwal_amis.input_oleh')
            ->leftJoin('users as auditor1', 'auditor1.id', 'jadwal_amis.auditor_satu')
            ->leftJoin('users as auditor2', 'auditor2.id', 'jadwal_amis.auditor_dua')
            ->leftJoin('users as auditor3', 'auditor3.id', 'jadwal_amis.auditor_tiga')
            ->leftJoin('kurikulum_instrumens', 'kurikulum_instrumens.id', 'jadwal_amis.kurikulum_instrumen_id')
            ->where('jadwal_amis.id', $id);


        $jadwal_amis = $jadwal_amis->first();

        return view('backend.penilaian_ami.detail', [
            'data' => $data,
            'jadwal' => $jadwal_amis
        ]);
    }

    public function data($id)
    {

        $butir_instrumens = DB::table('butir_instrumens')
            ->select('butir_instrumens.*', 'users.name', 'grup_instrumens.nama_grup_instrumen', 'kurikulum_instrumens.nama_kurikulum')
            ->leftJoin('grup_instrumens', 'grup_instrumens.id', 'butir_instrumens.grup_instrumen_id')
            ->leftJoin('kurikulum_instrumens', 'kurikulum_instrumens.id', 'butir_instrumens.kurikulum_instrumen_id')
            ->leftJoin('users', 'users.id', 'butir_instrumens.insert_by')
            ->where('butir_instrumens.kurikulum_instrumen_id', $id);

        $butir_instrumens = $butir_instrumens->get();

        return response()->json(['data' => $butir_instrumens]);
    }

    public function store(Request $request)
    {

        Jawaban::UpdateOrcreate(
            [
                'jadwal_ami_id' => $request->jadwal_ami_id,
                'butir_instrumen_id' => $request->butir_instrumen_id
            ],
            [
                'jadwal_ami_id' => $request->jadwal_ami_id,
                'butir_instrumen_id' => $request->butir_instrumen_id,
                'grup_instrumen_id' => $request->grup_instrumen_id,
                'kurikulum_instrumen_id' => $request->kurikulum_instrumen_id,
                'skor' => $request->skor,
                'create_oleh' => Auth::id()
            ]
        );

        return back();
    }
}
