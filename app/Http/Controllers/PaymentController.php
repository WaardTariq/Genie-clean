<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentIndex()
    {
        return view('admin.payment.all');
    }
}
