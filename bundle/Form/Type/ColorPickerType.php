<?php
declare(strict_types=1);

namespace Codein\eZColorPicker\Form\Type;

use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ColorPickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach (['HEX', 'HEXa', 'RGB', 'RGBa', 'HSVa'] as $field) {
            $builder->add($field, TextType::class, [
                'label' => sprintf('codeincolor.pickr.color.%s', strtolower($field)),
                'translation_domain' => 'codeincolor_fieldtype',
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ]);
        }

        /**
         * If the value is empty and the field is required and has a default value
         * We need to override the current value with the default one
         */
        if(is_array($options['defaultValue']) && $options['required']) {
            $defaultValue = $options['defaultValue'];
            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($defaultValue) {
                /** @var ColorPickerValue $colorPickerValue */
                $colorPickerValue = $event->getData();
                $defaultValue = (new ColorPickerValue())->setValueFromHash($defaultValue);
                if($colorPickerValue->isEmpty() && !$defaultValue->isEmpty()) {
                    $event->setData($defaultValue);
                }
            });
        }

        /**
         * Need to use à view transformer in order to use this type to set the default value
         * with a color picker
         */
        if($options['useViewTransformer']) {
            $builder->addViewTransformer(new CallbackTransformer(
                function ($value) {
                    $colorPickerValue = new ColorPickerValue();
                    if(is_array($value)) {
                        $colorPickerValue->setValueFromHash($value);
                    }
                    return $colorPickerValue;
                },
                function ($value) {
                    if ($value instanceof ColorPickerValue) {
                        return $value->getValueAsHash();
                    }
                    $colorPickerValue = new ColorPickerValue();
                    return $colorPickerValue->getValueAsHash();
                }
            ));
        }
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_merge($view->vars, [
            'formParams' => \json_encode([
                'required' => $options['required'],
                'defaultValue' => $options['defaultValue']
            ])
        ]);
        parent::buildView($view, $form, $options);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ColorPickerValue::class,
            'useViewTransformer' => false,
            'defaultValue' => null,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'codeincolor';
    }
}