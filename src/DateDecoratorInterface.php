<?php


namespace H4D\I18n;


interface DateDecoratorInterface
{

    const DEFAULT_LOCALE = 'en_GB';

    const FORMAT_ALIAS_TIMESTAMP = 'timestamp';
    const FORMAT_ALIAS_TIME      = 'time';
    const FORMAT_ALIAS_SHORTTIME = 'shortTime';
    const FORMAT_ALIAS_DATE      = 'date';
    const FORMAT_ALIAS_DATETIME  = 'dateTime';

    /**
     * @param \DateTime $date
     * @param string $format
     * @param string $locale
     *
     * @return string
     */
    public function getFormattedDate(\DateTime $date, $format, $locale = '');

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
    public function getTimeShort(\DateTime $dateTime, $locale = '');

    /**
     * @param \DateTime $dateTime
     * @param string $locale
     *
     * @return string
     */
    public function getTimestamp(\DateTime $dateTime, $locale = '');


}