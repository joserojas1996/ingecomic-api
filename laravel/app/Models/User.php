<?php

namespace App\Models;

use App\Lib\Correlative\CorrelativeLib;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const PREFIX_CORRELATIVE = 'USER';
    const SCOPE_CORRELATIVE = 'user';

    const TEACHER       = 'teacher';
    const STUDENT       = 'student';
    const PUBLIC        = 'public';
    const ADMIN   = 'super-admin';

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'correlative_number',
        'name',
        'username',
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

    protected static function booted()
    {
        // PARA CREAR EL CORRELATIVO
        static::creating(function ($model) {
            CorrelativeLib::make($model);
        });
    }

    public function scopeName($query, $name = null)
    {
        if ($name) {
            return $query->where('name', 'like', "%{$name}%")
                ->orWhere('username', 'like', "%{$name}%")
                ->orWhere('email', 'like', "%{$name}%");
        }
        return $query;
    }

    public function info()
    {
        return $this->hasOne(Info::class);
    }
}
