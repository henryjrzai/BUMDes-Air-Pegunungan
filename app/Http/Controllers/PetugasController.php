<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MontlyBill;
use App\Models\WaterTarif;
use Illuminate\Http\Request;
use App\Models\MonthlyWaterUsageRecord;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.index');
    }

    public function recordWater()
    {
        return view('petugas.record');
    }

    public function getCustomerByMeterId($meter_id) 
    {
        $customer = Customer::where('meter_id', $meter_id)->first();
        if (!$customer) {
            return response()->json(['message' => 'Maaf, data Pelanggan tidak ditemukan'], 404);
        } else {
            $data = new \stdClass();
            $data->id = $customer->id;
            $data->meter_id = $customer->meter_id;
            $data->name = $customer->name;
            $data->address = $customer->address;
            $data->dusun = $customer->dusun;
            $data->rt_rw = $customer->rt .'/'. $customer->rw;
            $data->water_tariff_id = $customer->water_tarif_id;
            $data->tariff = $customer->waterTarif->tariff_name;
            if ($customer->monthlyWaterUsageRecords->last()) {
                $data->last_used = $customer->monthlyWaterUsageRecords->last()->last_use;
            } else {
                $data->last_used = 'Belum ada data';
            }
            return response()->json($data);
        }
    }

    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'customer_id' => 'required', 
            'initial_use' => 'required',
            'last_use' => 'required',
            'url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'user_id' => 'required',
            'water_tariff_id' => 'required',
        ]);

        if ($request->initial_use == null || $request->initial_use == '' ){
            $request->merge(['initial_use' => 0]);
        }

        // Count the usage value
        $count_usage_value = $request->last_use - $request->initial_use;

        // get price per m3 from water tarifs
        $water_tariff = WaterTarif::find($request->water_tariff_id);

        // Calculate the total price
        $billing_costs = 0;
        if ($count_usage_value <= 3) {
            $usage = min($count_usage_value, 3);
            $billing_costs += $usage * $water_tariff->t0_3_M3;
            // $billing_costs = $count_usage_value * $water_tariff->t0_3_M3;
        } elseif ($count_usage_value <= 10) {
            $usage = min($count_usage_value - 3, 7);
            $billing_costs += $usage * $water_tariff->t__3_10_M3;
            // $billing_costs = $count_usage_value * $water_tariff->t__3_10_M3;
        } elseif ($count_usage_value <= 20) {
            $usage = min($count_usage_value - 10, 10);
            $billing_costs += $usage * $water_tariff->t__10_20_M3;
            // $billing_costs = $count_usage_value * $water_tariff->t__10_20_M3;
        } elseif ($count_usage_value > 20) {
            $usage = $count_usage_value - 20;
            $billing_costs += $usage * $water_tariff->t__20_M3;
            // $billing_costs = $count_usage_value * $water_tariff->t__20_M3;
        }

        // Store the image
        $imageUrl = time().'.'.$request->customer_id.'-'. auth()->user()->id.'.'.$request->url->extension();  
        $request->url->move(public_path('images/record'), $imageUrl);

        // Store the data
        $record = new MonthlyWaterUsageRecord();
        $record->customer_id = $request->customer_id;
        $record->initial_use = $request->initial_use;
        $record->last_use = $request->last_use;
        $record->usage_value = $count_usage_value;
        $record->url = $imageUrl;
        $record->user_id = $request->user_id;
        $record->save();

        $last_record = MonthlyWaterUsageRecord::where('customer_id', $request->customer_id)->orderBy('created_at', 'desc')->first();

        $monthly_bill = new MontlyBill();
        $monthly_bill->customer_id = $request->customer_id;
        $monthly_bill->monthly_water_usage_record_id = $last_record->id;
        $monthly_bill->billing_costs = $billing_costs;
        $monthly_bill->save();

        if ($record && $monthly_bill) {
            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        } else {
            return response()->json(['message' => 'Data gagal disimpan'], 500);
        }
    }

    public function getCustomers()
    {
        $customer = Customer::all();
        foreach ($customer as $c) {
            $customers[] = [
                'meter_id' => $c->meter_id,
                'name' => $c->name,
                'address' => $c->address,
                'phone' => $c->phone,
                'dusun' => $c->dusun,
                'rt_rw' => $c->rw . '/' . $c->rt,
                'jenis_tarif' => $c->waterTarif->tariff_name,
            ];
        }
        return view('petugas.customers', compact('customers'));
    }
}
