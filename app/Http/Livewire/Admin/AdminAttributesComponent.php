<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProductAttribute;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAttributesComponent extends Component
{
    use WithPagination;

    public $product_attribute_id;

    protected $listeners = ['confirmed' => 'confirmed', 'cancelled' => 'cancelled'];

    public function deleteAttribute($id)
    {
        $this->product_attribute_id = $id;
        $product_attribute = ProductAttribute::find($id);
        $message = "Voulez vous supprimer l'atrribut ". $product_attribute->name;
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
        $product_attributes = ProductAttribute::paginate(10);
        return view('livewire.admin.admin-attributes-component', compact('product_attributes'))->layout('layouts.base');
    }

    public function confirmed()
    {
        $coupon = ProductAttribute::find($this->product_attribute_id);
        $coupon->delete();
        // session()->flash('message', 'La categorie a bien été suprimer');
        $this->alert('success', 'L\'attribut a été supprimé avec succès', [
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
