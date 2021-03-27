<?php

use Consolly\Consolly;
use Encrypter\Command\Decrypt\DecryptCommand;
use Encrypter\Command\Decrypt\DecryptJsonCommand;
use Encrypter\Command\Encrypt\EncryptCommand;
use Encrypter\Command\Encrypt\EncryptJsonCommand;
use Encrypter\Command\Hash\HashCommand;

require dirname(__DIR__) . "/vendor/autoload.php";

array_shift($argv);

$consolly = Consolly::default($argv);

$consolly->addCommand(new DecryptJsonCommand());
$consolly->addCommand(new EncryptJsonCommand());
$consolly->addCommand(new DecryptCommand());
$consolly->addCommand(new EncryptCommand());
$consolly->addCommand(new HashCommand());

$consolly->handle();
