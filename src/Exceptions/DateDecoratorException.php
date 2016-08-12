<?php


namespace H4D\I18n\Exceptions;


class DateDecoratorException extends Exception
{
    const BASE_CODE                          = 1;
    const FILE_OPEN_ERROR_CODE               = 1;
    const FILE_READ_ERROR_CODE               = 2;
    const LOCALE_CONFIG_NOT_FOUND_ERROR_CODE = 3;
    const FORMAT_CONFIG_NOT_FOUND_ERROR_CODE = 4;

    /**
     * @param string $file
     *
     * @return DateDecoratorException
     */
    public static function fileOpenError($file)
    {
        return new self(sprintf('Error opening file "%s"!', $file),
                        self::BASE_CODE + self::FILE_OPEN_ERROR_CODE);
    }

    /**
     * @param string $file
     *
     * @return DateDecoratorException
     */
    public static function fileReadError($file)
    {
        return new self(sprintf('Error reading file "%s"!', $file),
                        self::BASE_CODE + self::FILE_READ_ERROR_CODE);
    }

    /**
     * @param string $locale
     *
     * @return DateDecoratorException
     */
    public static function localeNotFound($locale)
    {
        return new self(sprintf('Locale config "%s" not found!', $locale),
                        self::BASE_CODE + self::LOCALE_CONFIG_NOT_FOUND_ERROR_CODE);
    }

    /**
     * @param string $locale
     * @param string $alias
     *
     * @return DateDecoratorException
     */
    public static function formatNotFound($locale, $alias)
    {
        return new self(sprintf('Locale config "%s.%s" not found!', $locale, $alias),
                        self::BASE_CODE + self::FORMAT_CONFIG_NOT_FOUND_ERROR_CODE);
    }
}