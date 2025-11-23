<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Storage;

class ProcessCsvUploadJob extends ProcessUploadJob
{
    public function handle(): void
    {
        $stream = Storage::disk($this->upload->disk)->readStream($this->upload->path);
        if ($this->upload->account->headers) {
            $headers = fgetcsv($stream);
        } else {
            $headers = [];
        }
    }
}
