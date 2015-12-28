<?php

namespace H4D\I18n\Translator\Adapters;

use H4D\I18n\Exceptions\AdapterException;

class CsvAdapter extends AbstractAdapter
{
    const OPTION_TRANSLATIONS_DIRECTORY = 'directory';
    const OPTION_STRING_DELIMITER       = 'stringDelimiter';

    /**
     * @var string
     */
    protected $stringDelimiter = ',';
    /**
     * @var array
     */
    protected $translations = [];

    /**
     * @param $string
     *
     * @return string
     */
    public function translate($string)
    {
        $translated = isset($this->translations[$string]) ? $this->translations[$string] : $string;
        if ($translated == $string)
        {
            $this->logUntranslatedString($string);
        }

        return $translated;
    }

    /**
     * @throws AdapterException
     * @throws void
     */
    protected function init()
    {
        $this->stringDelimiter = $this->getOption(self::OPTION_STRING_DELIMITER,
                                                  $this->stringDelimiter);
        $dir = $this->getOption(self::OPTION_TRANSLATIONS_DIRECTORY);
        if (is_null($dir))
        {
            throw AdapterException::directoryForTranlationFilesIsNotSetted();
        }
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        if (!is_dir($dir))
        {
            throw AdapterException::directoryError($dir);
        }
        $translationsFile = $dir . DIRECTORY_SEPARATOR . $this->getLang() . '.csv';
        if (!is_file($translationsFile) || !is_readable($translationsFile))
        {
            throw AdapterException::fileOpenError($translationsFile);
        }
        $handler = fopen($translationsFile, 'r');
        if (false == $handler)
        {
            throw AdapterException::fileOpenError($translationsFile);
        }
        while (false !== ($data = fgetcsv($handler, null, $this->stringDelimiter)))
        {
            if (isset($data[0]))
            {
                $this->translations[$data[0]] = isset($data[1]) ? $data[1] : $data[0];
            }
        }
        fclose($handler);
    }
}