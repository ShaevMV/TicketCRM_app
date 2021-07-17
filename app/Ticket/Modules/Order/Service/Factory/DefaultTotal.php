<?php

declare(strict_types=1);

namespace App\Ticket\Modules\Order\Service\Factory;

use App\Ticket\Modules\TypeRegistration\Entity\Price;

/**
 * Class DefaultTotal
 *
 * Стоимость по умл.
 *
 * @package App\Ticket\Modules\Order\Service\Factory
 */
final class DefaultTotal implements TotalInterface
{
    /**
     * Получения суммы
     *
     * @param Price $price
     * @param int $count
     *
     * @return Price
     */
    public function getTotal(Price $price, int $count): Price
    {
        return Price::fromState($price->getInt() * $count);
    }
}
