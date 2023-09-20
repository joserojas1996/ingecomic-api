<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    use HasFactory;

    const TYPES_SEQUENCES = [
        'user' => 1
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'int',
    ];

    public function scopeUser($query)
    {
        return $query->where(
            'type',
            $this::TYPES_SEQUENCES['user']
        );
    }

    #Methods
    public static function rebootSequence($sequence = null)
    {
        if (empty($sequence)) {
            self::where('value', '!=', 0)->update([
                'value' => 0
            ]);
        } else {
            self::where('type', $sequence)->update([
                'value' => 0
            ]);
        }
    }
}
