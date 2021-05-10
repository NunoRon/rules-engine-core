<?php

declare(strict_types=1);

namespace nunoron\RulesEngine;

final class Rule
{
    private $condition;
    private $priority;

    public function __construct(string $condition, int $priority)
    {
        $this->condition = $condition;
        $this->priority = $priority;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }
}