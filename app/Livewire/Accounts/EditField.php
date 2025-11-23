<?php

namespace App\Livewire\Accounts;

use App\Models\Field;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditField extends Component
{
    public Field $field;

    #[Validate(['required', 'max:255'])]
    public string $source_name;

    #[Validate(['required', 'max:255'])]
    public string $destination_field;

    #[Validate(['nullable', 'json'])]
    public ?string $map = null;

    public function mount(): void
    {
        $this->source_name = $this->field->source_name;
        $this->destination_field = $this->field->destination_field;
        if (! empty($this->field->map)) {
            $this->map = json_encode($this->field->map, JSON_PRETTY_PRINT);
        }
    }

    public function render(): View
    {
        return view('livewire.accounts.edit-field');
    }

    public function save(): void
    {
        $this->field->update([
            'source_name' => $this->source_name,
            'destination_field' => $this->destination_field,
            'map' => json_decode($this->map),
        ]);

        Flux::toast('Field updated', variant: 'success');
        $this->field->refresh();
        $this->mount();
    }
}
