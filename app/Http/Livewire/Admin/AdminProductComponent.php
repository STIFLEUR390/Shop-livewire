<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;

    public $product_id;

    protected $listeners = ['confirmed' => 'confirmed', 'cancelled' => 'cancelled'];


    public function deleteproduct($id)
    {
        $this->product_id = $id;
        $product = Product::find($id);
        if ($product->image) {
           unlink('assets/images/products'.'/'.$product->image);
        }
        if ($product->images) {
            $images = explode(',', $product->images);
            foreach ($images as $image) {
                if ($image) {
                    unlink('assets/images/products'.'/'.$image);
                }
            }
        }
        $message = "confirmer la suppression du produit: ". $product->name;
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
        $products = Product::paginate(10);
        return view('livewire.admin.admin-product-component', compact('products'))->layout('layouts.base');
    }

    public function confirmed()
    {
        $product = Product::find($this->product_id);
        $product->delete();
        // session()->flash('message', 'La categorie a bien été suprimer');
        $this->alert('success', 'Le produit a bien été suprimer', [
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
        $this->alert('info', 'Suppression annulé', [
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
