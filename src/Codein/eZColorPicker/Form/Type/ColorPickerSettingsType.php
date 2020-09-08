<?php
declare(strict_types=1);

namespace Codein\eZColorPicker\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ColorPickerSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('default', TextType::class, [
            'required' => false
        ]);
    }
}