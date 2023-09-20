<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'correlative_number',
        'name'
    ];

    public function info()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeName($query, $name = null)
    {
        if ($name) {
            return $query->where('name', 'like', "%{$name}%")
                ->orWhere('correlative_number', 'like', "%{$name}%");
        }
        return $query;
    }
}
