<?php namespace App\Console\Commands;

use App\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateNextItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'item:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the next item in the database and updates it.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the next item to be updated
        $nextItem = Item::orderBy('checked_at', 'asc')->first();

        // Update the checked_at time
        $nextItem->checked_at = Carbon::now()->toDateTimeString();

        // Save the model
        $nextItem->save();

        // Display a message to the command line
        $this->info("Item #{$nextItem->id} updated");
    }
}
