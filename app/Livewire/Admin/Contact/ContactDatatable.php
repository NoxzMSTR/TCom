<?php

namespace App\Livewire\Admin\Contact;

use App\Models\Contacts;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class ContactDatatable extends DataTableComponent
{
    protected $model = Contacts::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()->searchable(),
            Column::make("Email", "email")
                ->sortable()->searchable(),
            Column::make("Phone", "phone")
                ->sortable()->searchable(),
            Column::make("Subject", "subject")
                ->sortable()->searchable(),
            Column::make("Message", "message")
                ->sortable()->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public $title = 'Contact List';

    public $breadCrumb = 'Home.Contact.List';

    public function view()
    {
        return view('livewire.admin.contact.contact-list', ['title' => $this->title, 'breadCrumb' => $this->breadCrumb]);
    }
}
