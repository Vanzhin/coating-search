<?php

namespace App\Exports;

use App\Models\Product;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExports implements FromQuery, WithMapping, WithHeadings, WithProperties, WithTitle, WithColumnWidths, WithStyles
{

    use Exportable;


    private int $count = 1;

    public function __construct(array $product_ids)
    {
        $this->product_ids = $product_ids;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder
     */
    public function query(): \Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
    {
        return Product::query()->whereIn('id', $this->product_ids);
    }

    public function map($product): array
    {
        return [
            $this->count++,
            Str::upper($product->title),
            $product->description,
            Str::upper($product->brand->title),
            $product->vs,
            $product->dft,
            $product->dry_to_touch,
            $product->dry_to_handle,
            $product->min_int,
            $product->max_int,
            $product->tolerance,
            $product->min_temp,
            $product->max_service_temp,

        ];
    }

    public function headings(): array
    {
        $data = Product::getFieldsToCreate();
        unset($data['pds'], $data['catalog_id']);
        array_unshift($data, '#');
        return [
            ['Таблица сравнения материалов'],
            $data
        ];
    }

    public function properties(): array
    {
        return [
            'description'    => 'Products Compare',
        ];
    }

    public function title(): string
    {
        return 'Сравнение материалов';
    }


    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 40,
            'D' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'L' => 15,
            'M' => 15
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            2    => [
                'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_YELLOW],
            ],
            ],
        ];
    }
}
