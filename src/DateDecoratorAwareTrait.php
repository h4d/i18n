<?php


namespace H4D\I18n;


trait DateDecoratorAwareTrait
{
    /**
     * @var DateDecoratorInterface
     */
    protected $dateDecorator;

    /**
     * @param DateDecoratorInterface $dateDecorator
     */
    public function setDateDecorator(DateDecoratorInterface $dateDecorator)
    {
        $this->dateDecorator = $dateDecorator;
    }
}