<?php

namespace App\Console\Commands;

use App\Models\LandOwner;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\PropertiesList;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class HandlePackageExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:handle-package-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::error('Command runs every minute.');
        $expiredPackages = OrderPackage::where('expire_date', '<=', Carbon::now())
        ->where('status', 'active')
        ->get();
            foreach ($expiredPackages as $package) {
                $package->status = 'inactive';
                $package->plan_type = 'past';
                $package->save(); 
                Log::error("Package expired and status updated for package ID: {$package->id}");
            }
            $landowners = LandOwner::whereHas('OrderPackage', function($query) {
                $query->where('status', 'active');
            })->get();
            foreach ($landowners as $owner) {
                foreach ($owner->OrderPackage as $orderPackage) {
                    $ex_future = Carbon::parse($orderPackage->start_date)
                                      ->addDays($orderPackage->future_listing_days);
                    if ($ex_future <= Carbon::now()) {
                        PropertiesList::where('land_owner_id', $owner->id)
                            ->update(['future_property' => 0]);
                            Log::error("updated future status");
                            Log::error($owner->id);
                    }
                }
            }
    }
}
