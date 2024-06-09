<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaterTarif;
use Yajra\DataTables\DataTables as DataTables;

class WaterTariffController extends Controller
{
    public function index()
    {
        return view('admin.tariff');
    }

    public function getTariff()
    {
        $tariff = WaterTarif::all();
        return DataTables::of($tariff)->make(true); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'tariff_name' => 'required',
            'tariff_category' => 'required',
            't0_3_M3' => 'required',
            't__3_10_M3' => 'required',
            't__10_20_M3' => 'required',
            't__20_M3' => 'required',
        ]);

        $tariff = new WaterTarif();
        $tariff->tariff_name = $request->tariff_name;
        $tariff->tariff_category = $request->tariff_category;
        $tariff->t0_3_M3 = $request->t0_3_M3;
        $tariff->t__3_10_M3 = $request->t__3_10_M3;
        $tariff->t__10_20_M3 = $request->t__10_20_M3;
        $tariff->t__20_M3 = $request->t__20_M3;
        $tariff->save();

        if($tariff) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tarif Berhasil Ditambahkan!.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tarif Gagal Ditambahkan!.',
            ]);
        }
    }

    public function show($id)
    {
        $tariff = WaterTarif::where('id', $id)->first();
        return response()->json($tariff);          
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tariff_name' => 'required',
            'tariff_category' => 'required',
            't0_3_M3' => 'required',
            't__3_10_M3' => 'required',
            't__10_20_M3' => 'required',
            't__20_M3' => 'required',
        ]);

        $tariff = WaterTarif::find($id);
        $tariff->tariff_name = $request->tariff_name;
        $tariff->tariff_category = $request->tariff_category;
        $tariff->t0_3_M3 = $request->t0_3_M3;
        $tariff->t__3_10_M3 = $request->t__3_10_M3;
        $tariff->t__10_20_M3 = $request->t__10_20_M3;
        $tariff->t__20_M3 = $request->t__20_M3;
        $tariff->save();

        if($tariff) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tarif Berhasil Diubah!.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tarif Gagal Diubah!.',
            ]);
        }
    }

    public function destroy($id)
    {
        $tariff = WaterTarif::find($id);
        $tariff->delete();

        if($tariff) {
            return response()->json([
                'success' => true,
                'message' => 'Data Tarif Berhasil Dihapus!.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Tarif Gagal Dihapus!.',
            ]);
        }
    }

    public function getTariffNameId()
    {
        $tariff = WaterTarif::select('id', 'tariff_name')->get();
        return response()->json($tariff);
    }
}
