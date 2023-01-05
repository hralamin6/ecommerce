<?php

namespace App\Http\Livewire\Admin;

use App\Models\ExtraPage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TermsConditionsComponent extends Component
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
        $this->body = $data->terms_conditions;
    }
    public function Update()
    {
        $this->validate();
        $data = ExtraPage::findOrFail(1);
        $data->terms_conditions = $this->body;
        $data->save();
        session()->flash('success', 'Successfully updated');
        $this->alert('success', 'Successfully updated');
    }
    public function render()
    {
        $this->authorize('terms conditions', ExtraPage::class);
        return view('livewire.admin.terms-conditions-component');
    }
}
