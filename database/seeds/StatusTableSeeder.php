<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [

            [
                'name' => 'Active', //1
                'style' => 'success'
            ],
            [
                'name' => 'Pending',//2
                'style' => 'warning'
            ],

            [
                'name' => 'Passed Out',//3
                'style' => 'primary'
            ],

            [
                'name' => 'Queried',//4
                'style' => 'warning'
            ],
            [
                'name' => 'Absent',//5
                'style' => 'danger'
            ],
            [
                'name' => 'Declined',//6
                'style' => 'danger'
            ],
            
            [
                'name' => 'Inactive',//10
                'style' => 'secondary'
            ]

        ];

        foreach ($statuses as $status) {
            # code...
            Status::create([
                
                'name' => $status['name'],
                'style' => $status['style']
                
            ]);
        }
    }
}
