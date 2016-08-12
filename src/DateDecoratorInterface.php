<?php


namespace H4D\I18n;


interface DateDecoratorInterface
{

    const DEFAULT_LOCALE = 'en_GB';

    const FORMAT_ALIAS_TIMESTAMP             = 'timestamp';
    const FORMAT_ALIAS_TIME                  = 'time';
    const FORMAT_ALIAS_SHORTTIME             = 'shortTime';
    const FORMAT_ALIAS_DATE                  = 'date';
    const FORMAT_ALIAS_DATETIME              = 'dateTime';
    const FORMAT_ALIAS_DATETIME_AND_TIMEZONE = 'dateTimeAndTimeZone';
    const FORMAT_ALIAS_TIMEZONE              = 'timeZone';


    /**
     * @param \DateTime $date
     * @param string $formatAlias
     * @param string $locale
     *
     * @return string
     */
    public function getFormattedDate(\DateTime $date, $formatAlias, $locale = '');

    /**
     * @param \DateTime $dateTime
     * @param string $locale
     *
     * @return string
     */
    public function getDate(\DateTime $dateTime, $locale = '');

    /**
     * @param \DateTime $dateTime
     * @param string $locale
     *
     * @return string
     */
    public function getDateTime(\DateTime $dateTime, $locale = '');

    /**
     * @param \DateTime $dateTime
     * @param string $locale
     *
     * @return string
     */
    public function getTime(\DateTime $dateTime, $locale = '');

    /**
     * @param \DateTime $dateTime
     * @param string $locale
     *
     * @return string
     */
    public function getShortTime(\DateTime $dateTime, $locale = '');

    /**
     * @param \DateTime $dateTime
     * @param string $locale
     *
     * @return string
     */
    public function getTimestamp(\DateTime $dateTime, $locale = '');


    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getDateTimeAndTimeZone(\DateTime $date, $locale = '');

    /**
     * @param \DateTime $date
     * @param string $locale
     *
     * @return string
     */
    public function getTimeZone(\DateTime $date, $locale = '');


}