<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert(array(
            array(
                't_ID'=> 100001,
                'u_ID' => 11,
                't_Type' => "Query",
                't_date'=> '2023-01-04',
                't_time'=> '13:52:51',
                't_status'=>'pending',
                't_priority'=> 2,
                't_severity' => 3,
                't_category'=>'Infrastructure',
                't_assignedTo'=> null,
                't_cc' => null,
                't_title'=>"Broken Projector",
                't_content'=> "Need help in room 302 because the projector does not work",
                't_resolution'=> "Not yet resolved."


            ),
            array(
                't_ID'=> 100002,
                'u_ID' => 11,
                't_Type' => "Incident",
                't_date'=> '2023-01-05',
                't_time'=> '07:52:51',
                't_status'=>'ongoing',
                't_priority'=> 1,
                't_severity' => 5,
                't_category'=>'Infrastructure',
                't_assignedTo'=> null,
                't_cc' => null,
                't_title'=>"Server down",
                't_content'=> "Server is down. Need assistance",
                't_resolution'=> "Not yet resolved."
            ),
            array(
                't_ID'=> 100003,
                'u_ID' => 15,
                't_Type' => "Incident",
                't_date'=> '2023-02-07',
                't_time'=> '14:05:21',
                't_status'=>'New',
                't_priority'=> 3,
                't_severity' => 4,
                't_category'=>'Software',
                't_assignedTo'=> null,
                't_cc' => null,
                't_title'=>"Data Analysis",
                't_content'=> "Needs data analysis for enrollees",
                't_resolution'=> "Not yet resolved."
            ),
        ));
    }
}
