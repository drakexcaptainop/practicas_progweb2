<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Models\User;
use App\Models\Customer;

class AjaxCustomerController extends Controller
{
    public function showCustomerList() {
        return view('angularcustomerlist');
    }

    public function showNewCustomer() {
        return view('angularnewcustomer');
    }

    public function getCustomerById($id) {
        return Customer::find($id);
    }

    public function getCustomers(Request $req) {
        $criteria = [];

        if ($req->nit) {
            array_push($criteria, ['nit', $req->nit]);
        }

        return Customer::where($criteria)->get();
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
            return ['result' => 1];
        } catch(Exception $ex) {
            DB::rollback();
        }

        return ['result' => 0];
    }

    public function putCustomer(Request $request) {
        try {
            DB::beginTransaction();

            $requestData = $request->all();

            $customer = Customer::find($requestData['id']);
            $customer->firstName = $requestData['firstName'];
            $customer->lastName = $requestData['lastName'];
            $customer->nit = $requestData['nit'];
            $customer->address = $requestData['address'];
            $customer->birthDate = $requestData['birthDate'];
            
            $user = User::find($customer->userId);
            $user->password = Hash::make($requestData['password']);

            $customer->save();
            $user->save();

            DB::commit();
            return ['result' => 1];
        } catch (Exception $ex) {
            DB::rollback();
        }

        return ['result' => 0];
    }
}
