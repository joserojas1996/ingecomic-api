<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ExistsEncrypt implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $column = null)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty($value)) {
            $value = decrypt($value);
            $ifExist = DB::table($this->table)
                ->where($this->column ?? $attribute, $value)
                ->exists();

            if (!$ifExist) {
                return false;
            }
        }
        return True;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return \trans('validation.exists');
    }
}
