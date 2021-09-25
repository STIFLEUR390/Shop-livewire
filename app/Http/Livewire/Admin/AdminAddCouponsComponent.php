<?php

namespace App\Http\Livewire\Admin;

use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponsComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $expiry_date;

    protected $rules = [
        'code' => 'required|unique:coupons',
        'type' => 'required',
        'value' => 'required|numeric',
        'cart_value' => 'required|numeric',
        'expiry_date' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeCoupon()
    {
        $this->validate();
        $coupon = new Coupon();
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->value = $this->value;
        $coupon->cart_value = $this->cart_value;
        $coupon->expiry_date = $this->expiry_date;
        $coupon->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'le coupon a été créé avec succès',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.admin-add-coupons-component')->layout('layouts.base');
    }
}
