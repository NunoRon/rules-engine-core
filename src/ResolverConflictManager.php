<?php

declare(strict_types=1);

namespace nunoron\RulesEngine;

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

        foreach ($this->getResolvers() as $resolver) {
            $rules   = new $resolver($rules, $data);
            if (count([$rules]) === 1) {
                return reset($rules);
            }
        }

        return reset($rules);
    }
}