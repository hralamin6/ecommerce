<?php

namespace App\Http\Livewire\Admin;

use App\Models\ExtraPage;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class TermsServiceComponent extends Component
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
        $this->body = $data->terms_of_service;
    }
    public function Update()
    {
        $this->validate();
        $data = ExtraPage::findOrFail(1);
        $data->terms_of_service = $this->body;
        $data->save();
        session()->flash('success', 'Successfully updated');
        $this->alert('success', 'Successfully updated');
    }
    public function render()
    {
        $this->authorize('terms service', ExtraPage::class);
        return view('livewire.admin.terms-service-component');
    }
}
