<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->id = 1;
        $user->name = 'test';
        $user->email = 'test@test.localhost';
        $user->password = bcrypt('test');

        $user->saveOrFail();

        $this->command->info("Created User ID: [$user->id], UserName: [$user->name], Password: [$user->password]");
    }
}
