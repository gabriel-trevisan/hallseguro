<?php

namespace App\Http\Controllers\ShorterURL;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ConsentSent;
use App\Models\Url;
use Illuminate\Http\Request;

class ShorterURLController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $url = new Url();
        $subDomain = $url->getSubDomain(url()->full());

        $company = Company::where('name', 'like', $subDomain )->first();

        if(is_null($company)){
            abort(404);
        }

        $consent = ConsentSent::where('company_id', $company->id)
            ->where('id', 'like', $request->id . '%')
            ->first();
            
        if(is_null($consent)){
            abort(404);
        }

        $termUrl = "/public/document/".$consent->document_id."/accept/".$consent->customer_id;

        return redirect($termUrl);
    }

}
