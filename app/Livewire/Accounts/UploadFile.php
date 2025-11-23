<?php

namespace App\Livewire\Accounts;

use App\Enums\Filetype;
use App\Jobs\ProcessCsvUploadJob;
use App\Models\Account;
use Flux\Flux;
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

        $upload = $this->account->uploads()->create([
            'disk' => config('filesystems.default'),
            'path' => $this->file->store('uploads'),
            'size' => $this->file->getSize(),
        ]);

        if ($this->account->filetype === Filetype::Csv) {
            ProcessCsvUploadJob::dispatch($upload);
        } else {
            Flux::toast('Unknown account type', variant: 'warning');
        }
    }
}
