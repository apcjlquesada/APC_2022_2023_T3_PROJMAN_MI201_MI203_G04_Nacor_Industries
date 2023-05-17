<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')-> insert(array(
            array(
                'u_id' => 00001,
                'u_fname' => "Jose",
                'u_mname' => "F.",
                'u_lname' => "Castillo",
                'email' => "jojoc@apc.edu.ph",
                'u_role' => "Admin",
                'password' => bcrypt('jojoc'),
                'u_division' => "ITRO",
                'u_divRole' => "ITRO Head",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00002,
                'u_fname' => "Grace Ann",
                'u_mname' => " ",
                'u_lname' => "Morte",
                'u_email' => "graceannm@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('graceannm'),
                'u_division' => "Infrastructure",
                'u_divRole' => "Server and Cloud Services",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00003,
                'u_fname' => "Val",
                'u_mname' => " ",
                'u_lname' => "Rodelas",
                'u_email' => "valr@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('valr'),
                'u_division' => "Infrastructure",
                'u_divRole' => "Server and Cloud Services Support",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00004,
                'u_fname' => "Ainard",
                'u_mname' => " ",
                'u_lname' => "Marcos",
                'u_email' => "ainardm@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('ainardm'),
                'u_division' => "Infrastructure",
                'u_divRole' => "Desktop Support",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00005,
                'u_fname' => "Reynan",
                'u_mname' => " ",
                'u_lname' => "Villanueva",
                'u_email' => "reynanv@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('reynanv'),
                'u_division' => "Infrastructure",
                'u_divRole' => "Audio/Video Equipment Support",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00006,
                'u_fname' => "Kimberly",
                'u_mname' => " ",
                'u_lname' => "Malate",
                'u_email' => "kimberlym@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('kimberlym'),
                'u_division' => "Software Development",
                'u_divRole' => "Software Development Head",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00007,
                'u_fname' => "Bravo",
                'u_mname' => " ",
                'u_lname' => "Delos Santos",
                'u_email' => "bravod@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('bravod'),
                'u_division' => "Software Development",
                'u_divRole' => "Software Development Team Lead",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00017,
                'u_fname' => "Cyrus",
                'u_mname' => " ",
                'u_lname' => "Gabila",
                'u_email' => "cyrusg@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('cyrusg'),
                'u_division' => "Software Development",
                'u_divRole' => "Software Developer",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00020,
                'u_fname' => "Ryan John",
                'u_mname' => " ",
                'u_lname' => "Perez",
                'u_email' => "ryanp@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('ryanp'),
                'u_division' => "Software Development",
                'u_divRole' => "Software Developer",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00010,
                'u_fname' => "Jlord",
                'u_mname' => " ",
                'u_lname' => "Tolentino",
                'u_email' => "jlordt@apc.edu.ph",
                'u_role' => "Staff",
                'u_password' => bcrypt('jlordt'),
                'u_division' => "Software Development",
                'u_divRole' => "Software Developer",
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00011,
                'u_fname' => "Kieyl",
                'u_mname' => "De Castro",
                'u_lname' => "Ponce",
                'u_email' => "kdponce@student.apc.edu.ph",
                'u_role' => "Client",
                'u_password' => bcrypt('kdponce'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00012,
                'u_fname' => "Patrick",
                'u_mname' => "A.",
                'u_lname' => "Cortez",
                'u_email' => "pacortez@student.apc.edu.ph",
                'u_role' => "Client",
                'u_password' => bcrypt('pacortez'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),
            array(
                'u_id' => 00013,
                'u_fname' => "Vincent",
                'u_mname' => "A.",
                'u_lname' => "Nacor",
                'u_email' => "vanacor@student.apc.edu.ph",
                'u_role' => "Client",
                'u_password' => bcrypt('vanacor'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),

            array(
                'u_id' => 00014,
                'u_fname' => "Allan Vincent",
                'u_mname' => "O.",
                'u_lname' => "Nefalar",
                'u_email' => "aonefalar@student.apc.edu.ph",
                'u_role' => "Client",
                'u_password' => bcrypt('aonefalar'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),

            array(
                'u_id' => 00015,
                'u_fname' => "Jakerson",
                'u_mname' => "B.",
                'u_lname' => "Bermudo",
                'u_email' => "jbbermudo@student.apc.edu.ph",
                'u_role' => "Client",
                'u_password' => bcrypt('jbbermudo'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            ),

            array(
                'u_id' => 00016,
                'u_fname' => "Princess",
                'u_mname' => "H.",
                'u_lname' => "Ferrer",
                'u_email' => "phferrer@student.apc.edu.ph",
                'u_role' => "Client",
                'u_password' => bcrypt('phferrer'),
                'u_division' => null,
                'u_divRole' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'created_at'=>null,
                'updated_at'=>null
            )


        ));
    }
}
