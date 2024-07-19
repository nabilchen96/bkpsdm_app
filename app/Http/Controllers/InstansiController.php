<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Instansi;
use Auth;

use Illuminate\Support\Facades\Validator;

class InstansiController extends Controller
{
    public function index()
    {

        $data = Instansi::first();

        return view('backend.instansi.index', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_instansi' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'responCode' => 0,
                'respon' => $validator->errors()
            ];
        } else {

            $instansi = Instansi::first();

            //LOGO
            if ($request->logo) {
                $logo = time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('logo'), $logo);
            }

            if ($instansi) {
                $instansi->update(array_merge($request->all(), ['logo' => $logo ?? $instansi->logo ]));
            } else {
                Instansi::create(array_merge($request->all(), ['logo' => $logo ?? '' ]));
            }

            $data = [
                'responCode' => 1,
                'respon' => 'Data Sukses Disimpan'
            ];
        }

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $data = Instansi::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
