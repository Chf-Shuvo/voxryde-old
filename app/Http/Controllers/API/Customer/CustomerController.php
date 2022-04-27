<?php

namespace App\Http\Controllers\API\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            if (!Auth::guard('customer')->attempt($request->only('email', 'password'))) {
                return response([
                    'message' => 'Invalid credentials, User unauthenticated'
                ], Response::HTTP_UNAUTHORIZED);
            }

            //if authenticated
            $user = auth('customer')->user();

            $token = $user->createToken('token')->plainTextToken;

            $cookie = cookie('jwt', $token, 60 * 24);

            return response([
                'token' => $token,
                'user' => $user
            ])->withCookie($cookie);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:customers',
            'phone' => 'required|unique:customers'
        ]);
        try {
            return Customer::create([
                "customer_name" => $request->customer_name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "phone" => $request->phone,
                "image" => "customer.png",
                "address" => $request->address,
                "company_name" => $request->company_name,
                "company_registration" => $request->company_registration,
                "company_address" => $request->company_address,
                "status" => $request->status,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        try {
            // return auth()->user()->makeHidden('email');
            return auth()->user();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function logout()
    {
        try {
            $cookie = Cookie::forget('jwt');
            auth()->user()->tokens()->delete();
            return response([
                'message' => 'success'
            ])->withCookie($cookie);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
