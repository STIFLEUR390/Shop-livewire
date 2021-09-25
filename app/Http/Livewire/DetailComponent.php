<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailComponent extends Component
{
    public $slug;
    public $qty;

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price)->associate('App\Models\Product');
        alert()->success('Success','Le produit a été ajouter au panier');
        return redirect()->route('product.cart');
    }

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->qty = 1;
    }

    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreaseQuantity()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $releated_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(5)->get();
        $sale = Sale::find(1);
        return view('livewire.detail-component', compact('sale', 'product', 'popular_products', 'releated_products'))->layout('layouts.base');
    }
}
