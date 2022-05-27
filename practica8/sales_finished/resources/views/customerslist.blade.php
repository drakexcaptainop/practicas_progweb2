@extends('layouts.master')
@section('title', 'Customers List')

@section('content')
<table class="table table-dark table-striped table-hover">
    <thead>
        <tr>
            <th>
                First name
            </th>
            <th>
                Last name
            </th>
            <th>
                NIT
            </th>
            <th>
                Birth Date
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>
                {{ $customer->firstName }}
            </td>
            <td>
                {{ $customer->lastName }}
            </td>
            <td>
                {{ $customer->nit }}
            </td>
            <td>
                {{ $customer->birthDate }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="/newcustomer" class="btn btn-primary">New Customer</a>
@stop