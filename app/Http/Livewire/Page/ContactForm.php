<?php

namespace App\Http\Livewire\Page;

use Livewire\Component;
use App\Models\ContactFormData;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Validation\ValidationException;

class ContactForm extends Component
{
    use WithRateLimiting;

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
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'email' => "Slow down! Please wait another {$exception->secondsUntilAvailable} seconds.",
            ]);
        }

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
