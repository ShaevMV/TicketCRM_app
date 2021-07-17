<?php

declare(strict_types=1);

namespace App\Ticket\Entity;

use Carbon\Carbon;
use JsonException;
use Webpatser\Uuid\Uuid;

/**
 * Class AbstractionEntity
 *
 * Абстрактный класс для реализации toArray
 *
 * @package App\Ticket\Entity
 */
abstract class AbstractionEntity implements EntityInterface
{
    /** @var string Строковый тип данных в колонке */
    public const TYPE_STRING = 'string';

    /** @var string Числовой тип */
    public const TYPE_INT = 'int';
    /** @var string Логический тип */
    public const TYPE_BOOL = 'bool';

    /** @var string Тип по порядку */
    public const TYPE_IN_SERIES = 'inSeries';

    /** @var string Тип дата */
    public const TYPE_DATE = 'date';

    /**
     * Вывести сущность в виде массива
     *
     * @return array
     */
    public function toArray(): array
    {
        $vars = get_object_vars($this);

        $array = [];
        foreach ($vars as $key => $value) {
            if ($value instanceof EntityInterface) {
                $array += $value->toArray() ?? [];
            } elseif ($value instanceof EntityDataInterface || $value instanceof Uuid || $value instanceof Carbon) {
                //TODO: Вынести в отдельный класс, перебросить зависимость на детей
                $array[ltrim($key)] = (string)$value;
            } else {
                $array[ltrim($key)] = $value;
            }
        }

        return $array;
    }

    /**
     * {@inheritdoc}
     * @throws JsonException
     */
    public function toJson(): string
    {
        $vars = get_object_vars($this);

        $array = [];
        foreach ($vars as $key => $value) {
            if ($value instanceof EntityDataInterface || $value instanceof EntityInterface) {
                $array[$key] = $value->toJson();
            } elseif ($value instanceof Uuid || $value instanceof Carbon) {
                $array[$key] = (string)$value;
            } else {
                $array[$key] = $value;
            }
        }

        return json_encode($array, JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function __get(string $name)
    {
        $methodName = "get{$name}";

        return method_exists($this, $methodName) ? $this->$methodName() : null;
    }
}
