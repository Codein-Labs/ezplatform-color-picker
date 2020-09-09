<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;

use Codein\eZColorPicker\Form\Type\ColorPickerSettingsType;
use Codein\eZColorPicker\Form\Type\ColorPickerType;
use eZ\Publish\SPI\FieldType\Generic\Type as GenericType;
use EzSystems\EzPlatformAdminUi\FieldType\FieldDefinitionFormMapperInterface;
use EzSystems\EzPlatformAdminUi\Form\Data\FieldDefinitionData;
use EzSystems\EzPlatformContentForms\Data\Content\FieldData;
use EzSystems\EzPlatformContentForms\FieldType\FieldValueFormMapperInterface;
use Symfony\Component\Form\FormInterface;

final class Type extends GenericType implements FieldValueFormMapperInterface, FieldDefinitionFormMapperInterface
{
    public function getFieldTypeIdentifier(): string
    {
        return 'codeincolor';
    }

    public function getSettingsSchema(): array
    {
        return [
            'defaultValue' => [
                'type' => Value::class,
                'default' => new Value(),
            ],
        ];
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