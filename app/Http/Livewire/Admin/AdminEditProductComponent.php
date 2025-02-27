<?php

namespace App\Http\Livewire\Admin;

use App\Models\{AttributeValue, Category, Product, ProductAttribute, Subcategory};
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

    public $attr;
    public $inputs = [];
    public $attribute_arr = [];
    public $attribute_values = [];


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
        $this->inputs = $product->attributeValues->where('product_id', $product->id)->unique('product_attribute_id')->pluck('product_attribute_id');
        $this->attribute_arr = $product->attributeValues->where('product_id', $product->id)->unique('product_attribute_id')->pluck('product_attribute_id');

        foreach ($this->attribute_arr as $a_arr) {
            $allAttributevalue = AttributeValue::where('product_id', $product->id)->where('product_attribute_id', $a_arr)->get()->pluck('value');
            $valueString = '';
            foreach ($allAttributevalue as $value) {
                $valueString = $valueString.$value.',';
            }
            $this->attribute_values[$a_arr] = rtrim($valueString, ',');
        }
    }

    public function remove($attr)
    {
        unset($this->inputs[$attr]);
    }

    public function add()
    {
        if (!$this->attribute_arr->contains($this->attr)) {
            $this->inputs->push($this->attr);
            $this->attribute_arr->push($this->attr);
        }
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

        AttributeValue::where('product_id', $product->id)->delete();
        foreach ($this->attribute_values as $key => $attribute_value) {
            $avalues = explode(",", $attribute_value);
            foreach ($avalues as $avalue) {
                $attr_value = new AttributeValue();
                $attr_value->product_attribute_id = $key;
                $attr_value->value = $avalue;
                $attr_value->product_id = $product->id;
                $attr_value->save();
            }
        }

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

        $product_attributes = ProductAttribute::all();
        return view('livewire.admin.admin-edit-product-component', compact('product_attributes' ,'categories', 'sub_categories'))->layout('layouts.base');
    }
}
