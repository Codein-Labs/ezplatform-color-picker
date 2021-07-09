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
            'admin_group' => [
                'field_templates' => [
                    [
                        'template' => '@eZColorPicker/admin/content_fields.html.twig',
                        'priority' => 1,
                    ]
                ]
            ],
            'default' => [
                'field_templates' => [
                    [
                        'template' => '@eZColorPicker/standard/content_fields.html.twig',
                        'priority' => 1,
                    ],
                ]
            ],
        ];

        self::assertSame(
            $expectedPrependedConfig,
            $actualPrependedConfig['system']
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
                "@eZColorPicker/admin/field_template.html.twig"
            ]
        ];

        self::assertSame(
            $expectedPrependedConfig,
            $actualPrependedConfig
        );
    }
}
