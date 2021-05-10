<?php

declare(strict_types=1);

namespace nunoron\RulesEngine\Contracts;

use nunoron\RulesEngine\Rule;

interface ResolverConflictInterface
{
    public function resolve(array $rules, array $data): Rule;
}