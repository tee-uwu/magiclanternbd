<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
            'product' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1|max:5',
            'delivery_area' => 'required|in:inside,outside',
            'delivery_charge' => 'required|integer|min:0',
            'total_price' => 'required|integer|min:0',
        ]);

        $expectedDelivery = $validated['delivery_area'] === 'inside' ? 70 : 130;
        $validated['delivery_charge'] = $expectedDelivery;

        Order::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'product' => $validated['product'],
            'color' => $validated['color'],
            'quantity' => $validated['quantity'],
            'delivery_area' => $validated['delivery_area'],
            'delivery_charge' => $validated['delivery_charge'],
            'total_price' => $validated['total_price'],
            'status' => 'pending',
        ]);

        return redirect('/#order')->with('success', 'order_success');
    }
}