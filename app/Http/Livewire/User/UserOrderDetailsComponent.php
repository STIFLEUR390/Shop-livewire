<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{

    public $order_id;

    protected $listeners = ['confirmed' => 'confirmed', 'cancelled' => 'cancelled'];

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function cancelOrder()
    {
        $message = "Voullez vous annule la commande";
        $this->confirm($message, [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Annulé',
            'confirmButtonText' => 'Supprimer',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->first();
        return view('livewire.user.user-order-details-component', ['order'=> $order])->layout('layouts.base');
    }

    public function confirmed()
    {
        $order = Order::find($this->order_id);
        $order->status = "canceled";
        $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->save();
        // order has been canceled
        $this->dispatchBrowserEvent('swal', [
            'title' => 'La commande a été annulé',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }

    public function cancelled()
    {
        // Example code inside cancelled callback
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Commande non annulé',
            'timer'=>3000,
            'icon'=>'info',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }
}
