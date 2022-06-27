<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles(){
        return $this->morphMany(Article::class,'owner');
    }

    /**
     * The roles that belong to the Admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isSuperAdmin(): bool {
        return (bool) $this->is_super_admin;
    }

    public function createSuperAdmin(array $details): self {
        $user = new self($details);

        if(!$this->superAdminExists()){
            $user->is_super_admin = 1;
            $user->password = Hash::make($user->password);
            $user->save();
        } else {
            $user->email = "false";
        }
        return $user;
    }

    public function superAdminExists(): int {
        return self::where('is_super_admin', 1)->count();
    }
}
