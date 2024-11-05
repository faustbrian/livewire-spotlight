<?php

declare(strict_types=1);

namespace BaseCodeOy\Spotlight\Command;

use Livewire\Component;

interface ExecutableCommand extends Command
{
    public function execute(Component $component, array $parameters): void;
}
