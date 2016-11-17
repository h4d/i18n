<?php

namespace H4D\I18n\Tests\Unit\Translator\Adapters;

namespace Translator\Adapters;


use H4D\I18n\Translator\Adapters\CsvAdapter;

class CsvAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \H4D\I18n\Exceptions\AdapterException
     */
    public function test_constructor_withNoOptions_throwsException()
    {
        new CsvAdapter('es_ES');
    }

    /**
     * @expectedException \H4D\I18n\Exceptions\AdapterException
     */
    public function test_constructor_withInvalidTranslationsDirectory_throwsException()
    {
        $badDir = __DIR__.'/BadDir';
        new CsvAdapter('es_ES', [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$badDir]);
    }


    /**
     * @expectedException \H4D\I18n\Exceptions\AdapterException
     */
    public function test_constructor_withInvalidLang_throwsException()
    {
        $dir = __DIR__.'/../../../samples/data';
        new CsvAdapter('invalid_lanf', [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$dir]);
    }


    public function test_constructor_withProperParams_returnsProperInstance()
    {
        $dir = __DIR__.'/../../../samples/data';
        $adapter = new CsvAdapter('es_ES', [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$dir]);
        $this->assertTrue($adapter instanceof CsvAdapter);
    }

    public function test_logUntranslatedString_writeStringToProperFile()
    {
        $dir = __DIR__.'/../../../samples/data';
        $untranslatedLogFile = __DIR__.'/../../../samples/data/untranslated.txt';
        file_put_contents($untranslatedLogFile, '');
        $adapter = new CsvAdapter('es_ES', [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$dir,
                                            CsvAdapter::OPTION_LOG_UNTRANSLATED_STRING=>true,
                                            CsvAdapter::OPTION_UNTRANSLATED_STRING_LOG_FILE=>$untranslatedLogFile]);
        $string = uniqid('test-string-');
        $adapter->translate($string);
        $this->assertEquals(trim(file_get_contents($untranslatedLogFile)), $string);
    }

}