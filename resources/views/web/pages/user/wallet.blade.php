@extends('web.layouts.layout')

@section('content')
<div class="page-content-wrapper">
    <!-- Product Catagories-->
    <div class="product-catagories-wrapper py-3">
        <div class="container">
            <div class="product-catagory-wrap">
                <div class="row g-3">
                    <!-- Single Catagory Card-->
                    <div class="col-12">
                        <div class="card catagory-card">
                            <div class="align-items-center card-body d-flex justify-content-between pt-4">
                                <div>
                                    <a class="text-danger" href="#">
                                        <span class="text-dark lh-1">I-Balance</span>
                                    </a>
                                    <div style="color: #27173E;" class="fs-2 fw-bold value">
                                        {{ \App\Helper::counter_price($income_balance) }}</div>
                                </div>
                                <h1 class="fs-4">&vert;</h1>
                                <div>
                                    <a class="text-danger" href="#">
                                        <span class="text-dark lh-1">E-Balance</span>
                                    </a>
                                    <div style="color: #27173E;" class="fs-2 fw-bold value">{{ $shop_wallet }}</div>
                                </div>

                            </div>
                            <div class="card-body py-0">
                                <hr>
                            </div>
                            <div class="pt-0 card-body d-flex gap-1 justify-content-between">
                                <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                                    <a id="withdrawBtn" href="{{ route('b2e.withdraw.form') }}"
                                        class="border-0 badge-danger align-content-center align-items-center d-fle d-flex justify-content-center"
                                        style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 46px;width: 46px;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.7099 11.29C17.617 11.1963 17.5064 11.1219 17.3845 11.0711C17.2627 11.0203 17.132 10.9942 16.9999 10.9942C16.8679 10.9942 16.7372 11.0203 16.6154 11.0711C16.4935 11.1219 16.3829 11.1963 16.2899 11.29L12.9999 14.59V7C12.9999 6.73478 12.8946 6.48043 12.707 6.29289C12.5195 6.10536 12.2652 6 11.9999 6C11.7347 6 11.4804 6.10536 11.2928 6.29289C11.1053 6.48043 10.9999 6.73478 10.9999 7V14.59L7.70994 11.29C7.52164 11.1017 7.26624 10.9959 6.99994 10.9959C6.73364 10.9959 6.47825 11.1017 6.28994 11.29C6.10164 11.4783 5.99585 11.7337 5.99585 12C5.99585 12.2663 6.10164 12.5217 6.28994 12.71L11.2899 17.71C11.385 17.801 11.4972 17.8724 11.6199 17.92C11.7396 17.9729 11.8691 18.0002 11.9999 18.0002C12.1308 18.0002 12.2602 17.9729 12.3799 17.92C12.5027 17.8724 12.6148 17.801 12.7099 17.71L17.7099 12.71C17.8037 12.617 17.8781 12.5064 17.9288 12.3846C17.9796 12.2627 18.0057 12.132 18.0057 12C18.0057 11.868 17.9796 11.7373 17.9288 11.6154C17.8781 11.4936 17.8037 11.383 17.7099 11.29Z"
                                                fill="#fff" />
                                        </svg>
                                    </a>
                                    <div class="text-dark small">Withdraw</div>
                                </div>
                                <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                                    <a id="sendMoneyBtn" href="{{ route('b2e.send.money.form') }}"
                                        class="border-0 badge-primary align-content-center align-items-center d-fle d-flex justify-content-center"
                                        style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 46px;width: 46px;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.92 11.62C17.8724 11.4972 17.801 11.3851 17.71 11.29L12.71 6.29C12.6168 6.19676 12.5061 6.1228 12.3842 6.07234C12.2624 6.02188 12.1319 5.99591 12 5.99591C11.7337 5.99591 11.4783 6.10169 11.29 6.29C11.1968 6.38324 11.1228 6.49393 11.0723 6.61575C11.0219 6.73757 10.9959 6.86814 10.9959 7C10.9959 7.2663 11.1017 7.52169 11.29 7.71L14.59 11H7C6.73478 11 6.48043 11.1054 6.29289 11.2929C6.10536 11.4804 6 11.7348 6 12C6 12.2652 6.10536 12.5196 6.29289 12.7071C6.48043 12.8946 6.73478 13 7 13H14.59L11.29 16.29C11.1963 16.383 11.1219 16.4936 11.0711 16.6154C11.0203 16.7373 10.9942 16.868 10.9942 17C10.9942 17.132 11.0203 17.2627 11.0711 17.3846C11.1219 17.5064 11.1963 17.617 11.29 17.71C11.383 17.8037 11.4936 17.8781 11.6154 17.9289C11.7373 17.9797 11.868 18.0058 12 18.0058C12.132 18.0058 12.2627 17.9797 12.3846 17.9289C12.5064 17.8781 12.617 17.8037 12.71 17.71L17.71 12.71C17.801 12.6149 17.8724 12.5027 17.92 12.38C18.02 12.1365 18.02 11.8635 17.92 11.62Z"
                                                fill="#fff" />
                                        </svg>
                                    </a>
                                    <div class="text-dark small">Send</div>
                                </div>
                                <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                                    <a href=""
                                        class="badge-success align-content-center align-items-center d-fle d-flex justify-content-center"
                                        style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 46px;width: 46px;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 20H4C2.89543 20 2 19.1046 2 18V6C2 4.89543 2.89543 4 4 4H20C21.1046 4 22 4.89543 22 6V18C22 19.1046 21.1046 20 20 20ZM4 12V18H20V12H4ZM4 6V8H20V6H4ZM13 16H6V14H13V16Z"
                                                fill="#fff" />
                                        </svg>
                                    </a>
                                    <div class="text-dark small">Cards</div>
                                </div>
                                <div class="align-items-center d-flex flex-column gap-2 justify-content-center">
                                    <a href="{{ route('b2e.exchange.form') }}"
                                        class="badge-warning align-content-center align-items-center d-fle d-flex justify-content-center"
                                        style="background: rgba(98,54,255,0.1);border-radius: 1em;height: 46px;width: 46px;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7 22L3 18L7 14V17H17V13H19V18C19 18.5523 18.5523 19 18 19H7V22ZM7 11H5V6C5 5.44772 5.44772 5 6 5H17V2L21 6L17 10V7H7V11Z"
                                                fill="#fff" />
                                        </svg>
                                    </a>
                                    <div class="text-dark small">Exchange</div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- Single Catagory Card-->
                    <div class="col-6">
                        <div class="card catagory-card">
                            <div class="card-body">
                                <a class="text-danger" href="{{ route('statement.income.balance') }}">
                                    <span class="text-black-50 lh-1">I-Balance (Income)</span>
                                </a>
                                <div style="color:#1DCC70 !important" class="fs-2 fw-bold value">
                                    + {{ $balance_income }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Catagory Card-->
                    <div class="col-6">
                        <div class="card catagory-card">
                            <div class="card-body">
                                <a class="text-danger" href="{{ route('statement.income.balance') }}">
                                    <span class="text-black-50 lh-1">I-Balance (Expenses)</span>
                                </a>
                                <div class="fs-2 fw-bold text-danger value "> - {{ $balance_expense  }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Catagory Card-->
                    <div class="col-6">
                        <div class="card catagory-card">
                            <div class="card-body">
                                <a class="text-danger" href="{{ route('statement.shop.balance') }}">
                                    <span class="text-black-50 lh-1">E-Balance (Income)</span>
                                </a>
                                <div style="color:#1DCC70 !important" class="fs-2 fw-bold  value text-green">
                                    + {{ $point_income }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Catagory Card-->
                    <div class="col-6">
                        <div class="card catagory-card">
                            <div class="card-body pe-sm-1 ">
                                <a class="text-danger" href="{{ route('statement.shop.balance') }}">
                                    <span class="text-black-50 lh-1">E-Balance (Expenses)</span>
                                </a>
                                <div class="fs-2 fw-bold value text-danger">- {{ $point_expense }}</div>
                            </div>
                        </div>

                    </div>
                    <div class="card-head">
                        Transaction History
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr class="border-bottom">
                                            <th>#</th>
                                            <th class="text-left">Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                        <tr class="border-bottom">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{!! $transaction->note ?? null !!} <br> <strong>Time: </strong>
                                                {{ $transaction->updated_at->format('d-m-Y h:i A') }} </td>
                                            <td>{{ \App\Helper::counter_price($transaction->amount) }}</td>
                                            <td>{{ $transaction->status ? "Completed" : "Pending" }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3">No records found!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>

                            </div>

                            @if($transactions->links())
                            <div class="card-footer">
                                {{ $transactions->render() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection