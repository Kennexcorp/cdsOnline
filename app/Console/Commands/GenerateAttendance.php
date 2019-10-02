<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SupervisorGroup;
use App\User;
use Illuminate\Support\Carbon;

class GenerateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Monthly attendance sheet for members';

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
     * @return mixed
     */
    public function handle()
    {
        //
        $supervisorGroups = SupervisorGroup::all();

        $members = User::role('Member')->get();

        foreach ($members as $member) {
            # code...

            //$member = User::where('group_id', $group->group_id)->role('Member')->first();

            $member->attendance()->create([
                'profile_user_id' => $member->id,
            ]);
        }


    }
}
