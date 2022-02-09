<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function verfiy(Subscriber $subscriber){
        if( !$subscriber->hasVerifiedEmail() ){
            $subscriber->markEmailAsVerified();
        }
        return redirect('/?verfied=1');
    }
}
