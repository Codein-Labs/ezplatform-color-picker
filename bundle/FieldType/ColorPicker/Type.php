<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;

use Codein\ColorConverter\ColorConverter;
use Codein\eZColorPicker\Form\Type\ColorPickerSettingsType;
use Codein\eZColorPicker\Form\Type\ColorPickerType;
use eZ\Publish\SPI\FieldType\Generic\Type as GenericType;
use EzSystems\EzPlatformAdminUi\FieldType\FieldDefinitionFormMapperInterface;
use EzSystems\EzPlatformAdminUi\Form\Data\FieldDefinitionData;
use EzSystems\EzPlatformContentForms\Data\Content\FieldData;
use EzSystems\EzPlatformContentForms\FieldType\FieldValueFormMapperInterface;
use Symfony\Component\Form\FormInterface;
use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;

final class Type extends GenericType implements FieldValueFormMapperInterface, FieldDefinitionFormMapperInterface
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

    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $definition = $data->fieldDefinition;
        $fieldForm->add('value', ColorPickerType::class, [
            'required' => $definition->isRequired,
            'label' => $definition->getName(),
            'defaultValue' => $definition->fieldSettings['defaultValue'],
        ]);
    }

    public function mapFieldDefinitionForm(FormInterface $fieldDefinitionForm, FieldDefinitionData $data): void
    {
        $fieldDefinitionForm->add('fieldSettings', ColorPickerSettingsType::class, [
            'label' => false,
        ]);
    }
}