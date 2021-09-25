<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminCouponsComponent extends Component
{
    public $coupon_id;
    protected $listeners = ['confirmed' => 'confirmed', 'cancelled' => 'cancelled'];

    public function deleteCoupon($id)
    {
        $this->coupon_id = $id;
        $coupon = Coupon::find($id);
        $message = "confirmer du coupon: ". $coupon->code;
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
        $coupons = Coupon::all();
        return view('livewire.admin.admin-coupons-component', compact('coupons'))->layout('layouts.base');
    }

    public function confirmed()
    {
        $coupon = Coupon::find($this->coupon_id);
        $coupon->delete();
        // session()->flash('message', 'La categorie a bien été suprimer');
        $this->alert('success', 'Le coupon a bien été suprimer', [
            'position' =>  'center',
            'timer' =>  3000,
            'toast' =>  false,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }

    public function cancelled()
    {
        // Example code inside cancelled callback
        $this->alert('info', 'suppression annulé', [
            'position' =>  'center',
            'timer' =>  3000,
            'toast' =>  false,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
      ]);
    }
}
