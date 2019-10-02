<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    
        Group::create(
            [
                'code' => 'ICT',
                'name' => 'Information Communication and Technology Group',
            ],
        );

        Group::create(
            [
                'name' => 'Federal Road Safety Corps Group',
                'code' => 'FRSC',
            ]
        );

        Group::create(
            [
                'name' => 'Corps Legal Aid Group',
                'code' => 'CLAG',
            ]
        );

        Group::create(
            [
                'name' => 'Sports Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Culture and Tourism Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Education Development Group',
                'code' => "EDG",
            ]
        );

        Group::create(
            [
                'name' => 'Environmental protection and Sanitation Group',
                'code' => "Ecovanguard, NESREA",
            ]
        );

        Group::create(
            [
                'name' => 'Editorial/Publicity Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Road Safety Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Reproductive Health & HIV/AIDS Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Anti-Corruption Group',
                'code' => "EFCC & ICPC",
            ]
        );

        Group::create(
            [
                'name' => 'State Delivery Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Medical and Health Services Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Drug Free and Quality Control Group',
                'code' => "NDLEA, NAFDAC, SON",
            ]
        );

        Group::create(
            [
                'name' => 'Agro Allied Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Charity Services and Gender Group',
                'code' => "",
            ]
        );

        Group::create(
            [
                'name' => 'Disaster Management Group',
                'code' => "",
            ]
        );
    }
}
