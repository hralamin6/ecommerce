<?php

namespace App\Http\Livewire\Admin;

use App\Models\ExtraPage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AboutUsComponent extends Component
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
        $this->body = $data->about_us;
    }
    public function Update()
    {
        $this->validate();
        $data = ExtraPage::findOrFail(1);
        $data->about_us = $this->body;
        $data->save();
        session()->flash('success', 'Successfully updated');
        $this->alert('success', 'Successfully updated');
    }
    public function render()
    {
        $this->authorize('about us', ExtraPage::class);
        return view('livewire.admin.about-us-component');
    }
}
