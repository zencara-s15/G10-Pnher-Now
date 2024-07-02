<?php

namespace App\Http\Controllers\API\Chart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function chart(){
            $labels = ['New Register', 'Company', 'All product', 'Order'];
            $data = [12, 12, 12, 12];
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
