<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Spotlight\Command;

interface Command
{
    public function getId(): string;

    public function getName(): string;

    public function getDescription(): string;

    public function getIcon(): string;

    public function getIconColor(): string;

    public function getTags(): array;

    public function toArray(): array;
}
