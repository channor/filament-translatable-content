<?php

namespace Channor\FilamentTranslatableContent\Drivers;

use Astrotomic\Translatable\Contracts\Translatable;
use Filament\Support\Contracts\TranslatableContentDriver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AstrotomicTranslatableContentDriver implements TranslatableContentDriver
{
    public function __construct(protected string $activeLocale) {}

    public function isAttributeTranslatable(string $model, string $attribute): bool
    {
        $modelInstance = app($model);

        if (! method_exists($modelInstance, 'isTranslationAttribute')) {
            return false;
        }

        return $modelInstance->isTranslationAttribute($attribute);
    }

    public function makeRecord(string $model, array $data): Model
    {
        $record = new $model;
        $record->fill($data);

        return $record;
    }

    public function setRecordLocale(Model|Translatable $record): Model
    {
        if (method_exists($record, 'setDefaultLocale')) {
            $record->setDefaultLocale($this->activeLocale);
        }

        return $record;
    }

    public function updateRecord(Model $record, array $data): Model
    {
        $record->fill($data);
        $record->save();

        return $record;
    }

    public function getRecordAttributesToArray(Model $record): array
    {
        return $this->mergeTranslationsIntoAttributes($record, $record->attributesToArray());
    }

    public function applySearchConstraintToQuery(
        Builder $query,
        string $column,
        string $search,
        string $whereClause,
        ?bool $isCaseInsensitivityForced = null
    ): Builder {
        $databaseConnection = $query->getConnection();

        return $query->{$whereClause}(
            generate_search_column_expression($column, $isCaseInsensitivityForced, $databaseConnection),
            'like',
            "%{$search}%",
        );
    }

    protected static function mergeTranslationsIntoAttributes(Model|Translatable $record, array $data = []): array
    {
        $translations = self::getTranslationsArrayData($record);
        foreach ($translations as $locale => $attributes) {
            $data[$locale] = $attributes;
        }

        return $data;
    }

    private static function getTranslationsArrayData(Model|Translatable $record): array
    {
        return method_exists($record, 'getTranslationsArray') ? $record->getTranslationsArray() : [];
    }
}
