<?php

namespace App\Http\Controllers\EntranceInspection;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ConsultInspection;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class EntranceInspectionController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $company = $request->session()->get('company');

        return view('lobby.index', [
            'company_id' => $company['id']
        ]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function info(Request $request)
    {
        $company = $request->session()->get('company');

        $customer = Customer::where('rg', trim($request->identification))
            ->orWhere('voter', trim($request->identification))
            ->orWhere('passport', trim($request->identification))
            ->orWhere('work_card', trim($request->identification))
            ->where('company_id', $company['id'])
            ->get()
            ->first();

        if (empty($customer)) {
            $routeCustomer = route("customers.create");

            return redirect()->route('lobby.index')->withInput()->withErrors([
                'errors' => [
                    "Documento não encontrado! Verifique com o cliente se ele tem cadasto. Se não tiver, realize o cadastro clicando <a href='$routeCustomer'>aqui</a>."
                ]
            ]);
        }

        //Log de consulta de inspeção de entrada
        ConsultInspection::create([
            'id' => Uuid::uuid4(), 
            'customer_id' => $customer->id,
            'company_id' => $company['id']
        ]);

        return view('lobby.index', [
            'company_id' => $company['id'],
            'customer' => $customer
        ]);
    }
}
