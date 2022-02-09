<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;

class LandingPage extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email'
    ];

    public function subscribe()
    {
        $this->validate();

        DB::transaction(function () {
            $subscriber = Subscriber::create([
                'email' => $this->email,
            ]);
    
            $notification = new VerifyEmail();

            //Overriding verfication url
            $notification->createUrlUsing( function( $notifiable ){
                return URL::temporarySignedRoute(
                    'subscribers.verfiy',
                    now()->addMinutes(30),
                    [
                        'subscriber' => $notifiable->getKey(),
                    ]
                );
            });
    
            $subscriber->notify($notification);            
        }, $deadlockRestries = 5);

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
