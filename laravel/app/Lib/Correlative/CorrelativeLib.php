<?php

namespace App\Lib\Correlative;

use App\Models\Tools\Sequence;

/**
 * Class HasCorrelative
 */
class CorrelativeLib
{
    /**
     * Metodo para generar el Numero de Correlativo
     *
     * @param Departament, paysheet $model
     */
    public static function make($model)
    {
        $sequence = Sequence::{$model::SCOPE_CORRELATIVE}()->first();

        $number = str_pad($sequence->value + 1, 4, '0', STR_PAD_LEFT);

        $model->correlative_number = $model::PREFIX_CORRELATIVE.'-'.$number;
        $sequence->update([
            'value' => $sequence->value + 1
        ]);
    }
}
