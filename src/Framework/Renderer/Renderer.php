<?php

declare(strict_types=1);

namespace Framework\Renderer;

class Renderer
{
    public function render(string $view, array $params = []): string
    {
        $template = sprintf('../template/%s.php', $view);

        ob_start();
        extract($params, EXTR_OVERWRITE);
        require $template;

        return ob_get_clean();
    }
}
