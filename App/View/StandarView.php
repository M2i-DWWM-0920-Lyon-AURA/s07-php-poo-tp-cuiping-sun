<?php

namespace App\View;

use App\Core\AbstractView;

class StandarView extends AbstractView
{
    protected $bodyTemplates;
    protected $variables;

    public function __construct(array $bodyTemplates, array $variables = [])
    {
        parent::__construct();
        $this->bodyTemplates = $bodyTemplates;
        $this->variables = $variables;
    }

    protected function headRender()
    {
        require '../templates/head/bootstrap.php';
        require '../templates/head/fontawesome.php';
    }

    protected function bodyRender()
    {
        foreach ($this->variables as $varName => $value) {
            $$varName = $value;
        }

        foreach ($this->bodyTemplates as $bodyTemplate)
        {
            require '../templates/body/' . $bodyTemplate . '.php';
        }
    }
}