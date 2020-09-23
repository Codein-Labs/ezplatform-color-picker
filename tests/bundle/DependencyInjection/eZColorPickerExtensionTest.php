<?php


namespace Codein\Tests\eZColorPicker\DependencyInjection;

use Codein\eZColorPicker\DependencyInjection\eZColorPickerExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;


class eZColorPickerExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @var eZColorPickerExtension
     */
    private $extension;

    protected function setUp(): void
    {
        $this->extension = new eZColorPickerExtension();

        parent::setUp();
    }

    protected function getContainerExtensions(): array
    {
        return [$this->extension];
    }

    public function testPrependEzpublish()
    {
        $this->load([]);

        $actualPrependedConfig = $this->container->getExtensionConfig('ezpublish');
        // merge multiple configs returned
        $actualPrependedConfig = array_merge(...$actualPrependedConfig);

        $expectedPrependedConfig = [
            'field_templates' => [
                [
                    'template' => '@ezdesign/ColorPicker/content_fields.html.twig',
                    'priority' => 1,
                ],
            ]
        ];

        self::assertSame(
            $expectedPrependedConfig,
            $actualPrependedConfig['system']['default']
        );
    }

    public function testPrependTwig()
    {
        $this->load([]);

        $actualPrependedConfig = $this->container->getExtensionConfig('twig');
        // merge multiple configs returned
        $actualPrependedConfig = array_merge(...$actualPrependedConfig);

        $expectedPrependedConfig = [
            'form_themes' => [
                "@ezdesign/ColorPicker/field_template.html.twig"
            ]
        ];

        self::assertSame(
            $expectedPrependedConfig,
            $actualPrependedConfig
        );
    }
}