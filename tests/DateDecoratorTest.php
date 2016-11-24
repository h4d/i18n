<?php

namespace H4D\I18n\Tests\Unit;

use H4D\I18n\DateDecorator;

class DateDecoratorTest extends \PHPUnit_Framework_TestCase
{
    use PrivateAccessTrait;

    public function test_constructor_withEmptyParams_returnsProperInstance()
    {
        $decorator = new DateDecorator();
        $this->assertTrue($decorator instanceof DateDecorator);
        $this->assertEquals(DateDecorator::DEFAULT_LOCALE,
                            $this->getNonPublicPropertyValue($decorator, 'defaultLocale'));

    }

    /**
     * @expectedException \H4D\I18n\Exceptions\DateDecoratorException
     */
    public function test_constructor_withBadFilePath_throwsException()
    {
        new DateDecorator(__DIR__.'/no-file.ini');
    }

    /**
     * @expectedException \H4D\I18n\Exceptions\DateDecoratorException
     */
    public function test_constructor_withInvalidFormatFile_throwsException()
    {
        new DateDecorator(__FILE__);
    }

    public function test_setDefaultLocale_setsDefaultLocaleVar()
    {
        $locale = 'TEST';
        $decorator = new DateDecorator();
        $decorator->setDefaultLocale($locale);
        $localeSet = $this->getNonPublicPropertyValue($decorator, 'defaultLocale');
        $this->assertEquals($localeSet, $locale);
    }

    public function test_getFormattedDate_resturnsProperValuesForDefaultConfig()
    {
        date_default_timezone_set('UTC');
        $date = new \DateTime('2015-08-18T12:30:59');
        $decorator = new DateDecorator();

        $locale = 'es_ES';
        $this->assertEquals('18/08/2015', $decorator->getFormattedDate($date, 'date', $locale));
        $this->assertEquals('12:30:59 (UTC)', $decorator->getFormattedDate($date, 'time', $locale));
        $this->assertEquals('12:30 (UTC)', $decorator->getFormattedDate($date, 'shortTime', $locale));
        $this->assertEquals('18/08/2015 12:30:59 (UTC)', $decorator->getFormattedDate($date, 'dateTime', $locale));

        $locale = 'en_GB';
        $this->assertEquals('2015-08-18', $decorator->getFormattedDate($date, 'date', $locale));
        $this->assertEquals('12:30:59 (UTC)', $decorator->getFormattedDate($date, 'time', $locale));
        $this->assertEquals('12:30 (UTC)', $decorator->getFormattedDate($date, 'shortTime', $locale));
        $this->assertEquals('2015-08-18 12:30:59 (UTC)', $decorator->getFormattedDate($date, 'dateTime', $locale));
    }

    public function test_getDate_resturnsProperValuesForDefaultConfig()
    {
        date_default_timezone_set('UTC');
        $date = new \DateTime('2015-08-18T12:30:59');
        $decorator = new DateDecorator();

        $locale = 'es_ES';
        $this->assertEquals('18/08/2015', $decorator->getDate($date, $locale));

        $locale = 'en_GB';
        $this->assertEquals('2015-08-18', $decorator->getDate($date, $locale));
    }

    public function test_getTime_resturnsProperValuesForDefaultConfig()
    {
        date_default_timezone_set('UTC');
        $date = new \DateTime('2015-08-18T12:30:59');
        $decorator = new DateDecorator();

        $locale = 'es_ES';
        $this->assertEquals('12:30:59 (UTC)', $decorator->getTime($date, $locale));

        $locale = 'en_GB';
        $this->assertEquals('12:30:59 (UTC)', $decorator->getTime($date, $locale));
    }

    public function test_getTimeShort_resturnsProperValuesForDefaultConfig()
    {
        date_default_timezone_set('UTC');
        $date = new \DateTime('2015-08-18T12:30:59');
        $decorator = new DateDecorator();

        $locale = 'es_ES';
        $this->assertEquals('12:30 (UTC)', $decorator->getTimeShort($date, $locale));

        $locale = 'en_GB';
        $this->assertEquals('12:30 (UTC)', $decorator->getTimeShort($date, $locale));
    }

    public function test_getDateTime_resturnsProperValuesForDefaultConfig()
    {
        date_default_timezone_set('UTC');
        $date = new \DateTime('2015-08-18T12:30:59');
        $decorator = new DateDecorator();

        $locale = 'es_ES';
        $this->assertEquals('18/08/2015 12:30:59 (UTC)', $decorator->getDateTime($date, $locale));

        $locale = 'en_GB';
        $this->assertEquals('2015-08-18 12:30:59 (UTC)', $decorator->getDateTime($date, $locale));
    }

    public function test_getTimestamp_resturnsProperValuesForDefaultConfig()
    {
        date_default_timezone_set('UTC');
        $date = new \DateTime('2015-08-18T12:30:59');
        $decorator = new DateDecorator();

        $locale = 'es_ES';
        $this->assertEquals('1439901059s', $decorator->getTimestamp($date, $locale));

        $locale = 'en_GB';
        $this->assertEquals('1439901059s', $decorator->getTimestamp($date, $locale));
    }

    /**
     * @expectedException \H4D\I18n\Exceptions\DateDecoratorException
     */
    public function test_getFormat_withBadLocale_throwsException()
    {
        $decorator = new DateDecorator();
        $this->invokeNonPublicMethod($decorator, 'getFormat', ['BadLocale', 'date']);
    }

    /**
     * @expectedException \H4D\I18n\Exceptions\DateDecoratorException
     */
    public function test_getFormat_withBadAlias_throwsException()
    {
        $decorator = new DateDecorator();
        $this->invokeNonPublicMethod($decorator, 'getFormat', ['es_ES', 'badAlias']);
    }


}