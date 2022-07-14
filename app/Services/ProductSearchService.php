<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Search;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSearchService
{
    private string $title = '';

    public function getProducts(array $searchData)
    {
        $products = Product::with(Product::relations());
        foreach ($searchData as $key => $value){

            if (in_array($key,['vs', 'dft', 'min_temp', 'tolerance'])){
                $products = $products->where($key,'>=',$value);
            } elseif (in_array($key,['brand_id', 'catalog_id'])) {
                $products = $products->whereIn($key, $value);
            }
            elseif ($key === 'order-by') {
               continue;
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
        if (isset($searchData['order-by'])){

            $orderParam = explode('@', $searchData['order-by']);
            $products = $products->orderBy($orderParam[0], $orderParam[1]);
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

    public function getSearchData(array $request): array
    {
        $selectionData = $this->getSelectionData();

        //проверяю, если меньше меньшего или null, то удаляю из поиска
        $searchData = [];
        foreach ($request as $key => $value){
            if ((key_exists($key, $selectionData) && $value >= $selectionData[$key]['min'] or (in_array($key, ['title', 'order-by', 'search_title']) && !is_null($value)))){
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
        $data['order-by'] = 'Сортировка';
        //todo убрать костыль

        foreach ($request as $key => $item){
            if (key_exists($key,$data)){
                $this->title = $this->title . $data[$key] . ': ';
                if (is_array($item)){
                    /* составляю строку для поля title в search, если не массив сразу подставляется значение,
                    если массив перебирается функцией array_map, поскольку brand_id и catalog_id находятся
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

                } elseif ($key === 'tolerance'){
                    $this->title = $this->title . 'да; ';
                }
//            elseif ($key === 'order-by'){
//                $this->title = $this->title . 'выполнена; ';
//            }
                else $this->title = $this->title . $item . '; ';

            }

        }
        return $this->title;
    }
    public function quickSearch(string $content)
    {
        $data = DB::table('products')->where('title','like', "%$content%")
            ->get(['id', 'title'])->toArray();
        if(!count($data)){
            $content = str_replace(['k', 'K'],'c', Str::transliterate($content));
            $data = DB::table('products')->where('title','like', "%$content%")
                ->get(['id', 'title'])->toArray();
        };
        return $data;
    }
    public function getAllSearches(User $user)
    {
        return Search::query()
            ->where('user_id', $user->id)
            ->where('is_deleted', '=', 0)
            ->orderByDesc('updated_at');

    }

}
