<div class="flex flex-col bg-indigo-900 w-full h-screen"
    x-data="{
        showSubscribe: @entangle('showSubscribe'),
        showSuccessSubscribe: @entangle('showSuccessSubscribe'),
    }">
    <nav class="flex pt-5 justify-between container mx-auto text-indigo-200">
        <a class="text-4xl font-bold" href="/">
            <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
        </a>
        <div class="flex justify-end">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <div class="flex container mx-auto items-center h-full">
        <div class="flex flex-col w-1/3 items-start">
            <h1 class="text-white font-bold text-5xl leading-tight mb-4">
                Simple generic landing page to subscriber
            </h1>
            <p class="text-indigo-200 text-xl mb-10">
                We are just checking the <span class="font-bold underline">TALL</span> stack. Would you mind subscribing?
            </p>
            <x-button
                class="py-3 px-8 bg-red-500 hover:bg-red-600"
                x-on:click="showSubscribe = true">
                Subscribe
            </x-button>
        </div>
    </div>
    <x-modal class="bg-pink-500" trigger="showSubscribe">
        <p class="text-white text-5xl font-extrabold text-center">
            Let's do it!
        </p>
        <form wire:submit.prevent="subscribe"
            class="flex flex-col items-center p-24">
            <x-input
                class="py-5 px-3 w-80 border border-blue-400"
                type="email"
                name="email"
                placeholder="example@email.com"
                wire:model.defer="email"></x-input>
            
                <span class="text-gray-100 text-xs mt-1">
                    @error('email')
                        {{ $message }}
                    @else
                        We will send you a confirmation email.
                    @enderror
                </span>
            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                <span wire:loading wire:target="subscribe" class="animate-spin">
                    &#9696;
                </span>
                <span wire:loading.remove wire:target="subscribe">
                    Get In
                </span>
            </x-button>
        </form>
    </x-modal>

    <x-modal class="bg-green-500" trigger="showSuccessSubscribe">
        <p class="animate-pulse text-white text-9xl font-extrabold text-center">
            &check;
        </p>
        <p class="text-white text-5xl font-extrabold text-center mt-16">
            Greate!
        </p>

        @if ( request()->has('verified') && request()->verified == 1)
            <p class="text-white text-3xl text-center">
                thanks for confirming.
            </p>
        @else
            <p class="text-white text-3xl text-center">
                See you in your inbox.
            </p>
        @endif
    </x-modal>

</div>