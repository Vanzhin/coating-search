<?php

namespace App\Models;

use App\Services\ExtractValuesService;
use App\Traits\TModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasOne};

class Product extends Model
{
    use HasFactory, Sluggable, TModel;

    protected  $table = 'products';
    protected $fillable = [
        'title',
        'description',
        'brand_id',
        'catalog_id',
        'vs',
        'dft',
        'dry_to_touch',
        'dry_to_handle',
        'min_int',
        'max_int',
        'tolerance',
        'min_temp',
        'max_service_temp',
        'pds',
    ];
    protected $casts = [
        'tolerance' => 'boolean',
    ];


    public array $propertyToShow = [
    'vs' => 'Сухой остаток,&nbsp;об %',
    'dft' => 'Стандартная ТСП,&nbsp;мкм',
    'dry_to_touch' => 'Сухой на отлип,&nbsp;ч',
    'dry_to_handle' => 'Сухой до перемещения,&nbsp;ч',
    'min_int' => 'Минимальный интервал перекрытия,&nbsp;ч',
    'max_int' => 'Максимальный интервал перекрытия,&nbsp;д',
    'tolerance' => 'Толерантный к подготовке поверхности',
    'min_temp' => 'Минимальная т-ра отверждения,' . "&nbsp;&deg;C",
    'max_service_temp' => 'Максимальная  т-ра эксплуатации,' . "&nbsp;&deg;C",
];

public static function getFieldsToShow(): array
{
    return [
        'title' => 'Название',
        'vs' => 'Сухой остаток,&nbsp;об %',
        'dft' => 'Стандартная ТСП,&nbsp;мкм',
        'dry_to_touch' => 'Сухой на отлип,&nbsp;ч',
        'dry_to_handle' => 'Сухой до перемещения,&nbsp;ч',
        'min_int' => 'Минимальный интервал перекрытия,&nbsp;ч',
        'max_int' => 'Максимальный интервал перекрытия,&nbsp;д',
        'tolerance' => 'Толерантный к подготовке поверхности',
        'min_temp' => 'Минимальная т-ра отверждения,' . "&nbsp;&deg;C",
        'max_service_temp' => 'Максимальная  т-ра эксплуатации,' . "&nbsp;&deg;C",
    ];
}

public static function getFieldsToCreate(): array
    {
        return [
            'title' => 'Название',
            'description' => 'Описание',
            'brand_id' => 'Производитель',
            'catalog_id' => 'Сегмент',
            'vs' => 'Сухой остаток,&nbsp;об %',
            'dft' => 'Стандартная ТСП,&nbsp;мкм',
            'dry_to_touch' => 'Сухой на отлип,&nbsp;ч',
            'dry_to_handle' => 'Сухой до перемещения,&nbsp;ч',
            'min_int' => 'Минимальный интервал перекрытия,&nbsp;ч',
            'max_int' => 'Максимальный интервал перекрытия,&nbsp;д',
            'tolerance' => 'Толерантный к подготовке поверхности?',
            'min_temp' => 'Минимальная т-ра отверждения,' . "&nbsp;&deg;C",
            'max_service_temp' => 'Максимальная  т-ра эксплуатации,' . "&nbsp;&deg;C",
            'pds' => 'Техническое описание',
        ];
    }
public static function getFieldsToSearch(): array
    {
        return [
            'vs' => 'Сухой остаток, не менее&nbsp;об %',
            'dft' => 'Стандартная ТСП, от&nbsp;мкм',
            'dry_to_touch' => 'Сухой на отлип, не более&nbsp;ч',
            'brand_id' => 'Производитель',
            'catalog_id' => 'Сегмент',
            'dry_to_handle' => 'Сухой до перемещения, не более&nbsp;ч',
            'min_int' => 'Минимальный интервал перекрытия, не более&nbsp;ч',
            'max_int' => 'Максимальный интервал перекрытия, не более&nbsp;д',
            'tolerance' => 'Толерантный к подготовке поверхности?',
            'min_temp' => 'Минимальная т-ра отверждения, ' . "от&nbsp;&deg;C",
            'max_service_temp' => 'Максимальная  т-ра эксплуатации,' . "до&nbsp;&deg;C",
            'title' => 'Название содержит',

        ];
    }
    public static function getFieldsToOrderBy(): array
    {
        return [
            'vs' => 'Сухой остаток',
            'dft' => 'Стандартная ТСП',
            'dry_to_touch' => 'Сухой на отлип',
            'brand_id' => 'Производитель',
            'catalog_id' => 'Сегмент',
            'dry_to_handle' => 'Сухой до перемещения',
            'min_int' => 'Минимальный интервал перекрытия',
            'max_int' => 'Максимальный интервал перекрытия',
            'min_temp' => 'Минимальная т-ра отверждения',
            'max_service_temp' => 'Максимальная  т-ра эксплуатации',

        ];
    }
public static function getFieldsToMath(): array
    {
        return [
            'vs',
            'dft',
            'dry_to_touch',
            'dry_to_handle',
            'min_int',
            'max_int',
            'min_temp',
            'max_service_temp',
        ];
    }

public static function getLinkedFields(): array
    {
        return [
            'binders' => 'Основа',
            'environments' => 'Среда эксплуатации',
            'numbers' => 'Очередность в системе АКЗ',
            'resistances' => 'Стойкость к',
            'substrates' => 'Подложка',
            'additives' => 'Добавка'
        ];
    }

public static function getSelectionData()
{
    $selectionData = [];
    foreach (Product::getFieldsToMath() as $fieldName) {
        $selectionData[$fieldName] = app(ExtractValuesService::class)
            ->getValues('products', $fieldName);

    }
    return $selectionData;
}

public function binders(): BelongsToMany
    {
        return $this->belongsToMany(Binder::class, 'product_binders',
            'product_id', 'binder_id',
            'id', 'id'
        );
    }
    public function environments(): BelongsToMany
    {
        return $this->belongsToMany(Environment::class, 'product_environments',
            'product_id', 'environment_id',
            'id', 'id'
        );
    }

