<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Company;
use App\Models\Url;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{    
    private $company;
    
    /**
     * __construct
     *
     * @param  mixed $company
     * @return void
     */
    function __construct(Company $company)
    {
        $this->company = $company;
    }
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $url = new Url();
        $subDomain = $url->getSubDomain(url()->full());

        try {
            $company = $this->company::where('name', 'like', $subDomain )->first();
            $request->session()->put('company', [
                "id" => $company->id, 
                "name" => $company->name
            ]);
        } catch (\Exception $e) {
            echo "Empresa não cadastrada. Certifique se a url de acesso está correta.";
            die();
        }

        return view('auth.login', [
            'company_id' => $company->id
        ]);

        // return view('auth.login', [
        //     'company_id' => "1"
        // ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
