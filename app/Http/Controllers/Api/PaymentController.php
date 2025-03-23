<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function show(Payment $payment)
    {

    }

    public function store(Request $request)
    {

    }

    public function update(Payment $payment, Request $request)
    {

    }

    public function destroy(Payment $payment)
    {

    }

    public function recordPayment(Payment $payment)
    {
        $payment->update([
            'paid_date' => now()
        ]);

        return response()->json($payment);
    }
}
