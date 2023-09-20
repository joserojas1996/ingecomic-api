<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'infos';

    protected $casts = [
        'user_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'identity',
        'firstname',
        'lastname',
        'section_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section()
    {
        return $this->hasOne(Section::class);
    }

    public function scopeName($query, $name = null)
    {
        if ($name) {
            return $query->where('firstname', 'like', "%{$name}%")
                ->orWhere('lastname', 'like', "%{$name}%")
                ->orWhere('identity', 'like', "%{$name}%");

        }
        return $query;
    }



}
