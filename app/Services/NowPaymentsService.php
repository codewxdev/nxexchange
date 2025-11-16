<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NowPaymentsService
{
    protected $apiKey;
    protected $endpoint;

    public function __construct()
    {
        $this->apiKey = config('services.nowpayments.api_key');
        $this->endpoint = config('services.nowpayments.endpoint');
    }

    // Create Invoice
    public function createInvoice(array $data)
    {
        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->endpoint}/invoice", $data)->json();
    }

    // Check Invoice Status
    public function getInvoiceStatus(string $invoiceId)
    {
        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get("{$this->endpoint}/invoice/{$invoiceId}")->json();
    }
}
