<?php

namespace App\Commands;

use App\Models\SimArchive;
use App\Libraries\TrustedTime;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class PurgeExpiredSims extends BaseCommand
{
    protected $group       = 'Archive';
    protected $name        = 'sims:purge-expired';
    protected $description = 'Permanently deletes archived SIMs after 100 days.';

    public function run(array $params)
    {
        $archiveModel = new SimArchive();

        try {
            $trustedTime = new TrustedTime();
            $now = $trustedTime->nowUtc();
        } catch (\Exception $e) {
            CLI::error('Cannot purge because internet time cannot be verified.');
            return;
        }

        $archiveModel
            ->where('restore_until_utc IS NOT NULL')
            ->where('restore_until_utc <=', $now->format('Y-m-d H:i:s'))
            ->delete();

        CLI::write('Expired archived SIMs permanently deleted.', 'green');
    }
}