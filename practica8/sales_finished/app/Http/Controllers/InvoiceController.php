<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Invoice;
use App\Models\Employee;
use App\Models\InvoiceDetail;

class InvoiceController extends Controller
{
    public function getInvoice($id) {
        $invoice = Invoice::find($id);
        $invoiceDetails = InvoiceDetail::where(['invoice_id' => $id])->get();
        $invoice->invoiceDetails = $invoiceDetails;
        return $invoice;
    }

    public function showNewInvoice() {
        return view('invoice');
    }

    public function postInvoice(Request $request) {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $employees = Employee::where(['user_id' => $user->id])->get();

            if (empty($employees)) {
                throw new Exception('Employee not found');
            }

            $invoiceNumber = Invoice::max('invoice_number') + 1;

            $invoice = Invoice::create([
                'invoiceNumber' => $invoiceNumber,
                'invoiceDate' => date('Y-m-d'),
                'employeeId' => $employees[0]->id,
                'customerId' => $request->customerId
            ]);

            foreach ($request->invoiceDetails as $invoiceDetail) {
                InvoiceDetail::create([
                    'productId' => $invoiceDetail['productId'],
                    'invoiceId' => $invoice->id,
                    'quantity' => $invoiceDetail['quantity']
                ]);
            }

            DB::commit();
            return ['result' => 1];
        } catch (Exception $ex) {
            DB::rollback();
        }

        return ['result' => 0];
    }
}
