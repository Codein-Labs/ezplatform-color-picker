<?php


use Codein\ColorConverter\ColorConverter;
use Codein\eZColorPicker\FieldType\ColorPicker\Type as ColorPickerType;
use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;
use Codein\Tests\ColorConverter\ColorPickerDataFixtures;
use PHPUnit\Framework\TestCase;
use eZ\Publish\SPI\FieldType\ValueSerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TypeTest extends TestCase
{
    /**
     * @var ColorPickerType
     */
    protected $instance;

    /**
     * @var ColorPickerValue
     */
    protected $emptyValue;

    /**
     * @var ColorPickerValue
     */
    protected $filledValue;

    /**
     * @var ColorPickerValue
     */
    protected $filledValueNoAlpha;

    public function setUp(): void
    {
        if(class_exists('eZ\\Publish\\SPI\\FieldType\\Generic\\Type')) {
            /** Version 3.1 */
            $serializerMock = $this->getMockBuilder(ValueSerializerInterface::class)->getMock();
            $validatorMock = $this->getMockBuilder(ValidatorInterface::class)->getMock();
            $this->instance = new ColorPickerType($serializerMock, $validatorMock);
        } else {
            /** Version 2.5 */
            $this->instance = new ColorPickerType();
        }

        $this->instance->setColorConverter(new ColorConverter());
        $this->emptyValue = new ColorPickerValue();
        $this->filledValue = (new ColorPickerValue())->setValueFromHash(ColorPickerDataFixtures::ARRAY_VALUE);
        $this->filledValueNoAlpha = (new ColorPickerValue())->setValueFromHash(ColorPickerDataFixtures::ARRAY_VALUE_NO_ALPHA);
    }

    public function testEmptyValue()
    {
        $this->assertTrue($this->instance->isEmptyValue($this->emptyValue));
        $this->assertFalse($this->instance->isEmptyValue($this->filledValue));
    }

    public function testAcceptValueNull()
    {
        $this->assertEquals($this->emptyValue, $this->instance->acceptValue(null));
    }

    public function testAcceptValueArray()
    {
        $this->assertEquals($this->filledValue, $this->instance->acceptValue(ColorPickerDataFixtures::ARRAY_VALUE));
    }

    public function testAcceptValueString()
    {
        foreach ([ColorPickerDataFixtures::VALUE_HSVa, ColorPickerDataFixtures::VALUE_HEXa, ColorPickerDataFixtures::VALUE_RGBa] as $value) {
            $this->assertEquals($this->filledValue, $this->instance->acceptValue($value), 'Input value is '.$value);
        }

        foreach ([ColorPickerDataFixtures::VALUE_HEX, ColorPickerDataFixtures::VALUE_RGB] as $value) {
            $this->assertEquals($this->filledValueNoAlpha, $this->instance->acceptValue($value), 'Input value is '.$value);
        }
    }
}