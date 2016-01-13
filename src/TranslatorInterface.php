<?php


namespace H4D\I18n;


interface TranslatorInterface
{
    /**
     * This function supports extra params for var substition in $string.
     *
     * @param string $string
     *
     * @return string
     */
    public function translate($string);
}