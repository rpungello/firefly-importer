<?php

namespace App\Livewire\Accounts;

use App\Enums\Filetype;
use App\Models\Account;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateAccount extends Component
{
    public string $name = '';

    public ?int $firefly_id = null;

    public string $account_number = '';

    public bool $credit_card = false;

    public bool $headers = true;

    public string $filetype = '';

    public function mount(): void
    {
        $this->filetype = Filetype::cases()[0]->value;
    }

    public function render(): View
    {
        return view('livewire.accounts.create-account');
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
        $account = Account::create($this->validate());

        $this->redirectRoute('accounts.edit', $account);
    }
}
