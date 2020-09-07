<?php
declare(strict_types=1);

namespace Codein\eZColorPicker\Form\Type;

use Codein\eZColorPicker\FieldType\ColorPicker\Value;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ColorPickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('HEX', TextType::class, [
            'label' => 'codeincolor.hexadecimal_color'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Value::class
        ]);
    }
}