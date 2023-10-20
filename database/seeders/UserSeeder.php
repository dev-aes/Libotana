<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $users = array(

            // generate sample admin
            [
                'id' => 1,
                'name' => 'Administrator',
                'gender' => 'male',
                'address' => 'Sample Address',
                'contact' => '09659312003',
                'email' => 'admin@gmail.com', 
                'password' => bcrypt('test1234'),
                'verification_token' => null,
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::ADMIN,
                'created_at' => now()
            ],
 
           // generate user
            [
                'id' => 2,
                'name' => 'Dummy Dummy',
                'gender' => 'male',
                'address' => 'Sample Address',
                'contact' => '09659312003',
                'email' => 'dummy@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'verification_token' => null,
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Carlo Bolivar',
                'gender' => 'male',
                'address' => 'Sample Address',
                'contact' => '09513486453',
                'email' => 'cbolivar@cca.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'verification_token' => null,
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Al Patrick Capili ',
                'gender' => 'male',
                'address' => 'Sample Address',
                'contact' => '09362744396',
                'email' => 'apcapili@cca.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'verification_token' => null,
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Jonel Catacutan',
                'gender' => 'male',
                'address' => 'Sample Address',
                'contact' => '09369703705',
                'email' => 'jcatacutan@cca.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'verification_token' => null,
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Alyzza De Leon ',
                'gender' => 'male',
                'address' => 'Sample Address',
                'contact' => '09472756306',
                'email' => 'aldeleon@cca.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'verification_token' => null,
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
        );
 
        User::insert($users);

        User::all()->each(function($user) use($service)
        {
            
            $user
            ->addMedia(public_path("/img/tmp_files/avatars/$user->id.png"))
            ->preservingOriginal()
            ->toMediaCollection('avatar_image');

            $service->log_activity(model:new User(), event:'added', model_name: 'User', model_property_name: $user->name);

        });
    }
}