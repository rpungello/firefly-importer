<?php

namespace App\Jobs;

use App\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected readonly Upload $upload) {}

    protected function processTransaction(array $transaction): void
    {
        $mapped = $this->upload->mapTransaction($transaction);

        try {
            $response = Http::firefly()->post('/v1/transactions', $mapped);
        } catch (ConnectionException|RequestException $e) {
            Log::error($e->getMessage(), [
                'upload_id' => $this->upload->getKey(),
                'transaction' => $transaction,
                'mapped' => $mapped,
            ]);
        }
    }
}
