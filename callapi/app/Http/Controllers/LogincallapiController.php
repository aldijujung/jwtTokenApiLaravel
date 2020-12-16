<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Alert;

class LogincallapiController extends Controller
{
    public function callapi()
    {

        // $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
        //     'email' => 'app@gmail.com',
        //     'password' => '123456',
        // ]);
        $response = Http::withToken('token')->post('http://127.0.0.1:8000/api/auth/login', [
            'email' => 'app44@gmail.com',
            'password' => '123456'
        ]);

        $data = json_decode((string) $response->body(), true);

        // $test = $response == true;

        // dd(response()->json(['valid' => auth()->check()]));

        try {
            $data['access_token'] == true;
            // dd($data);
            session()->put('token', $data);
            session()->push($data['user']['email'], $data['user']['name']);
            if (session()->get('token')['user']['role'] == 'app') {
                return redirect()->intended('homeapp');
            } elseif (session()->get('token')['user']['role'] == 'app1') {
                return redirect()->intended('homeapp1');
            } elseif (session()->get('token')['user']['role'] == 'app2') {
                return redirect()->intended('homeapp2');
            } elseif (session()->get('token')['user']['role'] == 'app3') {
                return redirect()->intended('homeapp3');
            } else {
                return "you dont have access";
            }
            // return redirect()->intended('home');
        } catch (\Throwable $th) {
            $data['error'] == true;
            return redirect()->intended('home');
        }

        // if ($data['error'] == true) {
        //     return 'Token';
        // } elseif ($data['access_token'] == true) {
        //     return 'no access';
        // }



        // if ($response == true) {
        //     $data = json_decode((string) $response->body(), true);
        //     session()->put('token', $data);
        //     session()->push($data['user']['email'], $data['user']['name']);
        //     if (session()->get('token')['user']['role'] == 'app') {
        //         return redirect()->intended('homeapp');
        //     } elseif (session()->get('token')['user']['role'] == 'app1') {
        //         return redirect()->intended('homeapp1');
        //     } elseif (session()->get('token')['user']['role'] == 'app2') {
        //         return redirect()->intended('homeapp2');
        //     } elseif (session()->get('token')['user']['role'] == 'app3') {
        //         return redirect()->intended('homeapp3');
        //     } else {
        //         return "you dont have access";
        //     }
        //     // return redirect()->intended('home');
        // }

        return 'no data';
    }

    public function callapiusinglaravelui(Request $request)
    {
        // Inputan yg diambil
        $credentials = $request->only('email', 'password');
        // dd($credentials['email']);
        if ($credentials == true) {
            // return 'ok';
            $response = Http::post('http://127.0.0.1:8000/api/auth/login', [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ]);
            $data = json_decode((string) $response->body(), true);
            // dd($response);
            try {
                $data['access_token'] == true;
                // dd($data);
                session()->put('token', $data);
                session()->push($data['user']['email'], $data['user']['name']);
                // dd(session()->has('token'));
                Alert::success('Success', 'Slamat Datang');
                $role = session()->get('token')['user']['role'];
                return redirect()->intended('home' . $role);
            } catch (\Throwable $th) {
                // dd($data);
                try {
                    $data['password'] == true;
                    // dd($data);
                    // $alert = "'Email or Password tidak terdaftar', 'error'";
                    return redirect('login');
                } catch (\Throwable $th) {
                    $data['error'] == true;
                    return redirect('login');
                }
                // $data['error'] == true;
                // return redirect('login');
            }
        }
        return redirect('login');
    }

    public function home()
    {
        return view('app.home');
    }

    public function homeapp()
    {
        if (session()->get('token')['user']['role'] == 'app') {
            return view('app.homeapp');
        }
        return redirect()->intended('access');
    }
    public function homeapp1()
    {
        if (session()->get('token')['user']['role'] == 'app1') {
            return view('app.homeapp1');
        }
        return redirect()->intended('access');
    }
    public function homeapp2()
    {
        if (session()->get('token')['user']['role'] == 'app2') {
            return view('app.homeapp2');
        }
        return redirect()->intended('access');
    }
    public function homeapp3()
    {
        if (session()->get('token')['user']['role'] == 'app3') {
            return view('app.homeapp3');
        }
        return redirect()->intended('access');
    }
    public function logout()
    {

        if (session()->has('token')) {
            session()->flush();
            Alert::success('Success', 'Anda telah logout !!!');
            return redirect()->route('login');
        } else {
            return response('Unauthorized.', 401);
        }
    }

    public function accessCheck()
    {
        if (session()->has('token')) {
            $role = session()->get('token')['user']['role'];
            return redirect()->route('home' . $role);
        } else {
            return route('login');
        }
    }
}
