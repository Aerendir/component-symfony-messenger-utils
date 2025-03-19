<?php

declare(strict_types=1);

/*
 * This file is part of the Serendipity HQ Symfony Messenger Utils Component.
 *
 * Copyright (c) Adamo Aerendir Crespi <aerendir@serendipityhq.com>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Component\Messenger\Handler;

use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use SerendipityHQ\Integration\AnsiConverter\ShqTheme;
use Symfony\Component\Process\Process;

abstract class AbstractCommandHandler
{
    private string $kernelProjectDir;
    private bool $successful;
    private AnsiToHtmlConverter $ansiConverter;

    public function __construct(string $kernelProjectDir)
    {
        $theme                  = new ShqTheme();
        $this->ansiConverter    = new AnsiToHtmlConverter($theme);
        $this->kernelProjectDir = $kernelProjectDir;
    }

    protected function run(string $command, array $optsAndArgs): array
    {
        $buildingCommand = [
            // Prepend php
            'php',

            // Add the console
            $this->findConsole(),

            // The command to execute
            $command,
        ];

        $buildingCommand = \array_merge($buildingCommand, $optsAndArgs, ['--env=prod', '--ansi']);

        $now     = new \DateTimeImmutable();
        $process = (new Process($buildingCommand))->setTimeout(3_600);

        $process->run();

        $this->successful = $process->isSuccessful();

        $output = $this->ansiConverter->convert($process->getOutput());
        $output = \explode("\n", $output);

        $errorOutput = $this->ansiConverter->convert($process->getErrorOutput());
        $errorOutput = \explode("\n", $errorOutput);

        return [
            'built_command'    => $buildingCommand,
            'executed_command' => $process->getCommandLine(),
            'executed_at'      => $now->format('Y/m/d h:i:s'),
            'log'              => $output,
            'error_log'        => $errorOutput,
            'exit_code'        => $process->getExitCode(),
            'exit_code_text'   => $process->getExitCodeText(),
        ];
    }

    protected function isSuccessful(): bool
    {
        return $this->successful;
    }

    private function findConsole(): string
    {
        if (\file_exists($this->kernelProjectDir . '/console')) {
            return $this->kernelProjectDir . '/console';
        }

        if (\file_exists($this->kernelProjectDir . '/bin/console')) {
            return $this->kernelProjectDir . '/bin/console';
        }

        throw new \RuntimeException('Unable to find the console file. You should check your Symfony installation. The console file should be in /app/ folder or in /bin/ folder.');
    }
}
