<?php

declare(strict_types=1);

namespace BombenProdukt\Spotlight\Http\Livewire;

use BombenProdukt\Spotlight\Command\Command;
use BombenProdukt\Spotlight\Command\ExecutableCommand;
use BombenProdukt\Spotlight\Command\RenderableCommand;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property Collection $commands
 */
abstract class AbstractSpotlight extends Component
{
    public string $searchQuery = '';

    public string $commandId = '';

    public function render(): View
    {
        return view('livewire-spotlight::modal', [
            'command' => $this->getCommandById($this->commandId)?->render($this->searchQuery),
            'commands' => $this->commands->filter(fn (Command $command): bool => \mb_stripos($command->getName(), $this->searchQuery) !== false),
        ]);
    }

    public function executeCommand(string $id): void
    {
        $command = $this->getCommandById($id);

        if (null === $command) {
            return;
        }

        if ($command instanceof ExecutableCommand) {
            $command->execute($this);
        }

        if ($command instanceof RenderableCommand) {
            $this->commandId = $id;
        }
    }

    public function getCommandById(string $id): ?Command
    {
        return $this
            ->commands
            ->first(fn (Command $command): bool => $command->getId() === $id);
    }

    public function getCommandsProperty(): Collection
    {
        return collect($this->getCommands())->map(fn (string $command): Command => app($command));
    }

    /**
     * @return class-string<Command>[]
     */
    protected function getCommands(): array
    {
        return [];
    }
}
