<?php

namespace App\Http\Livewire\Admin;

use App\Models\{Category, Product, Subcategory};
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $newimage;
    public $product_id;
    public $images;
    public $newimages;
    public $sub_category_id;


    protected function rules()
    {
        return [
            'name' => 'required',
            'slug' => ['required', Rule::unique('products')->ignore(Product::find($this->product_id))],
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'newimage' => 'nullable|mimes:jpeg,png',
            'category_id' => 'required',
            'newimages' => 'nullable',
            'newimages.*' => 'mimes:jpeg,jpg,png,gif',
        ];
    }

    public function mount($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->images= explode(',', $product->images);
        $this->category_id = $product->category_id;
        $this->sub_category_id = $product->subcategory_id;
        $this->product_id = $product->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name,'-');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateProduct()
    {
        $this->validate();

        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        if ($this->newimage) {
            unlink('assets/images/products'.'/'.$product->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('products', $imageName);
            $product->image = $imageName;
        }
        if ($this->newimages) {
            if ($product->images) {
                $images = explode(',', $product->images);
                foreach ($images as $image) {
                    if ($image) {
                        unlink('assets/images/products'.'/'.$image);
                    }
                }
            }

            $imagesname = '';
            foreach ($this->newimages as $key => $image) {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products', $imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $product->images = $imagesname;
        }
        $product->category_id = $this->category_id;
        if ($this->sub_category_id) {
            $product->subcategory_id = $this->sub_category_id;
        }
        $product->save();

        // session()->flash('message', 'Le produit a été mise a jour avec succes');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Le produit a été mise a jour avec succès',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }

    public function changeSubcategory()
    {
        $this->sub_category_id = 0;
    }

    public function render()
    {
        $categories = Category::all();
        $sub_categories = Subcategory::where('category_id', $this->category_id)->get();
        return view('livewire.admin.admin-edit-product-component', compact('categories', 'sub_categories'))->layout('layouts.base');
    }
}
