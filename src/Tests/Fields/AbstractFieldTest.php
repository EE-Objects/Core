<?php

namespace EeObjects\Tests\Fields;

use EeObjects\Fields\AbstractField;
use Mithra62\UnitTests\TestCase;

class __abstractFieldStub extends AbstractField
{
    public function getRawColName(): string
    {
        return 'fd';
    }

    public function getSettingsArr()
    {
        return $this->settings;
    }

    public function getSetting($key, $default = false)
    {
        return $this->setting($key, $default);
    }

    public function testExplodePipe($string)
    {
        return parent::explodePipe($string);
    }

    public function testGetValueLabelPairs()
    {
        return parent::getValueLabelPairs();
    }
}

class AbstractFieldTest extends TestCase
{
    public function testIdAttrExists()
    {
        $field = new __abstractFieldStub();
        $this->assertObjectHasAttribute('field_id', $field);
    }

    public function testDefaultFieldId()
    {
        $field = new __abstractFieldStub();
        $this->assertObjectHasAttribute('field_id', $field);
        $this->assertEquals(0, $field->getId());
    }

    public function testSetFieldIdReturnInstance()
    {
        $field = new __abstractFieldStub();
        $this->assertInstanceOf('EeObjects\Fields\AbstractField', $field->setFieldId(4));
    }

    public function testSetFieldIdChange()
    {
        $field = new __abstractFieldStub();
        $field->setFieldId('5');
        $this->assertEquals(5, $field->getId());
    }

    public function testNameAttrExists()
    {
        $field = new __abstractFieldStub();
        $this->assertObjectHasAttribute('field_name', $field);
    }

    public function testDefaultFieldName()
    {
        $field = new __abstractFieldStub();
        $this->assertEquals('', $field->getFieldName());
    }

    public function testSetFieldNameReturnInstance()
    {
        $field = new __abstractFieldStub();
        $this->assertInstanceOf('EeObjects\Fields\AbstractField', $field->setFieldName('f'));
    }

    public function testSetFieldNameChange()
    {
        $field = new __abstractFieldStub();
        $field->setFieldName('something');
        $this->assertEquals('something', $field->getFieldName());
    }

    public function testSettingsAttrExists()
    {
        $field = new __abstractFieldStub();
        $this->assertObjectHasAttribute('settings', $field);
    }

    public function testDefaultSettingsValue()
    {
        $field = new __abstractFieldStub();
        $this->assertEquals([], $field->getSettingsArr());
    }

    public function testSetSettingsReturnInstance()
    {
        $field = new __abstractFieldStub();
        $this->assertInstanceOf('EeObjects\Fields\AbstractField', $field->setSettings([]));
    }

    public function testSettingValue(): __abstractFieldStub
    {
        $field = new __abstractFieldStub();
        $settings = [
            'option_1' => 'something 1',
            'option_2' => 'something 2',
            'option_3' => 'something 3',
        ];
        $field->setSettings($settings);
        $this->assertEquals('something 3', $field->getSetting('option_3'));
        $this->assertEquals('something 1', $field->getSetting('option_1'));

        return $field;
    }

    /**
     * @depends testSettingValue
     * @param __abstractFieldStub $field
     */
    public function testSettingDefaultValueReturn(__abstractFieldStub $field)
    {
        $this->assertEquals('hello', $field->getSetting('fff', 'hello'));
    }

    public function testSaveReturnValue()
    {
        $field = new __abstractFieldStub();
        $this->assertTrue($field->save('foo'));
    }

    public function testReadReturnValue()
    {
        $field = new __abstractFieldStub();
        $this->assertEquals('hello', $field->read('hello'));
    }

    public function testPrepValueForStorageReturnValue()
    {
        $field = new __abstractFieldStub();
        $this->assertEquals('hello', $field->prepValueForStorage('hello'));
    }

    public function testDeleteReturnValue()
    {
        $field = new __abstractFieldStub();
        $this->assertTrue($field->delete());
    }

    public function testFieldOptionsAttrExists()
    {
        $field = new __abstractFieldStub();
        $this->assertObjectHasAttribute('field_options', $field);
    }

    public function testExplodePipeNoPipeReturn()
    {
        $field = new __abstractFieldStub();
        $string = 'fdsa';
        $expected = [$string];
        $this->assertEquals($expected, $field->testExplodePipe($string));
    }

    public function testExplodePipeValues()
    {
        $field = new __abstractFieldStub();
        $string = '1|2|5|17|54';
        $expected = [1, 2, 5, 17, 54];
        $this->assertEquals($expected, $field->testExplodePipe($string));
    }

    public function testGetValueLabelPairsNothingSet()
    {
        $field = new __abstractFieldStub();
        $this->assertNull($field->testGetValueLabelPairs());
    }

    public function testGetValueLabelPairsValue()
    {
        $field = new __abstractFieldStub();
        $options = [
            'value 1' => 'option 1',
            'value 2' => 'option 2',
            'value 3' => 'option 3',
        ];

        $settings = ['value_label_pairs' => $options];

        $field->setSettings($settings);
        $this->assertEquals($options, $field->testGetValueLabelPairs());
    }
}
