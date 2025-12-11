<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Website;
use App\Mail\WebsiteDownMail;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Exception;

class MonitorWebsiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public Website $website;

    /**
     * Create a new job instance.
     */
    public function __construct(Website $website)
    {
    $this->website = $website;
    }
    /**
     * Execute the job.
     */
    public function handle()
    {
    $client = new Client(['timeout' => 10, 'connect_timeout' => 5, 'http_errors' => false]);


    try {
    $response = $client->get($this->website->url);
    $status = $response->getStatusCode();


    $this->website->update([
    'last_status_code' => $status,
    'last_checked_at' => now(),
    ]);


    if ($status < 200 || $status >= 300) {
    Mail::to($this->website->client->email)
    ->send(new WebsiteDownMail($this->website));
    }


    } catch (Exception $e) {
    // unreachable or timeout
    $this->website->update([
    'last_status_code' => null,
    'last_checked_at' => now(),
    ]);


    Mail::to($this->website->client->email)
    ->send(new WebsiteDownMail($this->website));
    }
    }
}
