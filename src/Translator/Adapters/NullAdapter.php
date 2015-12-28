<?php

namespace H4D\I18n\Translator\Adapters;

class NullAdapter extends AbstractAdapter
{

    /**
     * @var string
     */
    protected $lang;

    /**
     * @param string $string
     *
     * @return mixed
     */
    public function translate($string)
    {
        $this->logUntranslatedString($string);
        return $string;
    }

    /**
     * @return void
     */
    protected function init()
    {
        // Do nothing...
    }
}