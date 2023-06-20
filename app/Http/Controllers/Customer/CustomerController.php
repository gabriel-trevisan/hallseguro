<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Consent;
use App\Models\ConsultInspection;
use App\Models\SMS;
use App\Services\DispatchLGPDConsent;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $company = $request->session()->get('company');

        $customers = Customer::query()->where('company_id', $company['id']);

        if($request->ajax()){
            return DataTables::of($customers)
                    ->editColumn('created_at', function($customer){
                        return date('d/m/Y', strtotime($customer->created_at));
                    })
                    ->editColumn('bloqued_at', function($customer){
                        $bloquedAt = '';
                        if(!empty($customer->bloqued_at)){
                            $bloquedAt = date('d/m/Y', strtotime($customer->bloqued_at));
                        }
                        return $bloquedAt;
                    })
                    ->editColumn('bloqued', function($customer){
                        if($customer->bloqued == 0){
                            $bloqued = '<span class="status-btn active-btn mb-2">Ativo</span>';
                        } else {
                            $bloqued = '<span class="status-btn close-btn mb-2">Bloqueado</span>';
                        }
                        return $bloqued;
                    })
                    ->addColumn('image_profile', function($customer) use ($company) {
                        $companyID = $company['id'];
                        $route = route("customers.profile.image", ["companyID" => $companyID, "customerID" => $customer->id, "image" => "profile-50.jpg"] );

                        $image = '<a href="#" onclick="showProfileImage(this)">';
                        $image .= '<div class="lead">';
                            $image .= '<div class="lead-image">';
                                $image .= "<img style='width: 50px; height: 50px;' src='{$route}' data-bs-toggle='modal' data-bs-target='#modalProfile'>";
                                $image .= '</div>';
                            $image .= '</div>';
                        $image .= '</a>';
                        
                        return $image;
                    })
                    ->editColumn('action', function($customer){
                        $routeEdit = route('customers.edit', ['id' => $customer->id]);
                        $routeDelete = route('customers.destroy', ['id' => $customer->id]);
                        
                        $action = '<div class="action">';
                            $action .= "<a href='{$routeEdit}' class='text-dark mr-20'>";
                                $action .= '<i class="lni lni-pencil-alt"></i>';
                            $action .= '</a>';
                            $action .= "<form method='POST' action='{$routeDelete}' onsubmit='formSubmit(event)'>";
                                $action .= "<input type='hidden' name='_token' value=".csrf_token()." />";
                                $action .= '<input type="hidden" name="_method" value="DELETE">';
                                $action .= '<button type="submit" class="text-danger" data-bs-toggle="modal" data-bs-target="#ModalFour">';
                                $action .= '<i class="lni lni-trash-can"></i>';
                                $action .= '</button>';
                            $action .= '</form>';
                        $action .= '</div>';

                        return $action;
                    })
                    ->rawColumns(['image_profile', 'action', 'bloqued'])
                    ->make(true);
        }

        return view('customers.index', [
            'customers' => $customers,
            'company_id' => $company['id']
        ]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $company = $request->session()->get('company');

        $urlPrevious = url()->previous();

        if (Str::contains($urlPrevious, [
            'lobby/inspection',
            'lobby/inspection/result'
        ])) {
            $request->session()->put('redirectTo', "lobby.index");
        }

        return view('customers.create', [
            'company_id' => $company['id']
        ]);
    }

    /**
     * Edit customer
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return \Illuminate\View\View
     */
    public function method($id, Request $request)
    {
        $company = $request->session()->get('company');

        $customer = Customer::where('id', $id)
            ->where('company_id', $company['id'])
            ->get()
            ->first();

        if (empty($customer)) {
            abort(404);
        }

        return view('customers.method', [
            'company_id' => $company['id'],
            'customer' => $customer
        ]);
    }

    /**
     * Edit customer
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return \Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $company = $request->session()->get('company');

        $customer = Customer::where('id', $id)
            ->where('company_id', $company['id'])
            ->get()
            ->first();

        if (empty($customer)) {
            abort(404);
        }

        return view('customers.edit', [
            'company_id' => $company['id'],
            'customer' => $customer
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function destroy(Request $request)
    {
        try {

            $company = $request->session()->get('company');

            //GET customer
            $customer = Customer::where('id', $request->id)
                ->where('company_id', $company['id'])
                ->get()
                ->first();

            $customer->delete();
        } catch (Exception $e) {

            return redirect()->back()->withErrors([
                'errors' => [
                    'Um erro inesperado ocorreu. Favor contatar suporte.',
                    $e->getMEssage()
                ]
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Clientes excluído com sucesso!');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {     
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'rg' => ['max:12', 'unique:customers,rg,' . $request->id . ',id,deleted_at,NULL', 'nullable'],
            'voter' => ['max:12', 'unique:customers,voter,' . $request->id . ',id,deleted_at,NULL', 'nullable'],
            'work_card' => ['max:13', 'unique:customers,work_card,' . $request->id . ',id,deleted_at,NULL', 'nullable'],
            'passport' => ['max:8', 'unique:customers,passport,' . $request->id . ',id,deleted_at,NULL', 'nullable'],
            'note' => ['max:255'],
            'company_id' => ['required']
        ]);

        try {

            $cellphone = isset($request->cellphone) ? $request->cellphone: null;

            $patterns = [
                "/-/",
                "/\(/",
                "/\)/",
                "/[ ]/",
            ];
            
            $cellphone = preg_replace($patterns, '', $cellphone);

            $companyID = $request->company_id;

            //GET Cliente
            $customer = Customer::where('id', $request->id)
                ->where('company_id', $companyID)
                ->get()
                ->first();

            $customer->name = $request->name;
            $customer->rg = isset($request->rg) ? $request->rg: null;
            $customer->voter = isset($request->voter) ? $request->voter: null;
            $customer->work_card = isset($request->work_card) ? $request->work_card: null;
            $customer->passport = isset($request->passport) ? $request->passport: null;
            $customer->cellphone = $cellphone;
            $customer->email = isset($request->email) ? $request->email: null;
            $customer->note = $request->note;
            $customer->company_id = $request->company_id;

            //Bloquear cliente
            if (!$request->has('status')) {
                $customer->bloqued = 1;
                $customer->bloqued_at = date('Y-m-d');
            } else {
                $customer->bloqued = 0;
                $customer->bloqued_at = null;
            }

            $customer->save();

            //Atualizar imagem do cliente
            if (!empty($request->image_profile)) {
                $image = $request->image_profile;
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = 'profile.jpg';
                $path = $companyID . '/' . $request->id . '/';
                $pathWithImage = $path . '/' . $imageName;

                Storage::disk('local')->put($pathWithImage, base64_decode($image));

                $imageNameResized = 'profile-50.jpg';
                $pathImageResized = storage_path('app') . '/' . $path . '/' . $imageNameResized;

                $img = Image::make(storage_path('app') . '/' . $pathWithImage);
                $img->resize(50, 50);
                $img->save($pathImageResized);
            }
        } catch (Exception $e) {

            return redirect()->back()->withErrors([
                'errors' => [
                    'Um erro inesperado ocorreu. Favor contatar suporte.',
                    $e->getMEssage()
                ]
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Cliente alterado com sucesso!');
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
            'image_profile' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'rg' => ['max:12', Rule::unique('customers')->whereNull('deleted_at')],
            'voter' => ['max:12',  Rule::unique('customers')->whereNull('deleted_at')],
            'work_card' => ['max:13',  Rule::unique('customers')->whereNull('deleted_at')],
            'passport' => ['max:8',  Rule::unique('customers')->whereNull('deleted_at')],
            'note' => ['max:255'],
            'company_id' => ['required']
        ], [
            'image_profile.required' => 'A foto é obrigatória. Clique no ícone de câmera para tirar a foto do cliente.'
        ]);

        try {

            $companyID = $request->company_id;
            $uuid = Uuid::uuid4();
            $email = isset($request->email) ? trim($request->email) : null;
            $cellphone = isset($request->cellphone) ? trim($request->cellphone) : null;
            $voter = isset($request->voter) ? trim($request->voter) : null;
            $passport = isset($request->passport) ? trim($request->passport) : null;
            $workCard = isset($request->work_card) ? trim($request->work_card) : null;
            $rg = isset($request->rg) ? trim($request->rg) : null;

            $patterns = [
                "/-/",
                "/\(/",
                "/\)/",
                "/[ ]/",
            ];
            
            $cellphone = preg_replace($patterns, '', $cellphone);

            $customer = Customer::create([
                'id' => $uuid,
                'name' => $request->name,
                'rg' => $rg,
                'work_card' => $workCard,
                'passport' => $passport,
                'voter' => $voter,
                'note' => $request->note,
                'company_id' => $companyID,
                'email' => $email,
                'cellphone' => $cellphone
            ]);

            //Log de consulta de inspeção de entrada
            ConsultInspection::create([
                'id' => Uuid::uuid4(), 
                'customer_id' => $customer->id,
                'company_id' => $companyID
            ]);

            $image = $request->image_profile;
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'profile.jpg';
            $path = $companyID . '/' . $uuid . '/';
            $pathWithImage = $path . '/' . $imageName;

            Storage::disk('local')->put($pathWithImage, base64_decode($image));

            $imageNameResized = 'profile-50.jpg';
            $pathImageResized = storage_path('app') . '/' . $path . '/' . $imageNameResized;

            $img = Image::make(storage_path('app') . '/' . $pathWithImage);
            $img->resize(50, 50);
            $img->save($pathImageResized);

            $dispatchConsent = new DispatchLGPDConsent();
            $dispatchConsent->send($request->type_consent, $customer);

        } catch (Exception $e) {

            return redirect()->back()->withErrors([
                'errors' => [
                    'Um erro inesperado ocorreu. Favor contatar suporte.',
                    $e->getMEssage()
                ]
            ]);
        }

        if (!empty($request->session()->get('redirectTo'))) {
            $redirectTo = $request->session()->get('redirectTo');

            $request->session()->forget('redirectTo');

            return redirect()->route($redirectTo)->with('success', 'Cliente cadastrado com sucesso! Consulte o próximo cliente abaixo.');
        }

        return redirect()->route('customers.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Show customer image profile
     *
     * @param $companyID
     * @param $custoemrID
     * @param $image
     * @return string
     */
    public function showImageProfile($companyID, $customerID, $image)
    {
        $path = $companyID . '/' . $customerID . '/' . $image;

        if (!Storage::exists($path)) {
            return response('File no found.', 404);
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = response($file, 200)->header("Content-Type", $type);

        return $response;
    }
}
