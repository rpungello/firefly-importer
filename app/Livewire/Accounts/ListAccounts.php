<?php

namespace App\Livewire\Accounts;

use App\Models\Account;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListAccounts extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.accounts.list-accounts', [
            'accounts' => Account::query()->paginate(),
        ]);
    }
}
