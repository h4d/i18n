<?php

require_once __DIR__ . '/../vendor/autoload.php';


use H4D\I18n\Translator;
use H4D\I18n\Translator\Adapters\GettextAdapter;

try
{
    // New Gettext adaptor instance
    $adapter = new GettextAdapter('es_ES.UTF-8',
                                  [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY => __DIR__ . '/data',
                                   GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test']);

    // New translator instace
    $translator = new Translator($adapter);

    // Translate a simple string
    $translated = $translator->translate('Simple string.');
    printf('Translated string: %s' . PHP_EOL, $translated);

    // Translate a string with vars
    $translated = $translator->translate('Hello %s!', 'Pakito');
    printf('Translated string: %s' . PHP_EOL, $translated);

}
catch (\Exception $e)
{
    printf('EXCEPTION!!: %s'.PHP_EOL, $e->getMessage());
}


try
{
    // New CSV adaptor instance + capture untranslated string to ./untranslated.txt
    $adapter = new GettextAdapter('es_ES.UTF-8',
                                  [GettextAdapter::OPTION_TRANSLATIONS_DIRECTORY => __DIR__ . '/data',
                                   GettextAdapter::OPTION_TRANSLATIONS_DOMAIN => 'test',
                                   GettextAdapter::OPTION_LOG_UNTRANSLATED_STRING => true,
                                   GettextAdapter::OPTION_UNTRANSLATED_STRING_LOG_FILE => __DIR__
                                                                                          . '/untranslated.txt']);

    // New translator instace
    $translator = new Translator($adapter);

    // Translate a simple string
    $translated = $translator->translate('Simple string.');
    printf('Translated string: %s' . PHP_EOL, $translated);

    // Translate a string with vars
    $translated = $translator->translate('Hello %s!', 'Pakito');
    printf('Translated string: %s' . PHP_EOL, $translated);

}
catch (\Exception $e)
{
    printf('EXCEPTION!!: %s'.PHP_EOL, $e->getMessage());
}

