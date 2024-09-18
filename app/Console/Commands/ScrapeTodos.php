<?php

namespace App\Console\Commands;

use App\Models\Todo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ScrapeTodos extends Command
{
    const HTTPS_JSONPLACEHOLDER_TYPICODE_COM_TODOS = 'https://jsonplaceholder.typicode.com/todos';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-todos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $response = Http::get(self::HTTPS_JSONPLACEHOLDER_TYPICODE_COM_TODOS);
        if (!$response->successful()) {
            $this->error('Http request fail');

            return;
        }

        $data = $response->json();

        if (!is_array($data)) {
            $this->error('Response data is not an array');

            return;
        }

        Todo::insert(
            collect($data)
                ->filter(
                    static fn (array $item) => !empty($item['title'])
                )->map(static function (array $item): array {
                    return [
                        'completed' => $item['completed'] ?? false,
                        'title' => $item['title'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })
                ->toArray()
        );
    }
}
