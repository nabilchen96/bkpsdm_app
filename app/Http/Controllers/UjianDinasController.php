<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\UjianDinas;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class UjianDinasController extends Controller
{
    public function index()
    {
        return view('backend.ujian_dinas.index');
    }

    public function data()
    {

        $user = DB::table('ujian_dinas')->leftJoin('pegawais', 'pegawais.id', '=', 'ujian_dinas.id_pegawai')
            ->select('ujian_dinas.*', 'pegawais.nama', 'pegawais.nip');

        $data_user = Auth::user();
        $user = $user->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            //FILE
            if ($request->file) {
                $file = time() . '.' . $request->file->extension();
                $request->file->move(public_path('file'), $file);
            }

            if ($request->foto) {
                $foto = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('foto'), $foto);
            }

            $data = UjianDinas::create([
                'id_pegawai' => $request->id_pegawai,
                'pangkat_golongan' => $request->pangkat_golongan,
                'jabatan' => $request->jabatan,
                'unit_kerja' => $request->unit_kerja,
                'instansi' => $request->instansi,
                'jenis_ujian' => $request->jenis_ujian,
                'file' => $file ?? null,
                'foto' => $foto ?? null,
                'keterangan' => $request->keterangan
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $ujian = UjianDinas::find($request->id);

            //FILE
            if ($request->file) {
                $file = time() . '.' . $request->file->extension();
                $request->file->move(public_path('file'), $file);
            }

            if ($request->foto) {
                $foto = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('foto'), $foto);
            }

            $data = $ujian->update([
                'id_pegawai' => $request->id_pegawai,
                'pangkat_golongan' => $request->pangkat_golongan,
                'jabatan' => $request->jabatan,
                'unit_kerja' => $request->unit_kerja,
                'instansi' => $request->instansi,
                'jenis_ujian' => $request->jenis_ujian,
                'file' => $ujian->file ?? $file ?? null,
                'foto' => $ujian->foto ?? $foto ?? null,
                'keterangan' => $request->keterangan
            ]);

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = UjianDinas::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function export(Request $request)
    {

        $kategori = Request('jenis_ujian');
        $tanggal_awal = Carbon::createFromFormat('Y-m-d', $request->tanggal_awal)->startOfDay();
        $tanggal_akhir = Carbon::createFromFormat('Y-m-d', $request->tanggal_akhir)->endOfDay();


        if($kategori == 'Semua'){
            $data = DB::table('ujian_dinas')
                    ->leftJoin('pegawais', 'pegawais.id', '=', 'ujian_dinas.id_pegawai')
                    ->whereBetween('ujian_dinas.created_at', [$tanggal_awal, $tanggal_akhir])
                    ->select(
                        'pegawais.nama', 
                        'pegawais.nip',
                        'ujian_dinas.*'
                    )
                    ->get();
        }else{
            $data = DB::table('ujian_dinas')
                    ->leftJoin('pegawais', 'pegawais.id', '=', 'ujian_dinas.id_pegawai')
                    ->where('jenis_ujian', $kategori)
                    ->whereBetween('ujian_dinas.created_at', [$tanggal_awal, $tanggal_akhir])
                    ->select(
                        'pegawais.nama', 
                        'pegawais.nip',
                        'ujian_dinas.*'
                    )
                    ->get();
        }

        $instansi = DB::table('instansis')->first();

        $laporan = Pdf::loadview('backend.ujian_dinas.export_pdf', [
            'data' => $data, 
            'instansi' => $instansi
        ])->setPaper('a4', 'landscape');

        // laporan.pdf
        return $laporan->stream('Laporan Ujian Dinas.pdf');

        // return view('backend.ujian_dinas.export_pdf', [
        //     'data' => $data, 
        //     'instansi' => $instansi
        // ]);
    }
}
