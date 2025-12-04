
<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(){
        $admin = Role::firstOrCreate(['name'=>'admin']);
        $userRole = Role::firstOrCreate(['name'=>'user']);
        $u = User::firstOrCreate(['email'=>'admin@example.com'],['name'=>'Admin','password'=>bcrypt('password')]);
        $u->roles()->syncWithoutDetaching([$admin->id]);
    }
}
