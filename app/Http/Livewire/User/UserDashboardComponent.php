<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboardComponent extends Component
{
    public function render()
    {
        // 'ordered','delivered','canceled'
        $orders = Order::where('user_id', Auth::user()->id)->latest()->get()->take(10);
        $totalCost = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->sum('total');
        $totalPurchase = Order::where('status', '!=', 'canceled')->where('user_id', Auth::user()->id)->count();
        $totalDelivered = Order::where('status', 'delivered')->where('user_id', Auth::user()->id)->count();
        $totalCanceled = Order::where('status', 'canceled')->where('user_id', Auth::user()->id)->count();
        return view('livewire.user.user-dashboard-component', compact('totalCanceled' ,'totalDelivered' ,'totalPurchase' ,'orders', 'totalCost'))->layout('layouts.base');
    }
}
