<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;


class BangThongKeService 
{
    // Dùng static để gọi thẳng hàm mà không cần khởi tạo (new)
    public static function getMonthlyRevenue()
    {
        $monthlyRevenue = [];
        $maxRevenue = 0; 

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            
            $revenue = Order::query()
                            ->whereIn('status', ['shipped', 'completed'])
                            ->whereYear('created_at', $month->year)
                            ->whereMonth('created_at', $month->month)
                            ->sum('total_amount');

            $monthlyRevenue[] = [
                'month_name' => $month->format('m/Y'),
                'revenue'    => $revenue,
            ];

            if ($revenue > $maxRevenue) {
                $maxRevenue = $revenue;
            }
        }

        foreach ($monthlyRevenue as &$item) {
            $item['percentage'] = $maxRevenue > 0 ? round(($item['revenue'] / $maxRevenue) * 100) : 0;
        }

        return $monthlyRevenue;
    }
}