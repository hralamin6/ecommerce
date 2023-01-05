@extends('web.layouts.layout')
@section('content')


<div class="container">
    <!-- Checkout Wrapper-->
    <div class="checkout-wrapper-area   justify-content-center">
        <form action="{{ route('b2e.withdraw') }}" method="post" class="py-5 row">
            @csrf
            <p class="mt-3 text-center"> {{ __('crud.withdraw.minimum') }} .10% withdraw charge applicable</p>
            <div class="form-group mb-3 col-12 col-sm-6">
                <label for="payment-number">Payment to</label>
                <input type="string" name="payment_number"
                    class="form-control @error('payment_number') is-invalid @enderror" id="payment-number"
                    placeholder="01XXXXXXXXX" value="{{ old('payment_number') }}" required>
                @error('payment_number')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3 col-12 col-sm-6">
                <label for="payment_method">Number type</label>
                <select name="payment_method_type" class="form-control" id="payment_method">
                    <option value="" hidden selected>Select one</option>
                    <option value="0">Personal</option>
                    <option value="1">Agent</option>
                </select>
                @error('payment_method')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3 col-12 col-sm-6">
                <label for="payment_method">Payment method</label>
                <select name="payment_method" class="form-control" id="payment_method">
                    <option value="" hidden selected>Select one</option>
                    <option value="bkash">BKash</option>
                    <option value="nagad">Nagad</option>
                    <option value="rocket">Rocket</option>
                </select>
                @error('payment_method')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3 col-12 col-sm-6">
                <label for="inputAmount">Amount</label>
                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"
                    id="inputAmount" placeholder="Enter withdraw amount" value="{{ old('amount') }}" required>
                @error('amount')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3 col-12 col-sm-6">
                <label for="inputAmount">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="inputAmount" placeholder="Enter your password" required>
                @error('password')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3 col-12 col-sm-6">
                <label for="inputAmount">Note</label>
                <textarea name="note" id="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                    placeholder="Enter your message (optional)">{{ old('note') }}</textarea>
                @error('note')
                <div class="invalid-feedback d-block">
                    {{ ucfirst($message) }}
                </div>
                @enderror
            </div>


            <button class="btn btn-warning btn-lg w-100" type="submit">Send Withdraw request</button>
        </form>

    </div>
</div>
</div>


@endsection