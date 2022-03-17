<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductSearchService
{
    private string $title = '';
    private function queryBuilder(array $searchData)
    {
        $products = Product::query();
        foreach ($searchData as $key => $value){

            if (in_array($key,['vs', 'dft', 'min_temp', 'tolerance'])){
                $products = $products->where($key,'>=',$value);
            } elseif (in_array($key,['brand_id', 'catalog_id'])) {
                $products = $products->whereIn($key, $value);
            } elseif ($key == 'title') {
                $products = $products->where($key,'like', "%$value%");
            }
            elseif (in_array($key, array_keys(Product::getLinkedFields()))) {
                $products = $products->whereHas($key, function (Builder $query) use($value, $key) {
                    $query->whereIn( substr($key, 0, -1) .'_id', $value);
                });
            }
            else{
                $products = $products->where($key,'<=',$value);
            }
        }

        return $products;

    }

    private function getSelectionData(): array
    {
        $selectionData= [];
        foreach (Product::getFieldsToMath() as $fieldName){
            $selectionData[$fieldName] = app(ExtractValuesService::class)
                ->getValues('products', $fieldName);
        }
        return $selectionData;
    }

    public function getProducts(array $request): object
    {
        $searchData = $this->getSearchData($request);

        return $this->queryBuilder($searchData);

    }

    public function getSearchData(array $request): array
    {
        $selectionData = $this->getSelectionData();
        //проверяю, если меньше меньшего или null, то удаляю из поиска
        $searchData = [];
        foreach ($request as $key => $value){

            if ((key_exists($key, $selectionData) && $value >= $selectionData[$key]['min'] or ($key === 'title' && !is_null($value)))){
                $searchData[$key] = $value;
            }  elseif (is_array($value) ){
                $searchData[$key] = $value;
            } elseif ($key === 'tolerance'){
                $searchData[$key] = 1;
            }
        }

        return $searchData;
    }

    public function getSearchDescription(array $request): string
    {
        $data = array_merge(Product::getFieldsToSearch(), Product::getLinkedFields());

        foreach ($request as $key => $item){
            $this->title = $this->title . $data[$key] . ': ';
            if (is_array($item)){
                /* составляю строку для поля title в search, если не массив сразу подставляется значение,
                если массив перебирается функцией array_map , поскольку brand_id и catalog_id находятся
                в одной таблице с products, пришлось поставить костыль для них
                */
                $this->title = $this->title . implode(', ',
                        array_map(function ($value) use ($key)
                        {
                            $tableParam = [
                                'brand_id' => 'brands',
                                'catalog_id' => 'catalogs'
                            ];
                            if (array_key_exists($key,$tableParam)) {
                                $key = $tableParam[$key];
                            }
                            return DB::table($key)->where('id', $value)->value('title');}, $item)) . '; ';

            } else $this->title = $this->title . $item . '; ';
        }

        return $this->title;
    }

}