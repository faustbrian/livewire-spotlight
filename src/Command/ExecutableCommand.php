<?php

declare(strict_types=1);

namespace BombenProdukt\Spotlight\Command;

interface ExecutableCommand extends Command
{
    public function execute(): void;
}
