<?php

namespace App\Observers\Admin;

class OrderObserver
{
    public function creating($model)
    {
        $model->trackingNo = (rand(10, 90) . '-' . rand(100, 900) . '-' . rand(1000, 9000));
    }

    public function saving($model)
    {
        if (!$model->trackNo) {
            $model->trackingNo = (rand(10, 90) . '-' . rand(100, 900) . '-' . rand(1000, 9000));
        }
        if ($model->getTable() == 'order_items') {
        }
    }
}
