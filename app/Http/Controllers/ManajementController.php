<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MontlyBill;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ManajementController extends Controller
{

    function index() 
    {
        $records = Customer::join('monthly_water_usage_records', 'customers.id', '=', 'monthly_water_usage_records.customer_id')
            ->join('water_tarifs', 'customers.water_tarif_id', '=', 'water_tarifs.id')
            ->select('customers.meter_id as meter', 'customers.name as name', 'customers.phone as phone',
                'customers.dusun as dusun', 'water_tarifs.tariff_name as tariff', 'monthly_water_usage_records.usage_value as usage')
            ->orderBy('monthly_water_usage_records.usage_value', 'desc')
            ->limit(10)
            ->get();

        $last_transactions = MontlyBill::join('customers', 'montly_bills.customer_id', '=', 'customers.id')
            ->select('customers.name as name', 'montly_bills.billing_costs as cost', 'montly_bills.created_at as date')
            ->orderBy('montly_bills.created_at', 'desc')
            ->where('montly_bills.status', 'paid')
            ->limit(10)
            ->get();
        return view('manajement.index', compact('records', 'last_transactions'));
    }

    function customers()
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
        return view('manajement.customers', compact('customers'));
    }

    function customerReport() 
    {
        $customers = Customer::all();
        foreach ($customers as $c) {
            $customer[] = [
                'meter_id' => $c->meter_id,
                'name' => $c->name,
                'address' => $c->address,
                'phone' => $c->phone,
                'dusun' => $c->dusun,
                'rt_rw' => $c->rw . '/' . $c->rt,
                'jenis_tarif' => $c->waterTarif->tariff_name,
            ];
        }
        $pdf = Pdf::loadView('report.customers', ['customers' => $customers])->setPaper('a4', 'landscape');
        return $pdf->stream('customer-report.pdf');

        // return view('report.customers', compact('customers'));
    }

    function bills()
    {
        $bills = Customer::join('montly_bills', 'customers.id', '=', 'montly_bills.customer_id')
                ->select(
                    'customers.meter_id as meter', 
                    'customers.name as name', 
                    'customers.phone as phone',
                    'customers.dusun as dusun',
                    'montly_bills.billing_costs as cost', 
                    'montly_bills.status as status'
                )->whereMonth('montly_bills.created_at', Carbon::now()->month)
                ->get();
        return view('manajement.customer-bill', compact('bills'));
    }

    function billReport()
    {
        $bills = Customer::join('montly_bills', 'customers.id', '=', 'montly_bills.customer_id')
                ->select(
                    'customers.meter_id as meter', 
                    'customers.name as name', 
                    'customers.phone as phone',
                    'customers.dusun as dusun',
                    'montly_bills.billing_costs as cost', 
                    'montly_bills.status as status'
                )->whereMonth('montly_bills.created_at', Carbon::now()->month)->get();
        $pdf = Pdf::loadView('report.bills', ['bills' => $bills])->setPaper('a4', 'landscape');
        return $pdf->stream('bill-report.pdf');
    }
}
