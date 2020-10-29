<?php

namespace App\Core;

abstract class AbstractView
{

    protected $pageTitle;
    abstract protected function headRender();
    abstract protected function bodyRender();

    protected function __construct(string $pageTitle = 'Document')
    {
        $this->pageTitle = $pageTitle;
    }
    public function render()
    {
        echo <<<HTML
            <!DOCTYPE html>
            <html lang="fr">
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$this->pageTitle</title>
HTML;
        $this->headRender();
        echo <<<HTML
            </head>
            <body>
            <div class="container">
HTML;
        $this->bodyRender();
        echo <<<HTML
            </div>
            </body>
            </html>
HTML;
    }

    /**
     * Get the value of pageTitle
     */ 
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set the value of pageTitle
     *
     * @return  self
     */ 
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }
}