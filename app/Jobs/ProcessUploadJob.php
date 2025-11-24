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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected readonly Upload $upload) {}

    public function handle(): void
    {
        $transactions = $this->buildTransactionsFromSource();
        $request = [
            'apply_rules' => false,
            'fire_webhooks' => true,
            'group_title' => "rpungello/firefly-importer (upload {$this->upload->getKey()})",
            'transactions' => $transactions->toArray(),
        ];

        try {
            Http::firefly()->post('/v1/transactions', $request);
        } catch (ConnectionException|RequestException $e) {
            Log::error($e->getMessage(), [
                'upload_id' => $this->upload->getKey(),
                'exception' => $e->getMessage(),
                'exception_class' => get_class($e),
            ]);
        }
    }

    abstract protected function buildTransactionsFromSource(): Collection;
}
