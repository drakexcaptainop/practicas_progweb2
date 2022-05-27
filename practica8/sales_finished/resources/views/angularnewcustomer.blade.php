@extends('layouts.master')
@section('title', 'New Customer')
@section('content')
<script type="text/javascript">
    var app = angular.module('CustomerAddModule', []);
    app.controller('CustomerAddController', ($scope, $http) => {
        $scope.customer = {};

        /**
            Realizar un llamado al servicio /ajaxcustomers/{id}
            Llenar el formulario con los datos retornados por el servidor

            16:20
         */

        /*angular.element(document).ready(() => {
            $http.get('/ajaxcustomers/7').then((result) => {
                $scope.customer = result.data;
            })
        });*/

        $scope.addCustomer = () => {
            $http.post('/ajaxcustomers', $scope.customer).then((result) => {
                if (result.data.result === 1) {
                    window.location.href = '/ajaxcustomerlist';
                }
            });
        }
    })
</script>
<div class="container" ng-app="CustomerAddModule" ng-controller="CustomerAddController">
    <form>
        <div class="form-group">
            <label for="txtFirstName">First name</label>
            <input id="txtFirstName" class="form-control" ng-model="customer.firstName" />
        </div>
        <div class="form-group">
            <label for="txtLastName">Last name</label>
            <input id="txtLastName" class="form-control" ng-model="customer.lastName" />
        </div>
        <div class="form-group">
            <label for="txtNit">NIT</label>
            <input id="txtNit" class="form-control" ng-model="customer.nit" />
        </div>
        <div class="form-group">
            <label for="txtAddress">Address</label>
            <input id="txtAddress" class="form-control" ng-model="customer.address" />
        </div>
        <div class="form-group">
            <label for="txtBirthDate">Birth Date</label>
            <input id="txtBirthDate" class="form-control" ng-model="customer.birthDate" />
        </div>
        <div class="form-group">
            <label for="txtUsername">Username</label>
            <input id="txtUsername" class="form-control" ng-model="customer.username" />
        </div>
        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input id="txtEmail" class="form-control" ng-model="customer.email" />
        </div>
        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input id="txtPassword" class="form-control" type="password" ng-model="customer.password" />
        </div>
        <input type="button" class="btn btn-primary" value="Send" ng-click="addCustomer()" />
        <a href="/customers" class="btn btn-primary">Back</a>
    </form>
</div>
@stop