<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function createPermissions(array $permissionsArray): array{
        self::query()->delete();
        foreach($permissionsArray as $permission) {
            $newPermission = new self;
            $newPermission->name = $permission;
            $newPermission->save();
        }

        return $permissionsArray;
    }
}
