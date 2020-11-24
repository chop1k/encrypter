<?php

namespace Encrypter\Command\Decrypt;

use Consolly\Command\Command;
use Encrypter\Option\FileOption;
use Encrypter\Option\PasswordOption;

class DecryptCommand extends Command
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return "decrypt";
    }

    private PasswordOption $password;
    private FileOption $file;

    /**
     * @inheritDoc
     */
    public function getOptions(): array
    {
        return [
            $this->password,
            $this->file
        ];
    }

    public function __construct()
    {
        $this->password = new PasswordOption();
        $this->file = new FileOption();
    }

    /**
     * @inheritDoc
     */
    public function handle(array $nextArgs): void
    {
        echo "decrypt command";
    }
}