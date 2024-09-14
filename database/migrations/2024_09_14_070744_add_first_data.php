<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $user = User::create([
            'name' => 'Daniel',
            'email' => 'admin2@admin2.com', 
            'password' => Hash::make('password'), 
        ]);

        $user->assignRole($superAdminRole);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email', 'admin2@admin2.com')->first();
        if ($user) {
            $user->delete();
        }
        Role::where('name', 'super_admin')->delete();
        Role::where('name', 'user')->delete();
    }
};