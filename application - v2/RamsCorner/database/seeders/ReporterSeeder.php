<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reporters')-> insert(array(
            array(
                'u_id' => 00004,
                'u_name' => "Allan Vincent Nefalar",
                'email' => "aonefalar2@student.apc.edu.ph",
                'u_role' => "Client",
                'password' => bcrypt('aonefalar'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>now(),
                'updated_at'=>null
            ),
            array(
                'u_id' => 00005,
                'u_name' => "Kieyl Ponce",
                'email' => "kdponce@student.apc.edu.ph",
                'u_role' => "Client",
                'password' => bcrypt('kdponce'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>now(),
                'updated_at'=>null
            ),
            array(
                'u_id' => 00006,
                'u_name' => "Manuel Calimlim Jr.",
                'email' => "manuelc@apc.edu.ph",
                'u_role' => "Client",
                'password' => bcrypt('manuelc'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>now(),
                'updated_at'=>null
            )


        ));
    }
}
