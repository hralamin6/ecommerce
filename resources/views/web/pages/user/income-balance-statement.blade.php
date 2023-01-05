@extends('web.layouts.layout')
@section('content')

<div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
            <div class="container">
                <div class="fw-bold py-2 text-center text-success text-uppercase small">
                    Income statement
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="about-content-wrap">
                            <table class="table table-hover">
                                <tbody>
                                    <tr class="small">
                                        <td class="py-1">Referral Income</td>
                                        <td class="py-1">@taka($referral_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Work Income</td>
                                        <td class="py-1">@taka($work_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Rank Income</td>
                                        <td class="py-1">@taka($rank_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Sharing Income</td>
                                        <td class="py-1">@taka($generation_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Incentive Income</td>
                                        <td class="py-1">@taka($incentive_income)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Receive Balance</td>
                                        <td class="py-1">@taka($received_balance)</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-0">
                                        <th class="text-success border-0">Total Income</th>
                                        <th class="text-success border-0">@taka($balance_income)</th>
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
                                        <td class="py-1">Withdraw </td>
                                        <td class="py-1">@taka($withdraw_expense)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Send Money </td>
                                        <td class="py-1">@taka($send_expense)</td>
                                    </tr>
                                    <tr class="small">
                                        <td class="py-1">Purchase </td>
                                        <td class="py-1">@taka($income_expense)</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-0">
                                        <th class="text-success border-0">Total Expense</th>
                                        <th class="text-success border-0">@taka($balance_expense)</th>
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
