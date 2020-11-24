<?php

namespace Encrypter\Command;

use Consolly\Command\Command;

class DefaultCommand extends Command
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "";
    }

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return [
        ];
    }

    /**
     * @inheritDoc
     */
    public function handle(array $nextArgs): void
    {
        echo "default command";
    }
}