<?php

namespace App\Http\Controllers;

use App\Models\ButirInstrumen;
use App\Models\GrupInstrumen;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class ButirInstrumenController extends Controller
{
    public function index()
    {
        return view('backend.butir_instrumens.index');
    }

    public function data()
    {

        $grup_instrumen = GrupInstrumen::all();

        $butir_instrumens = DB::table('butir_instrumens')
            ->select('butir_instrumens.*', 'users.name', 'grup_instrumens.kode_instrumen')
            ->leftJoin('grup_instrumens', 'grup_instrumens.id', 'butir_instrumens.grup_instrumen_id')
            ->leftJoin('users', 'users.id', 'butir_instrumens.insert_by');

        $butir_instrumens = $butir_instrumens->get();

        return response()->json(['data' => $butir_instrumens, 'grup_instrumen' => $grup_instrumen]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'kode_instrumen'   => 'required',
            'nama_instrumen'      => 'required',
            'keterangan'    => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } else {
            $data = ButirInstrumen::create([
                'kode_instrumen'   => $request->kode_instrumen,
                'nama_instrumen'   => $request->nama_instrumen,
                'grup_instrumen_id' => $request->grup_instrumen_id,
                'keterangan'    => $request->keterangan,
                'insert_by'            => Auth::user()->id,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'    => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } else {

            $butir_instrumens = ButirInstrumen::find($request->id);
            $data = $butir_instrumens->update([
                'kode_instrumen'   => $request->kode_instrumen,
                'nama_instrumen'   => $request->nama_instrumen,
                'grup_instrumen_id' => $request->grup_instrumen_id,
                'keterangan'    => $request->keterangan,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = ButirInstrumen::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
