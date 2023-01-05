@extends('web.layouts.layout')
@section('content')


<div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area   justify-content-center">
        <form action="{{ route('b2e.send.money') }}" method="post" class="py-5">
            @csrf
            <div class="form-group mb-3">
                <label for="inputUser">User</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    id="inputUser" placeholder="Enter receiver username" value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="inputAmount">Amount</label>
                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"
                    id="inputAmount" placeholder="Enter withdraw amount" value="{{ old('amount', 0) }}">
                @error('amount')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="inputAmount">Note</label>
                <textarea name="note" id="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                    placeholder="Enter your message (optional)">{{ old('note') }}</textarea>
                @error('note')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>


            <button class="btn btn-warning btn-lg w-100" type="submit">Send Money</button>
        </form>

    </div>
</div>
</div>


@endsection