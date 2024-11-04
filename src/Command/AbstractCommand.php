<?php

declare(strict_types=1);

namespace BaseCodeOy\Spotlight\Command;

use JsonSerializable;

abstract class AbstractCommand implements Command, JsonSerializable
{
    public function getId(): string
    {
        return \sha1(static::class);
    }

    public function getTags(): array
    {
        return [
            $this->getName(),
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'icon' => $this->getIcon(),
            'iconColor' => $this->getIconColor(),
            'tags' => $this->getTags(),
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    abstract public function getName(): string;

    abstract public function getDescription(): string;

    abstract public function getIcon(): string;

    abstract public function getIconColor(): string;
}
