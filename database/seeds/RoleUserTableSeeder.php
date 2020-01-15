<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$roles = Role::all();
        $users = User::all();
        $roles->each(function (App\Models\Role $role) use ($users) {
            $role->users()->attach(
                User::select('id')->inRandomOrder()->first()
            );
        });*/
        $roles = Role::all();
        $users = User::all();

        $users->each(function (App\Models\User $user) use ($roles) {
            $user->roles()->attach(
                Role::select('id')->inRandomOrder()->first()
            );
        });
    }
}
