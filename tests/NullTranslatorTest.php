<?php

namespace H4D\I18n\Tests\Unit;
use H4D\I18n\NullTranslator;


class NullTranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_translate_returnsOriginalString()
    {
        $string = 'Hello!';
        $translator = new NullTranslator();
        $this->assertEquals($string, $translator->translate($string));

        $string = 'Hello %s!';
        $translator = new NullTranslator();
        $this->assertEquals('Hello world!', $translator->translate($string, 'world'));


    }
}