<?php

declare(strict_types=1);

namespace BaseCodeOy\Spotlight\Http\Livewire;

use BaseCodeOy\Spotlight\Command\Command;
use BaseCodeOy\Spotlight\Command\ExecutableCommand;
use BaseCodeOy\Spotlight\Command\RenderableCommand;
use Fuse\Fuse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property Collection $commands
 */
abstract class AbstractSpotlight extends Component
{
    public string $searchQuery = '';

    public string $commandId = '';

    public array $commandState = [];

    public function render(): View
    {
        $commands = $this->commands->map->toArray()->toArray();

        if (!empty($this->searchQuery)) {
            $commands = Arr::pluck(
                (new Fuse(
                    $commands,
                    ['keys' => ['name', 'description', 'tags']],
                ))->search($this->searchQuery),
                'item',
            );
        }

        return view('livewire-spotlight::modal', [
            'command' => $this->getCommandById($this->commandId)?->render($this->searchQuery, $this->commandState),
            'commands' => $commands,
        ]);
    }

    public function executeCommand(string $id): void
    {
        $command = $this->getCommandById($id);

        if (null === $command) {
            return;
        }

        if ($command instanceof ExecutableCommand) {
            $command->execute($this, $this->commandState);
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
