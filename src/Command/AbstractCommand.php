<?php

declare(strict_types=1);

namespace BombenProdukt\Spotlight\Command;

use JsonSerializable;

abstract class AbstractCommand implements Command, JsonSerializable
{
    public function getId(): string
    {
        return \sha1(static::class);
    }

    abstract public function getName(): string;

    abstract public function getDescription(): string;

    abstract public function getIcon(): string;

    abstract public function getIconColor(): string;

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'icon' => $this->getIcon(),
            'iconColor' => $this->getIconColor(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
