<?php


namespace H4D\I18n\Exceptions;


class AdapterException extends \Exception
{
    const BASE_CODE                = 0;
    const FILE_OPEN_ERROR_CODE     = 1;
    const DIR_ERROR_CODE           = 2;
    const FILE_CREATION_ERROR_CODE = 3;
    const FILE_WRITE_ERROR_CODE    = 4;

    /**
     * @param string $file
     *
     * @return AdapterException
     */
    public static function fileOpenError($file)
    {
        return new self(sprintf('Error opening file "%s"!', $file),
                        self::BASE_CODE + self::FILE_OPEN_ERROR_CODE);
    }

    /**
     * @param string $dir
     *
     * @return AdapterException
     */
    public static function directoryError($dir)
    {
        return new self(sprintf('Error opening directory "%s"!', $dir),
                        self::BASE_CODE + self::DIR_ERROR_CODE);
    }

    /**
     * @param string $file
     *
     * @return AdapterException
     */
    public static function fileCreateError($file)
    {
        return new self(sprintf('Error creating file "%s"!', $file),
                        self::BASE_CODE + self::FILE_CREATION_ERROR_CODE);
    }

    /**
     * @param string $file
     *
     * @return AdapterException
     */
    public static function fileWriteError($file)
    {
        return new self(sprintf('File "%s" is not writable!', $file),
                        self::BASE_CODE + self::FILE_WRITE_ERROR_CODE);
    }

    /**
     * @return AdapterException
     */
    public static function directoryForTranlationFilesIsNotSetted()
    {
        return new self(sprintf('Directory for translation files is not properly setted! ' .
                                'Use OPTION_TRANSLATIONS_DIRECTORY and set a valid ditectory.'),
                        self::BASE_CODE + self::DIR_ERROR_CODE);
    }

    /**
     * @return AdapterException
     */
    public static function untranslatedLogFileIsNotSetted()
    {
        return new self(sprintf('Log file for untranslated strings is not properly setted! ' .
                                'Use OPTION_UNTRANSLATED_STRING_LOG_FILE and set a valid file path.'),
                        self::BASE_CODE + self::DIR_ERROR_CODE);
    }
}