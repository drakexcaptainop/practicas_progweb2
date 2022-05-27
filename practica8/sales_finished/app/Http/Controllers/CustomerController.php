<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Customer;
use DB;

class CustomerController extends Controller
{
    public function getCustomers() {
        return view('customerslist', [
            'customers' => Customer::all()
        ]);
    }

    public function showNewCustomer() {
        return view('newcustomer');
    }

    public function postCustomer(Request $request) {
        try {
            DB::beginTransaction();
            $requestData = $request->all();

            $user = User::create([
                'name' => $requestData['username'],
                'email' => $requestData['email'],
                'password' => Hash::make($requestData['password'])
            ]);

            Customer::create([
                'firstName' => $requestData['firstName'],
                'lastName' => $requestData['lastName'],
                'nit' => $requestData['nit'],
                'address' => $requestData['address'],
                'birthDate' => $requestData['birthDate'],
                'userId' => $user->id
            ]);

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
        }

        return redirect('/customers');
    }
}
