<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;

use Codein\ColorConverter\ColorConverter;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinition;
use eZ\Publish\Core\FieldType\FieldType;
use eZ\Publish\SPI\FieldType\Nameable;
use eZ\Publish\SPI\FieldType\Value;
use eZ\Publish\Core\FieldType\Value as BaseValue;
use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;

class Type extends FieldType implements Nameable
{
    /**
     * @var ColorConverter
     */
    protected $colorConverter;

    public function setColorConverter(ColorConverter $colorConverter)
    {
        $this->colorConverter = $colorConverter;
    }

    public function getFieldTypeIdentifier(): string
    {
        return 'codeincolor';
    }

    public function getSettingsSchema(): array
    {
        return [
            'defaultValue' => [
                'type' => ColorPickerValue::class,
                'default' => new ColorPickerValue(),
            ],
        ];
    }

    public function validateFieldSettings($fieldSettings)
    {
        return [];
    }

    protected function createValueFromInput($inputValue)
    {
        if($inputValue instanceof ColorPickerValue) {
            return $inputValue;
        } elseif (is_array($inputValue)) {
            return (new ColorPickerValue())->setValueFromHash($inputValue);
        }

        $value = new ColorPickerValue();
        if(is_string($inputValue) && $this->colorConverter->stringIsColor($inputValue)) {
            $HSVa = $this->colorConverter->convertStringToHSVa($inputValue);
            $value->HSVa = (string)$HSVa;
            $value->RGBa = (string)$this->colorConverter->convertHSVaToRGBa($HSVa);
            $value->HEXa = (string)$this->colorConverter->convertHSVaToHEXa($HSVa);
            $value->RGB  = (string)$this->colorConverter->convertHSVaToRGB($HSVa);
            $value->HEX  = (string)$this->colorConverter->convertHSVaToHEX($HSVa);
        }
        return $value;
    }

    protected function checkValueStructure(BaseValue $value)
    {
    }

    public function getName(Value $value)
    {
        return (string)$value;
    }

    public function getEmptyValue()
    {
        return new ColorPickerValue();
    }

    public function fromHash($hash)
    {
        $value = new ColorPickerValue();
        if(is_array($hash)) {
            $value->setValueFromHash($hash);
        }
        return $value;
    }

    public function toHash(Value $value)
    {
        if($value instanceof ColorPickerValue) {
            return $value->getValueAsHash();
        }
        return [];
    }

    public function getFieldName(Value $value, FieldDefinition $fieldDefinition, $languageCode)
    {
        return (string)$value;
    }

    protected function getSortInfo(BaseValue $value)
    {
        return (string)$value;
    }
}