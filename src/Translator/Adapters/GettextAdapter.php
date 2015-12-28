<?php

namespace H4D\I18n\Translator\Adapters;

use H4D\I18n\Exceptions\AdapterException;

class GettextAdapter extends AbstractAdapter
{

    const OPTION_TRANSLATIONS_DIRECTORY = 'tranlationsDirectory';
    const OPTION_TRANSLATIONS_DOMAIN = 'translationsDomain';

    protected $translationsDomain = 'translations';

    /**
     * @param $string
     *
     * @return string
     */
    public function translate($string)
    {
        $translated = gettext($string);
        if ($translated == $string)
        {
            $this->logUntranslatedString($string);
        }
        return $translated;
    }

    /**
     * @throws AdapterException
     */
    protected function init()
    {
        $this->translationsDomain = $this->getOption(self::OPTION_TRANSLATIONS_DOMAIN,
                                                             $this->translationsDomain);
        $translationDirectory = $this->getOption(self::OPTION_TRANSLATIONS_DIRECTORY);
        if (false == is_dir($translationDirectory))
        {
            throw AdapterException::directoryError($translationDirectory);
        }

        // Set language
        putenv('LC_MESSAGES='.$this->getLang());
        setlocale(LC_MESSAGES, $this->getLang());
        // Specify location of translation tables
        bindtextdomain($this->translationsDomain, $translationDirectory);
        bind_textdomain_codeset($this->translationsDomain, 'UTF-8');
        // Choose domain
        textdomain($this->translationsDomain);
        //
    }
}