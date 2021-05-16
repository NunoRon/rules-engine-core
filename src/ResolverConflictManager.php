<?php

declare(strict_types=1);

namespace nunoron\RulesEngine;

use nunoron\RulesEngine\Rule;
use nunoron\RulesEngine\Contracts\ResolverConflictInterface;

final class ResolverConflictManager implements ResolverConflictInterface
{
    public function getResolvers(): array
    {
        return [PriorityResolver::class];
    }

    public function resolve(array $rules, array $data): Rule
    {
        if (count($rules) === 1) {
            return reset($rules);
        }

        foreach ($this->getResolvers() as $class) {
            $resolver = new $class; 
            $rules = $resolver($rules, $data);
            
            if (count($rules) === 1) {
                return reset($rules);
            }
        }

        return reset($rules);
    }
}
