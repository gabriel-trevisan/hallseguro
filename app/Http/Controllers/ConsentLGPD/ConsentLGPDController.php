<?php

namespace App\Http\Controllers\ConsentLGPD;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ConsentSent;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Url;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ConsentLGPDController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $company = $request->session()->get('company');

        $documents = Document::where('company_id', $company['id'])
            ->where('type', 1)
            ->get();
            //type 1 = Consent LGPD

        return view('consentlgpd.index', [
            'documents' => $documents
        ]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('consentlgpd.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:25'],
            'body' => ['required', 'string']
        ]);

        try {

            $company = $request->session()->get('company');
            $uuid = Uuid::uuid4();

            //Deixar todos os outros documentos de cosnentimento LGPD
            //como status "ANTIGO"
            Document::where('company_id', $company['id'])
                        ->where('type', 1) 
                        ->update(['status' => 0]);
            
            Document::create([
                'id' => $uuid,
                'title' => $request->title,
                'body' => $request->body,
                'status' => 1,
                'type' => 1,
                'version' => Document::nextVersion(),
                'company_id' => $company['id'],
                'user_id' => Auth::id()
            ]);

        } catch (Exception $e) {

            return redirect()->back()->withErrors([
                'errors' => [
                    'Um erro inesperado ocorreu. Favor contatar suporte.',
                    $e->getMEssage()
                ]
            ]);
        }

        return redirect()->route('consentlgpd.index')->with('success', 'Documento cadastrado com sucesso!');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function showDocumentPublic()
    {

        $url = new Url();
        $subDomain = $url->getSubDomain(url()->full());

        $company = Company::where('name', 'like', $subDomain )->first();

        if(is_null($company)){
            abort(404);
        }

        $document = Document::where(
                'company_id', $company->id
                )
                ->where(['status' => 1])
                ->where(['type' => 1])
                ->orderByDesc('version')
                ->first();

        return view('public.consentlgpd.index', [
            'document' => $document
        ]);
    }

        /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function showDocumentCustomer(Request $request)
    {

        $url = new Url();
        $subDomain = $url->getSubDomain(url()->full());

        $company = Company::where('name', 'like', $subDomain )->first();

        if(is_null($company)){
            abort(404);
        }

        $customer = Customer::where(
                        'id', $request->customerID
                    )
                    ->where(['company_id' => $company->id])
                    ->first();

        if(is_null($customer)){
            abort(404);
        }

        $document = Document::where(
                'company_id', $company->id
                )
                ->where(['status' => 1])
                ->where(['type' => 1])
                ->orderByDesc('version')
                ->first();

        return view('public.consentlgpd.accept', [
            'document' => $document,
            'customer' => $customer
        ]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function accept(Request $request)
    {

        $url = new Url();
        $subDomain = $url->getSubDomain(url()->full());

        $company = Company::where('name', 'like', $subDomain )->first();

        if(is_null($company)){
            abort(404);
        }

        $customer = Customer::where(
                        'id', $request->customerID
                    )
                    ->where(['company_id' => $company->id])
                    ->first();

        if(is_null($customer)){
            abort(404);
        }

        $consent = ConsentSent::where(
                        'customer_id', $request->customerID
                    )
                    ->where(['document_id' => $request->documentID])
                    ->where(['company_id' => $company->id])
                    ->first();

        if($consent->accept == 0) {
            $consent->accept = 1;
            $consent->save();
        } else {
            return '<h4>Este consentimento já foi aceito. Obrigado!</h4>';
        }

        return '<h4>Obrigado por aceitar! A equipe ' . $company['name']. ' agradece. </h4>';
    }
}
