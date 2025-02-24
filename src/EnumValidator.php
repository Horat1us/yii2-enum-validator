<?php

declare(strict_types=1);

namespace Horat1us\Yii;

use yii\validators\RangeValidator;

class EnumValidator extends RangeValidator
{
    public string $enumClass;

    public function init(): void
    {
        if (!isset($this->enumClass)) {
            throw new \InvalidArgumentException('EnumClass must be set');
        }

        if (!enum_exists($this->enumClass)) {
            throw new \InvalidArgumentException("{$this->enumClass} is not a valid enum class");
        }

        $this->range = $this->getEnumValues($this->enumClass);

        parent::init();
    }

    protected function getEnumValues(string $enumClass): array
    {
        return array_column($enumClass::cases(), 'value');
    }
}
