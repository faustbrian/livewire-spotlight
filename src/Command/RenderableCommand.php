<?php

declare(strict_types=1);

namespace BaseCodeOy\Spotlight\Command;

interface RenderableCommand extends Command
{
    public function render(string $searchQuery, array $parameters): string;
}
