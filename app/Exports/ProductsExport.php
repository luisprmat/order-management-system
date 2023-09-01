<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function __construct(private array $productIDs)
    {
    }

    public function headings(): array
    {
        return [
            __('Name'),
            __('Categories'),
            __('Country'),
            __('Price'),
        ];
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->categories->pluck('name')->implode(', '),
            $product->country->name,
            '$'.number_format($product->price, 0),
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::with('categories', 'country')->find($this->productIDs);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
