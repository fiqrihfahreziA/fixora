<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearPengajuanCache extends Command
{
    protected $signature = 'cache:clear-pengajuan {id?}';
    protected $description = 'Clear pengajuan cache';

    public function handle()
    {
        $id = $this->argument('id');
        
        if ($id) {
            Cache::forget('pengajuan_detail_' . $id);
            Cache::forget('pengajuan_print_' . $id);
            $this->info('Cache for pengajuan ID ' . $id . ' cleared!');
        } else {
            // Clear all pengajuan cache
            Cache::flush();
            $this->info('All cache cleared!');
        }
    }
}