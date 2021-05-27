@extends('layouts.app')

@section('content')
<div class='flex ml-10 mt-10 space-x-96'>
<h2 class="text-3xl mb-10">
    Hello {{ auth()->user()->name }}!
</h2>
    <div class="flex justify-end">
    <two-factor-auth :enabled="{{ json_encode(auth()->user()->twoFactorAuthEnabled()) }}"></two-factor-auth>
    </div>
</div>

<!-- THIS WORKS IT JUST NEEDS STRUCTURE -->
@if  ($accountCollection->all() == [])
<div class="flex justify-center">You don't have an account yet. Press "Create Account" to start.</div>
    @else
    <div class="">
    @foreach($accountCollection->all() as $account)
        <form method="POST">
            @csrf
            <div id='container' class="border-solid border-4 border-blue-800 ml-10 ml-10">
                <div id='account_info' class="ml-3">
                    <div class="flex">
                    <label id='account_type_label' for='account_type'><b>Account Type: </b></label>
                        <p name='account_type' class=""> {{$account->account_type}}</p>
                    </div>
                    <div class="flex">
                    <label id='account_number_label' for='account_number'><b>IBAN: </b></label>
                        <p name='account_number'> {{$account->account_number}}</p>
                        <input name='account_number' type="hidden" value="{{$account->account_number}}"/>
                    </div>
                    <div class="flex">
                        <label id='balance' for='balance'><b>Balance: </b> </label>
                        <p name='balance'> {{$account->current_balance}} {{ $account->currency }}</p>
                    </div>
                </div>
                <br>
                <div class="">
                    <input name='accountId' type="hidden" value="{{ $account->id }}"/>
                    <button class="bg-green-800 hover:bg-green-600 text-white font-bold py-2 px-4 border border-black-700 rounded m-3" formaction="/account/{{ $account->id }}">Use This Account</button>
                </div>
            </div>
        </form >
        <br>
    @endforeach
    </div>
    @endif
<div class='mr-10'>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    
    <button class="bg-blue-200 hover:bg-blue-400 text-black font-bold py-2 px-4 border border-black-700 rounded ml-10">Logout</button>
</form>
</div>
<div class="flex justify-center">
    <form id='acc' method='GET'>
        <input type="hidden" name='id' value="{{ auth()->user()->id }}"/>

        @csrf
        <button class="bg-blue-800 hover:bg-blue-600 text-white font-bold py-2 px-4 border border-black-700 rounded ml-10 mt-3 mb-10" formaction="/create-account">Create Account</button>
        <button class="bg-blue-800 hover:bg-blue-600 text-white font-bold py-2 px-4 border border-black-700 rounded ml-10 mt-3 mb-10" formaction="/transaction-history">Transaction Hisory</button>
    </form>
</div>
@endsection
