<?php

namespace App\Http\Controllers;

use App\Models\ExtraPage;
use Illuminate\Http\Request;

class ExtraPageController extends Controller
{
    public function TermsConditions(){
        $data = ExtraPage::find(1)->terms_conditions;
        return view('web.pages.terms-conditions', compact('data'));
    }
    public function TermsService(){
        $data = ExtraPage::find(1)->terms_of_service;
        return view('web.pages.terms-service', compact('data'));
    }
    public function RefundPolicy(){
        $data = ExtraPage::find(1)->refund_policy;
        return view('web.pages.refund-policy', compact('data'));
    }
    public function AboutUs(){
        $data = ExtraPage::find(1)->about_us;
        return view('web.pages.about-us', compact('data'));
    }
    public function PrivacyPolicy(){
        $data = ExtraPage::find(1)->privacy_policy;
        return view('web.pages.privacy-policy', compact('data'));
    }
}
