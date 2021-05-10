<?php

declare(strict_types=1);

namespace RulesEngine;

final class PriorityResolver
{
    /**
     * @param array $rules
     * @param array $data
     * @return Rule[]| Rule
     */
    public function __invoke(array $rules, array $data)
    {
        $rulesPriorities = [];
        foreach ($rules as $rule) {
            $rulesPriorities[$rule->getPriority()][] = $rule;
        }

        ksort($rulesPriorities);
        $rulesWithPriority = reset($rulesPriorities);

        return $rulesWithPriority !== false ? $rulesWithPriority : $rules;
    }
}