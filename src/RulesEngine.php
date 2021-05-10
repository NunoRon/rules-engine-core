<?php

declare(strict_types=1);

namespace nunoron\RulesEngine;

use nunoron\RulesEngine\Contracts\RulesEngineInterface;
use nunoron\RulesEngine\Contracts\ResolverConflictInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

final class RulesEngine implements RulesEngineInterface
{
    private $expressionLanguage;
    private $resolveConflict;

    public function __construct(ExpressionLanguage $expressionLanguage, ResolverConflictInterface $resolveConflict = null)
    {
        $this->expressionLanguage = $expressionLanguage;
        $this->resolveConflict    = $resolveConflict ?? $this->getDefaultResolverConflict();
    }

    /**
     * @param Rule[] $rules
     * @param mixed[] $data
     */
    public function apply(array $rules, array $data): ?Rule
    {
        $rulesMatch = [];
        foreach ($rules as $rule) {
            if (! $this->expressionLanguage->evaluate($rule->getCondition(), $data)) {
                continue;
            }

            $rulesMatch[] = $rule;
        }

        if ($rulesMatch === []) {
            return null;
        }

        return $this->resolve($rulesMatch, $data);
    }

    private function resolve(array $rules, array $data): Rule
    {
        return $this->resolveConflict->resolve($rules, $data);
    }

    private function getDefaultResolverConflict(): ResolverConflictInterface
    {
        return new ResolverConflictManager();
    }
}