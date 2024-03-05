<?php

namespace App\Http\Controllers;

use App\Models\GrupInstrumen;
use App\Models\SubGrup;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class SubGrupController extends Controller
{
    public function index()
    {
        $grup_instrumen = GrupInstrumen::all();
        return view('backend.sub_grups.index',[
            'grup_instrumen' => $grup_instrumen,
        ]);
    }

    public function data()
    {

        $sub_grups = DB::table('sub_grups')
            ->select('sub_grups.*', 'users.name','grup_instrumens.nama_grup_instrumen')
            ->leftJoin('grup_instrumens','grup_instrumens.id','sub_grups.grup_instrumen_id')
            ->leftJoin('users', 'users.id', 'sub_grups.insert_by');

        $sub_grups = $sub_grups->get();


        return response()->json(['data' => $sub_grups]);
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'nama_sub_grup'   => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        } else {
            $data = SubGrup::create([
                'nama_sub_grup'   => $request->nama_sub_grup,
                'grup_instrumen_id'   => $request->grup_instrumen_id,
                'insert_by'       => Auth::user()->id,
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

            $sub_grups = SubGrup::find($request->id);
            $data = $sub_grups->update([
                'nama_sub_grup'   => $request->nama_sub_grup,
                'grup_instrumen_id'   => $request->grup_instrumen_id,
                'is_aktif'   => $request->is_aktif,
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

        $data = SubGrup::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
