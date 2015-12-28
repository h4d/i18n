<?php


namespace H4D\I18n;

use H4D\I18n\Translator\AdapterInterface;

class Translator
{
    /**
     * @var AdapterInterface
     */
    protected $adaptor;

    /**
     * Translator constructor.
     *
     * @param AdapterInterface $adaptor
     */
    public function __construct(AdapterInterface $adaptor)
    {
        $this->adaptor = $adaptor;
    }


    /**
     * @return AdapterInterface
     */
    protected function getAdaptor()
    {
        return $this->adaptor;
    }

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
        $unstranslatedString = array_shift($args);
        $extraParams = $args;
        $translated = $this->getAdaptor()->translate($unstranslatedString);
        if (count($extraParams)>0)
        {
            $translated = vsprintf($translated, $extraParams);
        }

        return $translated;
    }
}