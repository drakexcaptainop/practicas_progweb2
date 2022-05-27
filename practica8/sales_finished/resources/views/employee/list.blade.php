@extends("layouts.master")
@section("content")

<script>
    angular.module("EmployeeApp", []).controller("EmployeeController", ($scope, $http)=>{
        $scope.emp = []
        $scope.get = function(){
            $http.get("/ajaxemployee").then(
                res => {
                    console.log(res)
                    $scope.emp = res.data
                }
            )
        }
        $scope.get()


        $scope.deleteEmployee = function(id){
            $http.delete("/ajaxemployee/" + id).then(
                res=>{
                    console.log(res)
                    $scope.get()
                }
            )
        }
    })
</script>

<div class="container" ng-app="EmployeeApp" ng-controller="EmployeeController">
    <div class="container bg-warning p-1" >
        <h1 >
            Employee List
        </h1>
    </div>
    <div>
        <a href="/employeenew" class="btn btn-primary" style="margin: 10px 0;">New Employee</a>
    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>
                    First Name
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    Birth Date
                </th>
                <th>
                    City
                </th>
                <th>
                    Address
                </th>
                <th>
                    Photo
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
            </tr>
        </thead>    
        <tbody>
            <tr ng-repeat = "e in emp">
                <td>
                    @{{e.firstName}}
                </td>
                <td>
                    @{{e.lastName}}
                </td>
                <td>
                    @{{e.birthDate}}
                </td>
                <td>
                    @{{e.city}}
                </td>
                <td>
                    @{{e.address}}
                </td>
                <td>
                    <img src="@{{e.photo}}" alt="No Photo" width="100px">
                </td>
                <td>
                    <a class="btn btn-warning" href="/employeeedit?id=@{{e.id}}">Edit Employee</a>
                </td>
                <td>
                    <button class="btn btn-danger" ng-click="deleteEmployee(e.id)">Delete Employee</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@stop