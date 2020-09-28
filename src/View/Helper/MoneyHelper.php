<?php

namespace App\View\Helper;

use Cake\View\Helper;

class MoneyHelper extends Helper
{
    public function format(float $number): string
    {
        return "R$ " . number_format($number, 2, ',', '.');
    }
}
