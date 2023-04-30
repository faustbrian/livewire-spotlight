<?php

declare(strict_types=1);

namespace BombenProdukt\Spotlight\Command;

interface RenderableCommand extends Command
{
    public function render(string $searchQuery): string;
}
