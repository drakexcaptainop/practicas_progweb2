@extends('layouts.master')
@section('title', 'Customer List')
@section('content')
<script type="text/javascript">
    var app = angular.module('CustomerListModule', []);
    app.controller('CustomerListController', ($scope, $http) => {
        $scope.customers = [];

        angular.element(document).ready(() => {
            $http.get('/ajaxcustomers').then((result) => {
                $scope.customers = result.data;
            });
        });
    })
</script>
<div class="container" ng-app="CustomerListModule" ng-controller="CustomerListController">
    <h2>Customers List</h2>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>
                    NIT
                </th>
                <th>
                    First Name
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    Address
                </th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="customer in customers">
                <td>
                    @{{ customer.nit }}
                </td>
                <td>
                    @{{ customer.firstName }}
                </td>
                <td>
                    @{{ customer.lastName }}
                </td>
                <td>
                    @{{ customer.address }}
                </td>
            </tr>
        </tbody>
    </table>
    <a href="/ajaxnewcustomer" class="btn btn-primary">New Customer</a>
</div>
@stop