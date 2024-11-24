<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Spotlight\Command;

abstract class AbstractCommand implements Command, \JsonSerializable
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
