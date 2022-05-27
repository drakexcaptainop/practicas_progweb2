@extends('layouts.master')
@section('title', 'Invoices')
@section('content')
<script>
    var app = angular.module('InvoiceAddModule', ['ngMaterial']);
    app.controller('InvoiceAddController', ($scope, $http, $mdDialog) => {
        $scope.invoice = {invoiceDetails: []};
        $scope.invoiceForm = {}
        $scope.products = []
        $scope.controller = this

        angular.element(document).ready(() => {
            $http.get('/products').then((result) => {
                $scope.products = result.data;
            })
        });

        $scope.searchNit = () => {
            $http({
                url: '/ajaxcustomers', 
                method: 'GET',
                params: { nit: $scope.invoice.nit }
            }).then((result) => {
                let customers = result.data;

                if (customers.length === 0) {
                    alert('Customer does not exist');
                    return;
                }

                $scope.invoice.customerId = customers[0].id;
                $scope.invoiceForm.customerName = customers[0].firstName + ' ' + customers[0].lastName;
            })
        }

        $scope.showProductDialog = () => {
            $mdDialog.show({
                title: 'Select product',
                clickOutsideToClose: true,
                template: document.querySelector('#dlginvoiceForm').innerHTML,
                controller: function() {
                    return $scope.controller
                },
                controllerAs: 'ctrl'
            });

        }

        $scope.addProduct = () => {
            let product = _.find($scope.products, p => {
                return p.id === parseInt($scope.invoiceForm.productId)
            });
            
            $scope.invoice.invoiceDetails.push({
                productId: $scope.invoiceForm.productId,
                productName: product.name,
                productPrice: product.price,
                quantity: $scope.invoiceForm.quantity,
                subtotal: product.price * $scope.invoiceForm.quantity
            });

            console.log($scope.invoice.invoiceDetails)
            $mdDialog.hide();
        }

        $scope.postInvoice = () => {
            $http.post('/invoices', $scope.invoice).then((response) => {
                let res = response.data.result;

                if (res == 1) {
                    alert('Invoice registered')
                } else {
                    alert('Invoice registration error')
                }
            })
        }
    })
</script>
<div class="content" ng-app="InvoiceAddModule" ng-controller="InvoiceAddController">
    <h2>
        Invoice Registration
    </h2>
    <form class="form">
        <div class="form-group">
            <label for="txtNit">NIT:</label>
            <input id="txtNit" ng-model="invoice.nit" ng-blur="searchNit()" />
            @{{ invoiceForm.customerName }}
        </div>
        <div class="form-group">
            <label>Product:</label>
            <select class="form-control" ng-model="invoiceForm.productId">
                <option ng-repeat="product in products" value="@{{ product.id }}">
                    @{{ product.name }}
                </option>
            </select>
            <label>Quantity:</label>
            <input class="form-control" ng-model="invoiceForm.quantity" />
        </div>
        <md-button class="md-primary md-raised" ng-click="addProduct()">
            Add product
        </md-button>
    </form>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>
                    Product
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Subtotal
                </th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="detail in invoice.invoiceDetails">
                <td>
                    @{{ detail.productName }}
                </td>
                <td>
                    @{{ detail.productPrice }}
                </td>
                <td>
                    @{{ detail.quantity }}
                </td>
                <td>
                    @{{ detail.subtotal }}
                </td>
            </tr>
        </tbody>
    </table>
    <md-button class="md-primary md-raised" ng-click="postInvoice()">
            Post invoice
    </md-button>
</div>

@stop