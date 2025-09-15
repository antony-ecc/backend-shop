<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $invoices = Invoice::where('customer_id', Auth::user()->id)->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Invoice' . Auth::user()->name,
            'data' => $invoices,
        ], 200);
    }

    public function show($snap_token)
    {
        $invoice = Invoice::with('orders')->where('customer_id', Auth::user()->id)->where('snap_token', $snap_token)->latest()->first();

        return response()->json([
            'success' => true,
            'message' => 'List Invoice' . Auth::user()->name,
            'data' => $invoice,
        ], 200);
    }
}
