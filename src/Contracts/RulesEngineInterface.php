<?php

declare(strict_types=1);

namespace RulesEngine\Contracts;

use RulesEngine\Rule;

interface RulesEngineInterface
{
    /**
     * @param Rule[] $rules
     * @param mixed[] $data
     */
    public function apply(array $rules, array $data): ?Rule;
}