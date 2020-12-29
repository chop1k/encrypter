<?php

use Consolly\Consolly;
use Encrypter\Command\Decrypt\DecryptCommand;
use Encrypter\Command\DefaultCommand;
use Encrypter\Command\Encrypt\EncryptCommand;
use Encrypter\Command\Hash\HashCommand;

require dirname(__DIR__) . "/vendor/autoload.php";

$consolly = new Consolly();

$consolly->addCommand(new DecryptCommand());
$consolly->addCommand(new EncryptCommand());
$consolly->addCommand(new HashCommand());

$consolly->setDefaultCommand(new DefaultCommand());

$consolly->handle($argv);