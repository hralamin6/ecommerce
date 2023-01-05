<?php

namespace App\Http\Livewire\Admin;

use App\Models\ExtraPage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    use AuthorizesRequests;

    public $body;
    public function rules()
    {
        return [
            'body' => 'required',
        ];
    }
    public function mount()
    {
        $data = ExtraPage::findOrFail(1);
        $this->body = $data->privacy_policy;
    }
    public function Update()
    {
        $this->validate();
        $data = ExtraPage::findOrFail(1);
        $data->privacy_policy = $this->body;
        $data->save();
        session()->flash('success', 'Successfully updated');
        $this->alert('success', 'Successfully updated');
    }
    public function render()
    {
        $this->authorize('privacy policy', ExtraPage::class);
        return view('livewire.admin.privacy-policy-component');
    }
}