    public function substrates(): BelongsToMany
    {
        return $this->belongsToMany(Substrate::class, 'product_substrates',
            'product_id', 'substrate_id',
            'id', 'id'
        );
    }

    public function additives(): BelongsToMany
    {
        return $this->belongsToMany(Additive::class, 'product_additives',
            'product_id', 'additive_id',
            'id', 'id'
        );
    }
    public function resistances(): BelongsToMany
    {
        return $this->belongsToMany(Resistance::class, 'product_resistances',
            'product_id', 'resistance_id',
            'id', 'id'
        );
    }
    public function numbers(): BelongsToMany
    {
        return $this->belongsToMany(Number::class, 'product_numbers',
            'product_id', 'number_id',
            'id', 'id'
        );
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function catalog(): HasOne
    {
        return $this->hasOne(Catalog::class, 'id', 'catalog_id');
    }

    public function analogs()
    {
        $factorVs = 15;
        $factorDft = 0.5;
        $factorTouch = 1.5;
        $factorHandle = 3;

// прохожусь по основным параметрам
        $analogs = Product::whereBetween('vs', [$this->vs - $factorVs, $this->vs + $factorVs])
            ->whereBetween('dft', [$this->dft - $this->dft * $factorDft, $this->dft + $this->dft * $factorDft])
            ->whereBetween('dry_to_touch', [$this->dry_to_touch - $factorTouch, $this->dry_to_touch + $factorTouch])
            ->whereBetween('dry_to_handle', [$this->dry_to_handle - $factorHandle, $this->dry_to_handle + $factorHandle])
            ->where('title', '<>', $this->title)
            ->get();

        $binders = $this->binders()->get();
        $binderAnalogs = collect();
        foreach ($binders as $binder){
            $binderAnalogs->push(...$binder->products);
        }
//        dd($analogs->unique(), $binderAnalogs->unique());
//        todo полный отстой - доработать
        foreach ($binderAnalogs->unique() as $key => $analog){

            if($analogs->unique()->firstWhere('id', $analog->id)){
                continue;
            }else{
                $binderAnalogs->forget($key);
            }

        }

        return $binderAnalogs->unique();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
