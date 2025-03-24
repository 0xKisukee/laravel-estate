<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {

    }

    public function show(Payment $payment)
    {
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json($payment);
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
