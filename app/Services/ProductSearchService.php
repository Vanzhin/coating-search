<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductSearchService
{
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
        $selectionData = $this->getSelectionData();
        //проверяю если меньше меньшего или null, то удаляю из поиска
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

        return $this->queryBuilder($searchData);

    }
}
