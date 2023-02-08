<?php

namespace App\Http\Livewire\Page;

use App\Models\ContactFormData;
use Livewire\Component;

class ContactForm extends Component
{

    public $name;
    public $email;
    public $message;
    public $successMsg;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required|min:5',
    ];


    public function render()
    {
        return view('livewire.page.contact-form');
    }

    public function submitForm()
    {
        $this->validate();
        ContactFormData::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);
        $this->reset(['message']);
        $this->successMsg = 'Your inquiry has been submitted successfuly!';
    }

    public function boot()
    {
        $this->name =   auth()->user() ? auth()->user()->name : '';
        $this->email =   auth()->user() ? auth()->user()->email : '';
    }
}
