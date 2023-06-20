<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $company = $request->session()->get('company');

        $customers = Customer::where('bloqued', 1)
            ->where('company_id', $company['id'])
            ->get();

        return view('dashboard', [
            'company_id' => $company['id'],
            'customers' => $customers
        ]);
    }
}
