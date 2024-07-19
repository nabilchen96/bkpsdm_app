<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Pegawai;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('backend.pegawai.index');
    }

    public function data()
    {

        $user = DB::table('pegawais');

        $data_user = Auth::user();
        $user = $user->get();

        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {
            $data = Pegawai::create($request->all());

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

            $user = Pegawai::find($request->id);
            $data = $user->update($request->all());

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = Pegawai::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
