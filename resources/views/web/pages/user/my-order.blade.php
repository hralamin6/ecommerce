@extends('web.layouts.layout')
@section('content')
@php $orders = auth()->user()->allOrders()->latest()->paginate(10) @endphp
<div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <!-- User Information-->
            <div class="card">
                <div class="card-header">
                    <h3>All orders</h3>
                </div>
                <div class="card-body table-responsive-md">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Grand total</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->code }}</td>
                                <td>@taka($order->grand_total)</td>
                                <td class="text-capitalize">{{ $order->payment_status }}</td>
                                <td class="text-capitalize ">{{ $order->delivery_status }}</td>
                                <td class="text-capitalize"><a
                                        href="{{ route('b2e.my-orders.details',['id'=>encrypt($order->id)]) }}"
                                        class="btn btn-info">View</a></td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No orders yet!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    @if($orders->links())
                    {{ $orders->render() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection