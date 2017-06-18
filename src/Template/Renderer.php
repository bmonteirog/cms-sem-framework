<?php declare(strict_types = 1);

namespace CMS\Template;

/*
|--------------------------------------------------------------------------
| Interface do nosso objeto de Renderização
|--------------------------------------------------------------------------|
*/
interface Renderer
{
    public function render($template, $data = []) : string;
}
