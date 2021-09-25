<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;

    public function updateOrderStatus($order_id, $status)
    {
        $order = Order::find($order_id);
        $order->status  = $status;
        if ($status == 'delivered') {
            $order->delivered_date = DB::raw('CURRENT_DATE');
        } elseif ($status = 'canceled') {
            $order->canceled_date = DB::raw('CURRENT_DATE');
        }
        $order->save();
        $this->dispatchBrowserEvent('swal', [
            'title' => 'le statut du paiement a été mise à jour',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(12);
        return view('livewire.admin.admin-order-component', compact('orders'))->layout('layouts.base');
    }
}
