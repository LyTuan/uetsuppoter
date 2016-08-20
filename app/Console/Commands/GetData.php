<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\UetNews;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'upd:data';

    protected $signature = 'upd:data';

    protected $description = 'Update data';

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
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $app = new UetNews;
        $this->info("updated!");
        $app->point();
    }
}
