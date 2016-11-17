<?php

namespace H4D\I18n\Tests\Unit\Translator\Adapters;

namespace Translator\Adapters;


use H4D\I18n\Translator\Adapters\GettextAdapter;

class GettextAdapterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \H4D\I18n\Exceptions\AdapterException
     */
    public function test_constructor_withNoOptions_throwsException()
    {
        new GettextAdapter('es_ES');
    }

    /**
     * @expectedException \H4D\I18n\Exceptions\AdapterException
     */
    public function test_constructor_withInvalidTranslationsDirectory_throwsException()
    {
        $badDir = __DIR__.'/BadDir';
        new GettextAdapter('es_ES', [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$badDir]);
    }

    public function test_constructor_withProperParams_returnsProperInstance()
    {
        $dir = __DIR__.'/../../../samples/data';
        $adapter = new GettextAdapter('es_ES', [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$dir,
                                                GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test',]);
        $this->assertTrue($adapter instanceof GettextAdapter);
    }

    public function test_logUntranslatedString_writeStringToProperFile()
    {
        $dir = __DIR__.'/../../../samples/data';
        $untranslatedLogFile = __DIR__.'/../../../samples/data/untranslated.txt';
        file_put_contents($untranslatedLogFile, '');
        $adapter = new GettextAdapter('es_ES', [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY=>$dir,
                                                GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test',
                                                GettextAdapter::OPTION_LOG_UNTRANSLATED_STRING=>true,
                                                GettextAdapter::OPTION_UNTRANSLATED_STRING_LOG_FILE=>$untranslatedLogFile]);
        $string = uniqid('test-string-');
        $adapter->translate($string);
        $this->assertEquals(trim(file_get_contents($untranslatedLogFile)), $string);
    }

}