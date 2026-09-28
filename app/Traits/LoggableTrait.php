<?php

namespace App\Traits;

trait LoggableTrait
{
    private array $logs = [];

    protected function logAction(string $message): void
    {
        $timestamp = now()->format('Y-m-d H:i:s');
        $this->logs[] = "[{$timestamp}] {$message}";
    }

    public function getLogs(): array
    {
        return $this->logs;
    }
}
