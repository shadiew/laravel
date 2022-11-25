<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Provider;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use to check order status from providers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::whereIn('status', ['Pending', 'Processing', 'Partial', 'In Progress'])->get();
        foreach ($orders as $value) {
            $service = Service::where('id', $value->service_id)->first();
            $provider = Provider::where('id', $service->provider_id)->first();

            // CHECK ORDER TO PROVIDER
            $postData = [
                'key' => $provider->api_key,
                'action' => 'status',
                'order' => $value->provider_order_id
            ];
            $response = Http::withHeaders([
                // 'Authorization' => 'Bearer ' . $apiKey,
            ])->post($provider->link, $postData);
            $responseJSON = $response->json();

            if (isset($responseJSON["status"])) {
                $updateOrder = Order::where('id', $value->id)->first();
                $updateOrder->update([
                    'status' => $responseJSON["status"],
                    'provider_service_price' => $responseJSON["charge"],
                    'start_count' => $responseJSON["start_count"],
                    'remains' => $responseJSON["remains"],
                    'note_check' => $responseJSON
                ]);

                $this->info('Updated Status To: ' . $responseJSON["status"] . ' For Order: ' . $value->id . ' From Provider: ' . $provider->code);
                $this->newLine();

                Log::channel('checkorder')->info('Updated Status To: ' . $responseJSON["status"] . ' For Order: ' . $value->id . ' From Provider: ' . $provider->code);
            } else {
                $updateOrder = Order::where('id', $value->id)->first();
                $updateOrder->update([
                    'note_check' => $responseJSON,
                    // 'status' => 'Error',
                ]);
                $this->info('Error for Order: ' . $value->id);
                $this->newLine();

                Log::channel('checkorder')->error('Error for Order: ' . $value->id);
            }
        }

        $this->newLine(3);
        $this->line('End Of Check');
    }
}
