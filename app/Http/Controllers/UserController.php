<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\MontlyBill;
use Illuminate\Http\Request;
// use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables as DataTables;

class UserController extends Controller
{
    public function index()
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
            ->limit(10)
            ->get();
        return view('admin.index' , compact('records', 'last_transactions'));
    }

     /**
     * Retrieves the dashboard data, including the count of users by role, the total user count,
     * and the earning data for each customer.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the dashboard data.
     */
    public function dashboard() 
    {
        $users = DB::table('users')->select('role')->get();
        $user = $users->count();
        $earning = MontlyBill::select('customer_id', 'billing_costs', 'created_at')->get();
        // count totoal billing costs
        $total = 0;
        foreach ($earning as $earn) {
            $total += $earn->billing_costs;
        }

        $monthly_income = MontlyBill::select('created_at', 'billing_costs')
            ->whereMonth('created_at', date('m'))
            ->get();
        $monthly_income = $monthly_income->groupBy(function($date) {
            \Carbon\Carbon::setLocale('id');
            return \Carbon\Carbon::parse($date->created_at)->translatedFormat('F');
        });
        $monthly_income = $monthly_income->map(function($month) {
            return $month->sum('billing_costs');
        });

        $customers = Customer::join('water_tarifs', 'customers.water_tarif_id', '=', 'water_tarifs.id')
            ->select('water_tarifs.tariff_name')
            ->get();
        $customer_count = $customers->count();
        
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Ditampilkan!',
            'users' => $users,
            'user_count' => $user,
            'customer_count' => $customer_count,
            'customer_role' => $customers,
            'total_earning' => $total,
            'earning' => $earning,
            'monthly_income' => $monthly_income,
        ]);
    }

    public function users() { return view('admin.users'); }

    public function showUsers()
    {
        $users = User::all();
        return DataTables::of($users)->make(true);
    }

    public function destroy($email)
    {
        //delete user by email
        User::where('email', $email)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Dihapus!.',
        ]);
    }

    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->save();

        //create new user
        if($user) {
            //redirect with success message
            return response()->json([
                'success' => true,
                'message' => 'Data Pengguna Berhasil Ditambahkan!.',
            ]);
        } else {
            //redirect with error message
            return response()->json([
                'success' => false,
                'message' => 'Data Pengguna Gagal Ditambahkan!.',
            ]);
        }
    }

    public function show($email)
    {
        //get user by email
        $user = User::where('email', $email)->first();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Ditampilkan!',
            'data' => $user
        ]);
    }

    public function update(Request $request, $email)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ]);

        //get user by email
        $user = User::where('email', $email)->first();

        //update user
        $user->update($request->all());

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Pengguna Berhasil Diperbarui!.',
        ]);
    }
}
