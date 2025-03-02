<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DeleteExpiredStories extends Command
{
    protected $signature = 'stories:delete';
    protected $description = 'Delete stories older than 24 hours';

    public function handle()
    {
        Story::where('created_at', '<', Carbon::now()->subDay())->delete();
        $this->info('Expired stories deleted.');
    }
}

