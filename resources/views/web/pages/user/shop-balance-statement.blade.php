@extends('web.layouts.layout')
@section('content')

<div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <div class="container">
                <div class="fw-bold py-2 text-center text-success text-uppercase small">
                    E-Balance statement
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="about-content-wrap">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="small">
                                        <td class="py-1">Joining Bonus</td>
                                        <td class="py-1">@taka($verification_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Product Purchase Bonus</td>
                                        <td class="py-1">@taka($product_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Generation Purchase Bonus</td>
                                        <td class="py-1">@taka($purchase_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Incentive Bonus</td>
                                        <td class="py-1">@taka($incentive_balance)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Received Balance</td>
                                        <td class="py-1">@taka($received_balance)</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-0">
                                        <th class="text-success border-0">Total Income</th>
                                        <th class="text-success border-0">@taka($point_income)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="fw-bold pt-3 py-2 small text-center text-danger text-uppercase">
                    Expense statement
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="about-content-wrap">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="small">
                                        <td class="py-1">Product Purchase</td>
                                        <td class="py-1">@taka($purchase_expense)</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-0">
                                        <th class="text-success border-0">Total Expense</th>
                                        <th class="text-success border-0">@taka($point_expense)</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection