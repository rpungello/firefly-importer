<?php

namespace App\Livewire\Accounts;

use App\Enums\Filetype;
use App\Models\Account;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditAccount extends Component
{
    public Account $account;

    public string $name = '';

    public ?int $firefly_id = null;

    public string $account_number = '';

    public bool $credit_card = false;

    public bool $headers = true;

    public string $filetype = '';

    public function mount(): void
    {
        $this->name = $this->account->name;
        $this->firefly_id = $this->account->firefly_id;
        $this->account_number = $this->account->account_number;
        $this->credit_card = $this->account->credit_card;
        $this->headers = $this->account->headers;
        $this->filetype = $this->account->filetype->value;
    }

    public function render(): View
    {
        return view('livewire.accounts.edit-account');
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'firefly_id' => ['required', 'integer', 'min:1'],
            'account_number' => ['required', 'max:255'],
            'credit_card' => ['required', 'boolean'],
            'headers' => ['required', 'boolean'],
            'filetype' => ['required', Rule::enum(Filetype::class)],
        ];
    }

    public function submit(): void
    {
        $this->account->update($this->validate());

        Flux::toast('Account updated', variant: 'success');
    }
}
