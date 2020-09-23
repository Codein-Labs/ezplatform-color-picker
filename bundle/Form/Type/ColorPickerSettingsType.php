<?php
declare(strict_types=1);

namespace Codein\eZColorPicker\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class ColorPickerSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('defaultValue', ColorPickerType::class, [
            'required' => false,
            'useViewTransformer' => true,
            'label' => 'codeincolor.default.color',
        ]);
    }
}