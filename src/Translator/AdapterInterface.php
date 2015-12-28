<?php


namespace H4D\I18n\Translator;


interface AdapterInterface
{

    /**
     * @param $string
     *
     * @return string
     */
    public function translate($string);

}