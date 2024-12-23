<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckUsersDueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:users-due-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if users due date reached and update account package and status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $now = Carbon::now();
        foreach($users as $user){
            if($user->package_due_date < $now){
                $user->package_id = null;
                $user->package = null;
                $user->company_no = null;
                $user->users_no = null;
                $user->has_paid = 0;
                $user->update();
            }
        }
    }
}
