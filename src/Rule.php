<?php

declare(strict_types=1);

namespace nunoron\RulesEngine;

final class Rule
{
    private $condition;
    private $priority;
    private $identifier;

    public function __construct($condition, $priority, $identifier = null)
    {
        $this->identifier = $identifier;
        $this->condition  = $condition;
        $this->priority   = $priority;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }
}