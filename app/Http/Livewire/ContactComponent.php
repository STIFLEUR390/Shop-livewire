<?php

namespace App\Http\Livewire;

use App\Models\{Contact, Setting};
use Livewire\Component;

class ContactComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $comment;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'comment' => 'required|min:15'
        ]);
    }

    public function sendMessage()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'comment' => 'required|min:15'
        ]);

        $contact = new Contact();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->comment = $this->comment;
        $contact->save();

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Merci, votre message a été envoyé avec succès',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>false,
            'position'=>'center',
            'showConfirmButton' => false,
        ]);
    }

    public function render()
    {
        $setting = Setting::find(1);
        return view('livewire.contact-component', compact('setting'))->layout('layouts.base');
    }
}
