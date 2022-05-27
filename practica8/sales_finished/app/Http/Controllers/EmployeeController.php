<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\User;
use DB;
class EmployeeController extends Controller
{
    function getEmployees()
    {
        return Employee::all();
    }
    function getEmployeeById($id)
    {
        $employee = Employee::where(["id"=>$id])->first();
        $user = User::where(["id"=>$employee->userId])->first();
        return ["user"=>$user, "employee"=>$employee];
    }
    function postEmployee(Request $req)
    {
        $res = ["res" => "ok"];
        try {
            DB::beginTransaction();
            $user = User::create([
                "name" => $req->username,
                "email" => $req->email,
                "password" => Hash::make($req->password)
            ]);

            Employee::create([
                "firstName" => $req->firstName,
                "lastName" => $req->lastName,
                "city" => $req->city,
                "address" => $req->address,
                "birthDate" => $req->birthDate,
                "userId" => $user->id,
                "photo" => ""
            ]);
            DB::commit();
        } catch (Exeption $e) {
            DB::rollback();
            $res["res"] = "err";
        }
        return $res;
    }

    function updateEmployee(Request $req)
    {
        $res = ["res" => "ok"];
        try {
            DB::beginTransaction();
            $employee = Employee::where(["id"=>$req->id])->first();
            $user = User::where(["id"=>$employee->userId])->first();

            $employee->firstName = $req->firstName;
            $employee->lastName = $req->lastName;
            $employee->city = $req->city;
            $employee->address = $req->address;
            $employee->birthDate = $req->birthDate;

            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = $req->password;

            $employee->update();
            $user->update();

            DB::commit();
        } catch (Exeption $e) {
            DB::rollback();
            $res["res"] = "err";
        }
        return $res;
    }

    function deleteEmployee($id)
    {
        $res = ["res"=>"ok"];
        try {
            $employee = Employee::where(["id"=>$id])->first();
            $user = User::where(["id"=>$employee->userId])->first();
            $employee->delete();
            $user->delete();
        } catch (Exeption $e) {
            $res = ["res"=>"err"];
        }
        return $res;
    }
    public static function getListView()
    {
        return view("employee.list");
    }
    function getNewView()
    {
        return view("employee.new");
    }
    function getEditView()
    {
        return view("employee.edit");
    }
}
