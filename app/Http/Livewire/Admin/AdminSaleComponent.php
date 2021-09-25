<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Livewire\Component;

class AdminSaleComponent extends Component
{
    public $sale_date;
    public $status;

    public function mount()
    {
        $sale = Sale::find(1);
        $this->sale_date = $sale->sale_date;
        $this->status = $sale->status;
    }

    public function updateSale()
    {
        $sale = Sale::find(1);
        $sale->sale_date = $this->sale_date;
        $sale->status = $this->status;
        $sale->save();

        // session()->flash('message', 'L\'enregistrement a été mis à jour avec succès');
        $this->alert('success', 'L\'enregistrement a été mis à jour avec succès', [
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

    public function render()
    {
        return view('livewire.admin.admin-sale-component')->layout('layouts.base');
    }
}
