<?php


namespace H4D\I18n;


class NullTranslator implements TranslatorInterface
{

    /**
     * This function supports extra params for var substition in $string.
     *
     * @param string $string
     *
     * @return string
     */
    public function translate($string)
    {
        $args = func_get_args();
        $translated = array_shift($args);
        $extraParams = $args;
        if (count($extraParams)>0)
        {
            $translated = vsprintf($translated, $extraParams);
        }

        return $translated;
    }
}