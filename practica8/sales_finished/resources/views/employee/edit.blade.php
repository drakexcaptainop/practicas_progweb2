@extends("layouts.master")
@section("content")

<script>
    angular
    .module("EmployeeUpdateApp", [])
    .controller("EmployeeUpdateController", ($http, $scope)=>{
        $scope.e = {}
        let id = window.location.href.split("=")[1]
        $http.get("/ajaxemployee/"+id).then(res=>{
            let data = res.data
            console.log(data)
            data.employee.birthDate = new Date(data.employee.birthDate)
            Object.getOwnPropertyNames(data.user).forEach(a => $scope.e[a] = data.user[a])
            Object.getOwnPropertyNames(data.employee).forEach(a => $scope.e[a] = data.employee[a])
        })
        $scope.updateEmployee = function(){
            $scope.e.birthDate = $scope.e.birthDate.toISOString().split("T")[0] 
            $http.put("/ajaxemployee", $scope.e).then(
                res=>{
                    window.location.href = "/employeelist"
                }
            ).catch(err => console.log(err))
            
        }
    })
</script>
<style>
    .user-form-banner{
        border-radius : 4px;
        margin: 10px 0;
    }
    .btn-submit{
        margin: 10px 0 0 0;
        width: 20%;
        background-color: green;
    }
</style>
<div class="container" ng-app="EmployeeUpdateApp" ng-controller="EmployeeUpdateController">
    <form class="form">
    <div class="p-1 bg-warning user-form-banner">
            <h1>
                Employee form
            </h1>
        </div>
        <div>
            <label>First Name</label>
            <input type="text" class="form-control" ng-model="e.firstName">
        </div>
        <div>
            <label>Last Name</label>
            <input type="text" class="form-control" ng-model="e.lastName">
        </div>
        <div>
            <label>Address</label>
            <textarea style="resize:none;" cols="30" rows="10" class="form-control" ng-model="e.address"></textarea>
        </div>
        <div>
            <label>Birth Date</label>
            <input type="date" class="form-control" ng-model="e.birthDate">
        </div>
        <div>
            <label>city</label>
            <input type="text" class="form-control" ng-model="e.city">
        </div>
        <div class="p-1 bg-warning user-form-banner">
            <h1>
                User form
            </h1>
        </div>
        <div>
            <label>Username</label>
            <input type="text" class="form-control" ng-model="e.name">
        </div>
        <div>
            <label>Email</label>
            <input type="email" class="form-control" ng-model="e.email">
        </div>
        <div>
            <label>Password</label>
            <input type="password" class="form-control" ng-model="e.password">
        </div>
        <div>
            <button class="btn btn-primary btn-submit" ng-click="updateEmployee()">Submit</button>
        </div>
    </form>
</div>

@stop