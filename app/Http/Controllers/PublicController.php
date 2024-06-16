<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\WaterTarif;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $tariffs = WaterTarif::all();
        return view('customer.index', compact('tariffs'));
    }

    public function bills(Request $request) 
    {
        try {
            $meter_id = $request->meter_id;
            $data = Customer::where('meter_id', $meter_id)->first();
            
            if ($data === null) {
                return redirect()->back()->with('error', 'Periksa kembali nomor ID Pelanggan/Meter yang anda masukkan!');
            }

            $data->waterTarif;
            $data->monthlyWaterUsageRecords;
            $data->bills;
            
            $historys = Customer::where('meter_id', $meter_id)->first();
            $historys->monthlyWaterUsageRecords;
            $count = $historys->monthlyWaterUsageRecords->count();
            return view('customer.bills', compact('data', 'historys', 'count'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->with('error', 'Periksa kembali nomor ID Pelanggan/Meter yang anda masukkan!');
        }
        
    }
}
