<?php

namespace App\Livewire\Accounts;

use App\Models\Field;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditField extends Component
{
    public Field $field;
    public function render(): View
    {
        return view('livewire.accounts.edit-field');
    }
}
