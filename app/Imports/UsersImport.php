<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'name' => $row[0],
            'email' => $row[1],
            'password' => Hash::make($row[2]),
        ]);

        $role = Role::where('name', $row[3])->first();

        if ($role) {
            $user->assignRole($role);
        } else {
            $user->assignRole(Role::where('name', 'reader')->first());
        }
        
        return $user;
    }
}
