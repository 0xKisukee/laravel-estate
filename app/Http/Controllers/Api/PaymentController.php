<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

    }

    public function show(Payment $payment)
    {
        $this->authorize('view', $payment);

        return response()->json($payment);
    }

    public function store(Request $request)
    {

    }

    public function update(Payment $payment, Request $request)
    {
        $this->authorize('update', $payment);

        $payment->update([
            'paid_date' => $request->validate(['required', 'string'])['paid_date'],
        ]);

        return response()->json($payment);
    }

    public function destroy(Payment $payment)
    {

    }
}
