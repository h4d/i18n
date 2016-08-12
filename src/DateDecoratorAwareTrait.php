<?php


namespace H4D\I18n;


trait DateDecoratorAwareTrait
{
    /**
     * @var DateDecoratorInterface
     */
    protected $dateDecorator;

    /**
     * @param TranslatorInterface $dateDecorator
     */
    public function setDateDecorator(TranslatorInterface $dateDecorator)
    {
        $this->dateDecorator = $dateDecorator;
    }
}