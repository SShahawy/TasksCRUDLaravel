<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }
    public function registration()
    {
        return view('auth.registration');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        if (!Auth::validate($credentials)) {
            // return redirect()->to('tasks')
            //     ->with('error', 'Wrong Password or user is not approved yet');
            return redirect()->route('login')

                ->with('error', 'Wrong Password or user is not approved yet');
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return redirect()->route('tasks.index')

            ->with('success', 'Logged in');
    }
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
    public function show(User $user)
    {
        return view('auth.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();



        return redirect()->route('login')

            ->with('success', 'User deleted successfully');
    }
    public function change_pw(User $user)
    {
        return view('auth.change_pw', compact('user'));
    }
    public function changePassword(Request $request)
    {
        $validator = $request->validate([
            'c_password'  => 'required',
            'n_password'   => 'required|min:6|max:20',
            'nc_password'   => 'required|min:6|max:20',
        ]);
        if (!$validator) {
            return redirect()->route('tasks.index')

                ->with('error', 'Data Missing !');
        }
        $old_password = $request->c_password;
        $user = User::find(Auth::user()->id);
        if (Hash::check($old_password, $user->password)) {
            if ($request->n_password == $request->nc_password) {
                $user->password = bcrypt($request->n_password);
                $user->save();
                return redirect()->route('tasks.index')

                    ->with('success', 'Password Changed !');
            } else {
                return redirect()->route('change_pw_pg', [$user->id])

                    ->with('error', 'Password confirmation is not correct !');
            }
        } else
            return redirect()->route('change_pw_pg', [$user->id])

                ->with('error', 'Current password not correct !');
        return redirect()->back();
    }
    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }
    public function update(Request $request,  User $user)
    {
        $validator = $request->validate([

            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
        ]);

        if (!$validator) {
            return redirect()->route('tasks.index')

                ->with('error', 'Data Missing !');
        }
        $user = User::find($user);
        $user[0]->name = $request->fname . " " . $request->lname;
        $user[0]->email = $request->email;
        $user[0]->save();
        // dd($request->all());
        // $user->update($request->all());



        return redirect()->back()

            ->with('success', 'User updated successfully');
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fname'          => ['required', 'string', 'min:3', 'max:70'],
                'lname'          => ['required', 'string', 'min:3', 'max:70'],
                'email'          => 'required|unique:users',
                'password'         => 'required',
            ]
        );
        if (!$validator) {
            return redirect()->route('tasks.index')

                ->with('error', 'Data Missing !');
        }
        $user = new User();
        $user->name = $request->fname . " " . $request->lname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if ($request->remember == 'on')
            $user->remember_token = 1;
        else
            $user->remember_token = 0;
        $user->save();

        $credentials = ['email' => $request->email, 'password' => bcrypt($request->password)];
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return redirect()->route('tasks.index')

            ->with('success', 'User created successfully');
    }
}
