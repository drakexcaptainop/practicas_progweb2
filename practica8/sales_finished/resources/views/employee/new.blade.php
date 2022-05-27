@extends("layouts.master")
@section("content")

<script>
    angular
    .module("EmployeeInsertApp", [])
    .controller("EmployeeInsertController", ($http, $scope)=>{
        $scope.e = {} 
        $scope.addEmployee = function(){
            $scope.e.birthDate = $scope.e.birthDate.toISOString().split(/[t]/i)[0] 
            $http.post("/ajaxemployee", $scope.e).then(
                res => {
                    if(res.data.res=="ok") window.location.href = "/employeelist"
                    else alert("ERR: " + res.headers.status)
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
<div class="container" ng-app="EmployeeInsertApp" ng-controller="EmployeeInsertController">
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
            <label>City</label>
            <select type="text" class="form-control" ng-model="e.city">
                <option value="Paris">Paris</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Madrid">Madrid</option>
            </select>
        </div>
        <div class="p-1 bg-warning user-form-banner">
            <h1>
                User form
            </h1>
        </div>
        <div>
            <label>Username</label>
            <input type="text" class="form-control" ng-model="e.username">
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
            <button class="btn btn-primary btn-submit" ng-click="addEmployee()">Submit</button>
        </div>
    </form>
</div>

@stop