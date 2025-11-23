<?php

namespace App\Livewire\Accounts;

use App\Models\Account;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public Account $account;

    #[Validate(['required', 'file'])]
    public ?TemporaryUploadedFile $file = null;

    public function render(): View
    {
        return view('livewire.accounts.upload-file');
    }

    public function submit(): void
    {
        $this->validate();
    }
}
