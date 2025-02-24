# Yii2 Enum Validator

[![Latest Stable Version](https://poser.pugx.org/horat1us/yii2-enum-validator/v/stable)](https://packagist.org/packages/horat1us/yii2-enum-validator)
[![Total Downloads](https://poser.pugx.org/horat1us/yii2-enum-validator/downloads)](https://packagist.org/packages/horat1us/yii2-enum-validator)
[![License](https://poser.pugx.org/horat1us/yii2-enum-validator/license)](https://packagist.org/packages/horat1us/yii2-enum-validator)

Simple validator for PHP 8.1+ Enums in Yii2 Framework based on RangeValidator.

## Installation

```bash
composer require horat1us/yii2-enum-validator
```

## Usage

### Define your Enum

```php
enum Status: string
{
    case ACTIVE = "active";
    case INACTIVE = "inactive";
    case PENDING = "pending";
}
```

### Use in Model/ActiveRecord rules
```php
use Horat1us\Yii\EnumValidator;
use yii\base;

class YourModel extends base\Model
{
    public ?string $status = null;

    public function rules(): array
    {
        return [
            ["status", "required",],
            ["status", EnumValidator::class, "enumClass" => Enum::class, "strict" => true,],
        ];
    }
}

```
The validator will ensure that the attribute value matches one of the enum values.

## Features

- Works with both string and int backed enums
- No additional methods required in enum classes
- Based on Yii2 RangeValidator
- Simple integration
- Fully tested

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.
