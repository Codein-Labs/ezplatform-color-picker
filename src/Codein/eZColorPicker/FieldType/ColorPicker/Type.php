<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;

use Codein\eZColorPicker\Form\Type\ColorPickerType;
use eZ\Publish\SPI\FieldType\Generic\Type as GenericType;
use EzSystems\EzPlatformContentForms\Data\Content\FieldData;
use EzSystems\EzPlatformContentForms\FieldType\FieldValueFormMapperInterface;
use Symfony\Component\Form\FormInterface;

final class Type extends GenericType implements FieldValueFormMapperInterface
{
    public function getFieldTypeIdentifier(): string
    {
        return 'codeincolor';
    }

    public function mapFieldValueForm(FormInterface $fieldForm, FieldData $data)
    {
        $definition = $data->fieldDefinition;

        $fieldForm->add('value', ColorPickerType::class, [
            'required' => $definition->isRequired,
            'label' => $definition->getName()
        ]);
    }
}