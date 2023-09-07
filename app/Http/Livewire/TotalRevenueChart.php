<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TotalRevenueChart extends Component
{
    public function render()
    {
        return view('livewire.total-revenue-chart', ['data' => $this->getData()]);
    }

    protected function getData(): array
    {
        $data = Order::query()
            ->select('order_date', DB::raw('sum(total) as total'))
            ->where('order_date', '>=', now()->subDays(7))
            ->groupBy('order_date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => __('Total revenue from last :days days', ['days' => 7]),
                    'data' => $data->map(fn (Order $order) => $order->total),
                ],
            ],
            'labels' => $data->map(fn (Order $order) => $order->order_date->format('d/m/Y')),
        ];
    }
}
