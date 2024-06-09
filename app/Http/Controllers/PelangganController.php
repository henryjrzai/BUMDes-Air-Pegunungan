<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;

class PelangganController extends Controller
{
    public function index()
    {
        return view('admin.customer');
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
            ];
        }
        return DataTables::of($customers)->make(true);
    }

    public function store(Request $request) 
    {
        //validate request
        $request->validate([
            'meter_id' => 'required|unique:customers,meter_id',
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'dusun' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ]);

        $customer = new Customer();
        $customer->meter_id = $request->meter_id;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->dusun = $request->dusun;
        $customer->rt = $request->rt;
        $customer->rw = $request->rw;
        $customer->save();

        //create new user
        if($customer) {
            //redirect with success message
            return response()->json([
                'success' => true,
                'message' => 'Data Pelanggan Berhasil Ditambahkan!.',
            ]);
        } else {
            //redirect with error message
            return response()->json([
                'success' => false,
                'message' => 'Data Pelanggan Gagal Ditambahkan!.',
            ]);
        }
    }

    public function show($meter_id)
    {
        $customer = Customer::where('meter_id', $meter_id)->first();
        return response()->json($customer);
    }

    public function update(Request $request, $meter_id)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'dusun' => 'required',
            'rt' => 'required',
            'rw' => 'required',
        ]);

        $customer = Customer::where('meter_id', $meter_id)->first();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->dusun = $request->dusun;
        $customer->rt = $request->rt;
        $customer->rw = $request->rw;
        $customer->save();

        //create new user
        if($customer) {
            //redirect with success message
            return response()->json([
                'success' => true,
                'message' => 'Data Pelanggan Berhasil Diupdate!.',
            ]);
        } 
        else {
            //redirect with error message
            return response()->json([
                'success' => false,
                'message' => 'Data Pelanggan Gagal Diupdate!.',
            ]);
        }
    }

    public function destroy($meter_id)
    {
        $customer = Customer::where('meter_id', $meter_id)->first();
        $customer->delete();

        if($customer) {
            //redirect with success message
            return response()->json([
                'success' => true,
                'message' => 'Data Pelanggan Berhasil Dihapus!.',
            ]);
        } 
        else {
            //redirect with error message
            return response()->json([
                'success' => false,
                'message' => 'Data Pelanggan Gagal Dihapus!.',
            ]);
        }
    }
}
