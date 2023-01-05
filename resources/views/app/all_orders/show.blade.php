@extends('layouts.app')
@section('title') Order #{{ $orders->code }} @endsection
@section('section-title') Order #{{ $orders->code }} @endsection
@section('section-content')
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>Invoice</h2>
                        <div class="invoice-number">Order #{{ $orders->code }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{ $orders->created_at->format('M d, Y') }}<br><br>
                            </address>
                            <address class="text-capitalize">
                                <strong>Payment Method:</strong><br>
                                {{ $orders->payment_type ?? '-' }}<br>
                                @if($orders->payment_type == 'mobile banking')
                                    <strong>
                                        Payment from {{ $orders->payment_number }} and TRX ID: {{ $orders->trx }}
                                    </strong>
                                @endif
                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong>Shipped To:</strong><br>
                                {!! $orders->shipping_address !!}
                            </address>

                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                            @foreach($orders->allOrderDetails as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->products->id }}</td>
                                    <td>{{ $orderItem->products->name }} @if($orderItem->sku) ({{ $orderItem->sku }})@endif</td>
                                    <td>
                                        <x-partials.thumbnail src="{{ asset($orderItem->products->thumbnail_img) }}"/>
                                    </td>
                                    <td>{{ $orderItem->price }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>{{ $orderItem->price *  $orderItem->quantity }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-8 text-capitalize">
                            <address>
                                <strong>{{ __('crud.all_orders.inputs.payment_status') }} :</strong><br>
                                {{ $orders->payment_status ?? '-' }}
                            </address>
                        </div>
                        <div class="col-lg-4  text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div
                                    class="invoice-detail-value">{{ ($orders->grand_total - $orders->shipping_cost) ?? '-' }}</div>
                            </div>
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Shipping</div>
                                <div class="invoice-detail-value">{{ $orders->shipping_cost ?? '-' }}</div>
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div
                                    class="invoice-detail-value invoice-detail-value-lg">{{ $orders->grand_total ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="d-print-none">
        <div class="text-md-right d-print-none">
            <div class="float-lg-left mb-lg-0 mb-3">
                <a class="btn btn-danger btn-icon icon-left" href="{{ route('all-orders.index') }}"><i
                        class="fas fa-times"></i> Back</a>
            </div>
            <button class="btn btn-warning btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i>
                Print
            </button>
        </div>
    </div>


@endsection
@push('scripts')

@endpush
