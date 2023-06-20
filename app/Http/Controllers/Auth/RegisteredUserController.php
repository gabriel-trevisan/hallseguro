<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Ramsey\Uuid\Uuid;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $company = $request->session()->get('company');

        $users = User::where('company_id', $company['id'])
            ->get();

        return view('users.index', [
            'users' => $users
        ]);
    }
    
    /**
     * Edit user
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function edit($id, Request $request)
    {
        $company = $request->session()->get('company');

        $user = User::where('id', $id)
            ->where('company_id', $company['id'])
            ->get()
            ->first();

        if (empty($user)) {
            abort(404);
        }

        return view('users.edit', [
            'company_id' => $company['id'],
            'user' => $user
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

            //GET user
            $user = User::where('id', $request->id)
                ->where('company_id', $company['id'])
                ->get()
                ->first();

            $user->delete();

        } catch (Exception $e) {

            return redirect()->back()->withErrors([
                'errors' => [
                    'Um erro inesperado ocorreu. Favor contatar suporte.',
                    $e->getMEssage()
                ]
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
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
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $request->id],
            'group' => ['required'],
            'company_id' => ['required']
        ]);

        try {

            $companyID = $request->company_id;

            //GET user
            $user = User::where('id', $request->id)
                ->where('company_id', $companyID)
                ->get()
                ->first();

            $user->name = $request->name;
            $user->username = $request->username;
            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }
            $user->group = $request->group;
            $user->company_id = $request->company_id;

            //Bloquear cliente
            if (!$request->has('status')) {
                $user->bloqued = 1;
            } else {
                $user->bloqued = 0;
            }

            $user->save();

        } catch (Exception $e) {

            return redirect()->back()->withErrors([
                'errors' => [
                    'Um erro inesperado ocorreu. Favor contatar suporte.',
                    $e->getMEssage()
                ]
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Usuário alterado com sucesso!');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $company = $request->session()->get('company');
        return view('users.create', [
            'company_id' => $company['id']
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'group' => ['required'],
            'company_id' => ['required']
        ]);

        $user = User::create([
            'id' => Uuid::uuid4(),
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'group' => $request->group,
            'company_id' => $request->company_id
        ]);

        //event(new Registered($user));

        //Auth::login($user);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }
}
