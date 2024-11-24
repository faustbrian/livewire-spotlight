<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Spotlight\Command;

use Livewire\Component;

interface ExecutableCommand extends Command
{
    public function execute(Component $component, array $parameters): void;
}
