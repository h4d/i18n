<?php

namespace H4D\I18n\Tests\Unit;

use H4D\I18n\Translator;
use H4D\I18n\Translator\Adapters\CsvAdapter;
use H4D\I18n\Translator\Adapters\GettextAdapter;
use H4D\I18n\Translator\Adapters\NullAdapter;

require_once __DIR__ . '/PrivateAccessTrait.php';

class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_translate_withNullAdapter_returnsOriginalString()
    {
        $string = 'Hello!';
        $adapter = new NullAdapter('es_ES');
        $translator = new Translator($adapter);
        $this->assertEquals($string, $translator->translate($string));
    }

    public function test_translate_withCsvAdapter_returnsProperString()
    {
        $options = [CsvAdapter::OPTION_TRANSLATIONS_DIRECTORY=> __DIR__ . '/../samples/data'];
        $adapter = new CsvAdapter('es_ES', $options);
        $translator = new Translator($adapter);
        $this->assertEquals('hola', $translator->translate('Hello'));
        $this->assertEquals('¡Hola xxx!', $translator->translate('Hello %s!', 'xxx'));
    }

    public function test_translate_withGettextAdapter_returnsProperString()
    {
        $options = [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY=> __DIR__ . '/../samples/data',
                    GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test'];
        $adapter = new GettextAdapter('es_ES.UTF-8', $options);
        $translator = new Translator($adapter);
        $this->assertEquals('Nooo', $translator->translate('Nope'));
        $this->assertEquals('¡Hola xxx!', $translator->translate('Hello %s!', 'xxx'));
    }


}