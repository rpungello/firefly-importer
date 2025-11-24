<?php

namespace App\Jobs;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ProcessCsvUploadJob extends ProcessUploadJob
{
    protected function buildTransactionsFromSource(): Collection
    {
        $stream = Storage::disk($this->upload->disk)->readStream($this->upload->path);
        $result = collect();

        if ($this->upload->account->headers) {
            $headers = fgetcsv($stream);
        } else {
            $headers = [];
        }

        while (! feof($stream)) {
            $row = fgetcsv($stream);
            if (! empty($headers)) {
                $row = array_combine($headers, $row);
            }

            $result->push(
                $this->upload->mapTransaction($row)
            );

            return $result;
        }

        return $result;
    }
}
