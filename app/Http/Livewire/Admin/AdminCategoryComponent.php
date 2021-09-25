<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public $catehory_id;

    protected $listeners = ['confirmed' => 'confirmed', 'cancelled' => 'cancelled'];

    public function deleteCategory($id)
    {
        $this->catehory_id = $id;
        $category = Category::find($id);
        $message = "confirmer la suppression de la catégorie: ". $category->name;
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
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component', compact('categories'))->layout('layouts.base');
    }

    public function confirmed()
    {
        $category = Category::find($this->catehory_id);
        $category->delete();
        // session()->flash('message', 'La categorie a bien été suprimer');
        $this->alert('success', 'La categorie a bien été suprimer', [
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
