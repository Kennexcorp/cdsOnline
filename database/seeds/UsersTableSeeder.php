<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create(
            [
                'name' => 'Demo Admin',
                'email' => 'admin@cds.com',
                'password' => Hash::make('123456'),
                'status_id' => 1,
                'email_verified_at' => "2018-11-10 09:03:01",
                'created_at' =>  new DateTime(),
                'updated_at' =>  new DateTime(),
            ]
        );
        $user1->assignRole('Admin');

        $user2 = User::create(
            [
                'name' => 'Demo Supervisor',
                'email' => 'supervisor@cds.com',
                'password' => Hash::make('123456'),
                'status_id' => 1,
                'email_verified_at' => "2018-11-10 09:03:01",
                'created_at' =>  new DateTime(),
                'updated_at' =>  new DateTime(),
            ]
        );
        
        $user2->profile()->updateOrCreate([
            'first_name' => 'Demo',
            'last_name' => 'Official',
            'state' => 'Plateau State',
            'lga' => 'Jos North',
            'phone_number' => '08169311714'
        ]);

        $user2->assignRole('Supervisor');

        $user3 = User::create(
            [
                'name' => 'Demo Official',
                'email' => 'official@cds.com',
                'password' => Hash::make('123456'),
                'status_id' => 1,
                'email_verified_at' => "2018-11-10 09:03:01",
                'created_at' =>  new DateTime(),
                'updated_at' =>  new DateTime(),
            ]
        );

        

        $user3->assignRole('Official');


        $user4 = User::create(
            [
                'name' => 'PL18C0984',
                'email' => 'ekeneoguikpu@gmail.com',
                'password' => Hash::make('123456'),
                'status_id' => 1,
                'email_verified_at' => "2018-11-10 09:03:01",
                'created_at' =>  new DateTime(),
                'updated_at' =>  new DateTime(),
            ]
        );

        $user4->profile()->updateOrCreate([
            'group_id' => 1,
            'dob' => '3-Feb-1995',
            'ppa' => 'TechFusion',
            'avatar' => 'test',
            'state_code' => 'PL18C0984',
            'state' => 'Plateau',
            'lga' => 'Jos South',
            'first_name' => 'Ekene',
            'last_name' => 'Oguikpu',
            'phone_number' => '08169311714'
        ]);

        $user4->attendance()->create([
            'profile_user_id' => $user4->id,
        ]);
        
        $user4->assignRole('Member');

       
    }
}
