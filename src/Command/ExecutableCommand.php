<?php

declare(strict_types=1);

namespace BombenProdukt\Spotlight\Command;

use Livewire\Component;

interface ExecutableCommand extends Command
{
    public function execute(Component $component): void;
}
