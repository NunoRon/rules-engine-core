<?php
declare(strict_types=1);

namespace nunoron\RulesEngine;

interface ResolverConflictInterface
{
    public function resolve(array $rules, array $data): Rule;
}