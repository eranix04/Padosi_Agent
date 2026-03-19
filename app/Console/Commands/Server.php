<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Server extends Command
{
    /**
     * Alias command for environments configured with `php artisan server`.
     */
    protected $signature = 'server {--host=} {--port=}';

    /**
     * The console command description.
     */
    protected $description = 'Alias for php artisan serve';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $host = $this->option('host') ?: env('SERVER_HOST', '0.0.0.0');
        $port = (string) ($this->option('port') ?: env('PORT', 8000));

        return (int) $this->call('serve', [
            '--host' => $host,
            '--port' => $port,
        ]);
    }
}
