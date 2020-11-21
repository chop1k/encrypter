<?php

namespace Encrypter\Command;

use Consolly\Command\Command;
use Encrypter\Option\HelpOption;

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
            "help" => new HelpOption()
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