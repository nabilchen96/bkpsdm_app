<?php

namespace App\Http\Controllers;

use App\Models\Prajabatan;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Carbon\Carbon;

class PrajabatanController extends Controller
{
    public function index()
    {
        return view('backend.prajabatan.index');
    }

    public function data()
    {

        $user = DB::table('prajabatans')->leftJoin('pegawais', 'pegawais.id', '=', 'prajabatans.id_pegawai')
            ->select('prajabatans.*', 'pegawais.nama', 'pegawais.nip');

        $data_user = Auth::user();
        $user = $user->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required',
            'file' => 'nullable|mimes:pdf',
            'foto' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessages = '';

            //LAKUKAN PERULANGAN ERROR UNTUK DIGABUNG
            foreach ($errors as $k => $error) {
                $errorMessages .= $error . ", ";
            }

            $data = [
                'responCode' => 0,
                'respon' => 'Gagal menyimpan data dengan alasan. ' . rtrim($errorMessages, ', ')
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

            $data = Prajabatan::create([
                'id_pegawai' => $request->id_pegawai,
                'pangkat_golongan' => $request->pangkat_golongan,
                'jabatan' => $request->jabatan,
                'unit_kerja' => $request->unit_kerja,
                'instansi' => $request->instansi,
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
            'id' => 'required',
            'file' => 'nullable|mimes:pdf',
            'foto' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessages = '';

            //LAKUKAN PERULANGAN ERROR UNTUK DIGABUNG
            foreach ($errors as $k => $error) {
                $errorMessages .= $error . ", ";
            }

            $data = [
                'responCode' => 0,
                'respon' => 'Gagal menyimpan data dengan alasan. ' . rtrim($errorMessages, ', ')
            ];
        } else {

            $ujian = Prajabatan::find($request->id);

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

        $data = Prajabatan::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function export(Request $request)
    {
        $tanggal_awal = Carbon::createFromFormat('Y-m-d', $request->tanggal_awal)->startOfDay();
        $tanggal_akhir = Carbon::createFromFormat('Y-m-d', $request->tanggal_akhir)->endOfDay();

        $data = DB::table('prajabatans')
            ->leftJoin('pegawais', 'pegawais.id', '=', 'prajabatans.id_pegawai')
            ->whereBetween('prajabatans.created_at', [$tanggal_awal, $tanggal_akhir])
            ->select(
                'pegawais.nama',
                'pegawais.nip',
                'prajabatans.*'
            )
            ->get();

        $instansi = DB::table('instansis')->first();

        $laporan = Pdf::loadview('backend.prajabatan.export_pdf', [
            'data' => $data,
            'instansi' => $instansi
        ])->setPaper('a4', 'landscape');

        // laporan.pdf
        return $laporan->stream('Laporan Prajabatan.pdf');
    }
}
