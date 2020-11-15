<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'id_pemilih' => $row[0],
            'name' => $row[1],
            'password' => Hash::make($row[2]),
            'alamat' => $row[3],
            'role' => 1
        ]);
    }
}
