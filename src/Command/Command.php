<?php

declare(strict_types=1);

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
