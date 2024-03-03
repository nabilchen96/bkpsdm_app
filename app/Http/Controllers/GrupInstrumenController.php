<?php

namespace App\Http\Controllers;

use App\Models\GrupInstrumen;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class GrupInstrumenController extends Controller
{
    public function index(){
        return view('backend.grup_instrumens.index');
    }

    public function data(){
        
        $grup_instrumens = DB::table('grup_instrumens')
        ->select('grup_instrumens.*','users.name')
        ->leftJoin('users','users.id','grup_instrumens.user_input');

        $data_user = Auth::user();
        $grup_instrumens = $grup_instrumens->get();

        
        return response()->json(['data' => $grup_instrumens]);
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(), [
            'nama_grup_instrumen'   => 'required',
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{
            $data = GrupInstrumen::create([
                'nama_grup_instrumen'   => $request->nama_grup_instrumen,
                'user_input'            => Auth::user()->id,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }

        return response()->json($data);
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'id'    => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'responCode'    => 0,
                'respon'        => $validator->errors()
            ];
        }else{

            $grup_instrumens = GrupInstrumen::find($request->id);
            $data = $grup_instrumens->update([
                'nama_grup_instrumen'   => $request->nama_grup_instrumen,
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request){

        $data = GrupInstrumen::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
