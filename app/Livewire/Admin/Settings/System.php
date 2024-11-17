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
        $system = SettingsSystem::first();
        if ($system) {
            $this->system['name'] = $system->name;
            $this->system['aLogoLight'] = $system->logoLight;
            $this->system['aLogoDark'] = $system->logoDark;
            $this->system['aFavicon'] = $system->favconLogo;
            $this->system['privacyPolicy'] = $system->privacyPolicy;
            $this->system['termNCondition'] = $system->termsNCondition;
            $this->system['aboutUs'] = $system->aboutUs;
            $this->system['facebook'] = $system->facebookLink;
            $this->system['instagram'] = $system->instagramLink;
            $this->system['pinterest'] = $system->pinterestLink;
        }
    }

    public function update()
    {
        $data = [
            'name' => $this->system['name'],
            'privacyPolicy' => $this->system['privacyPolicy'],
            'termsNCondition' => $this->system['termNCondition'],
            'aboutUs' => $this->system['aboutUs'],
            'facebookLink' => $this->system['facebook'],
            'instagramLink' => $this->system['instagram'],
            'pinterestLink' => $this->system['pinterest'],
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

        $system = SettingsSystem::first();

        if ($system) {
            $system->update($data);
        } else {
            SettingsSystem::create($data);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.system')->extends('admin.layout.master', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb])->section('content');
    }
}
