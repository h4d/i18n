<?php


namespace H4D\I18n\Translator\Adapters;


use H4D\I18n\Exceptions\AdapterException;
use H4D\I18n\Translator\AdapterInterface;

abstract class AbstractAdapter implements AdapterInterface
{
    const OPTION_LOG_UNTRANSLATED_STRING = 'logUntranslatedStrings';
    const OPTION_UNTRANSLATED_STRING_LOG_FILE = 'untranslatedStringsLogFile';

    /**
     * @var string
     */
    protected $lang;
    /**
     * @var array
     */
    protected $options;

    /**
     * AbstractAdaptor constructor.
     *
     * @param string $lang
     * @param array $options
     */
    public function __construct($lang, $options = [])
    {
        $this->lang = $lang;
        $this->options = $options;
        $this->init();
    }

    /**
     * @return string
     */
    protected function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return mixed
     */
    protected function getOption($name, $value = null)
    {
        return isset($this->options[$name]) ? $this->options[$name] : $value;
    }

    /**
     * @return void
     */
    abstract protected function init();

    /**
     * @param string $string
     *
     * @throws AdapterException
     */
     protected function logUntranslatedString($string)
     {
         if (true == $this->getOption(self::OPTION_LOG_UNTRANSLATED_STRING, false))
         {
             $logFile = $this->getOption(self::OPTION_UNTRANSLATED_STRING_LOG_FILE);
             if (is_null($logFile))
             {
                 throw AdapterException::untranslatedLogFileIsNotSetted();
             }
             if (!is_file($logFile))
             {
                 $result = touch($logFile);
                 if (false == $result)
                 {
                     throw AdapterException::fileCreateError($logFile);
                 }
             }

             if (!is_writable($logFile))
             {
                 throw AdapterException::fileWriteError($logFile);
             }

             $currentUntranslatedStrings = file($logFile, FILE_IGNORE_NEW_LINES);
             if (!in_array($string, $currentUntranslatedStrings))
             {
                 file_put_contents($logFile, $string.PHP_EOL, FILE_APPEND);
             }
         }
     }
}