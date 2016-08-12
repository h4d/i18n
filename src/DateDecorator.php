<?php


namespace H4D\I18n;


use H4D\I18n\Exceptions\DateDecoratorException;

class DateDecorator implements DateDecoratorInterface
{
    /**
     * @var string
     */
    protected $defaultLocale;
    /**
     * @var array
     */
    protected $config;

    /**
     * DateDecorator constructor.
     *
     * @param string $formatsFile
     * @param string $defaultLocale
     *
     * @throws DateDecoratorException
     */
    public function __construct($formatsFile, $defaultLocale = self::DEFAULT_LOCALE)
    {
        $this->defaultLocale = $defaultLocale;
        if (!is_file($formatsFile) || !is_readable($formatsFile))
        {
            throw DateDecoratorException::fileOpenError($formatsFile);
        }
        $this->config = parse_ini_file($formatsFile, true);
        if (false === $this->config)
        {
            throw DateDecoratorException::fileReadError($formatsFile);
        }
    }


    /**
     * @param string $locale
     * @param string $alias
     *
     * @return string
     * @throws DateDecoratorException
     */
    protected function getFormat($locale, $alias)
    {
        if (!array_key_exists($locale, $this->config))
        {
            throw DateDecoratorException::localeNotFound($locale);
        }

        if (!array_key_exists($alias, $this->config[$locale]))
        {
            throw DateDecoratorException::formatNotFound($locale, $alias);
        }

        return $this->config[$locale][$alias];
    }


    /**
     * @param string $defaultLocale es_ES, en_GB...
     *
     * @return $this
     */
    public function setDefaultLocale($defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;

        return $this;
    }

    /**
     * @param \DateTime $date
     * @param string $format
     *
     * @return string
     */
    protected function formatDateTime(\DateTime $date, $format)
    {
        return $date->format($format);
    }

    /**
     * @param \DateTime $date
     * @param string $formatAlias
     * @param string $locale
     *
     * @return string
     */
    public function getFormattedDate(\DateTime $date, $formatAlias, $locale = '')
    {
        $locale = ('' != $locale) ? $locale : $this->defaultLocale;
        $format = $this->getFormat($locale, $formatAlias);

        return $this->formatDateTime($date, $format);
    }

    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getDate(\DateTime $date, $locale = '')
    {
        return $this->getFormattedDate($date, static::FORMAT_ALIAS_DATE, $locale);
    }

    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getTime(\DateTime $date, $locale = '')
    {
        return $this->getFormattedDate($date, static::FORMAT_ALIAS_TIME, $locale);
    }

    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getShortTime(\DateTime $date, $locale = '')
    {
        return $this->getFormattedDate($date, static::FORMAT_ALIAS_SHORTTIME, $locale);
    }

    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getTimestamp(\DateTime $date, $locale = '')
    {
        return $this->getFormattedDate($date, static::FORMAT_ALIAS_TIMESTAMP, $locale);
    }

    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getDateTime(\DateTime $date, $locale = '')
    {
        return $this->getFormattedDate($date, static::FORMAT_ALIAS_DATETIME, $locale);
    }

}