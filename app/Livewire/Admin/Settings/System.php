<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Settings\System as SettingsSystem;
use Livewire\Component;
use Livewire\WithFileUploads;

class System extends Component
{
    use WithFileUploads;

    public $title = 'System';

    public $breadCrumb = 'Home.Settings.System';

    public $system = [];

    public function mount()
    {
        $system = SettingsSystem::get()->keyBy('key');
        if ($system->count()) {

            $this->system['name'] = isset($system['name']) ? $system['name']->value : '';
            $this->system['email'] = isset($system['email']) ? $system['email']->value : '';
            $this->system['phone'] = isset($system['phone']) ? $system['phone']->value : '';
            $this->system['address'] = isset($system['address']) ? $system['address']->value : '';
            $this->system['aLogoLight'] = isset($system['logoLight']) ?  $system['logoLight']->value : '';
            $this->system['aLogoDark'] = isset($system['logoDark']) ?  $system['logoDark']->value : '';
            $this->system['aFavicon'] = isset($system['favconLogo']) ?  $system['favconLogo']->value : '';
            $this->system['privacyPolicy'] = isset($system['privacyPolicy']) ?  $system['privacyPolicy']->value : '';
            $this->system['termNCondition'] = isset($system['termsNCondition']) ? $system['termsNCondition']->value : '';
            $this->system['aboutUs'] = isset($system['aboutUs']) ?  $system['aboutUs']->value : '';
            $this->system['facebook'] = isset($system['facebook']) ?  $system['facebook']->value : '';
            $this->system['instagram'] = isset($system['instagram']) ? $system['instagram']->value : '';
            $this->system['google'] = isset($system['google']) ?  $system['google']->value : '';
        }
    }

    public function update()
    {
        $data = [
            'name' => $this->system['name'],
            'address' => $this->system['address'],
            'email' => $this->system['email'],
            'phone' => $this->system['phone'],
            'privacyPolicy' => $this->system['privacyPolicy'],
            'termsNCondition' => $this->system['termNCondition'],
            'aboutUs' => $this->system['aboutUs'],
            'facebook' => $this->system['facebook'],
            'instagram' => $this->system['instagram'],
            'google' => $this->system['google'],
        ];

        if (isset($this->system['logoLight'])) {
            $file = $this->system['logoLight'];

            $name = $file->getClientOriginalName();

            $light = $file->storeAs('system', $name, ['disk' => 'public']);

            $data += ['logoLight' =>  isset($light) && !empty($light) ? asset($light) : ''];
        }

        if (isset($this->system['logoDark'])) {
            $file = $this->system['logoDark'];

            $name = $file->getClientOriginalName();

            $dark = $file->storeAs('system', $name, ['disk' => 'public']);

            $data += ['logoDark' =>  isset($dark) && !empty($dark) ? asset($dark) : ''];
        }

        if (isset($this->system['favicon'])) {
            $file =  $this->system['favicon'];

            $name = $file->getClientOriginalName();

            $favicon = $file->storeAs('system', $name, ['disk' => 'public']);

            $data += ['favconLogo' =>  isset($favicon) && !empty($favicon) ? asset($favicon) : ''];
        }

        foreach ($data as $key => $value) {
            $system = SettingsSystem::where('key', $key)->where('type', 'system')->first();

            if ($system) {
                $system->update([
                    'value' => $value
                ]);
            } else {
                SettingsSystem::create([
                    'key' => $key,
                    'value' => $value,
                    'type' => 'system'
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.system')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
