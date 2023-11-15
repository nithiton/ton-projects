<?php

namespace Database\Seeders;

use App\Models\Scope;
use Illuminate\Database\Seeder;

class create_default_scopes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (Scope::all()->count() == 0) {
            $scopes = [
                ['id' => 'READ_USER', 'description' => 'collect users data'],
                ['id' => 'CREATE_USER', 'description' => 'create new user'],
                ['id' => 'UPDATE_USER', 'description' => 'update user data'],
                ['id' => 'DELETE_USER', 'description' => 'delete user'],
            ];
            foreach ($scopes as $scope) {
                Scope::create($scope);
            }
        }
    }
}
