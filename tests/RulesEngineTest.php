<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use nunoron\RulesEngine\ResolverConflictManager;
use nunoron\RulesEngine\Rule;
use nunoron\RulesEngine\RulesEngine;
use stdClass;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

final class RulesEngineTest extends TestCase
{
    public function testRulesEngineWithoutRules()
    {
        $rulesEngine = new RulesEngine(new ExpressionLanguage(), new ResolverConflictManager());

        $rule = $rulesEngine->apply([new Rule('info == "info2"', 1)], ['info' => 'info']);

        $this->assertNull($rule);
    }

    public function testRulesEngineWithOneRule()
    {
        $rulesEngine = new RulesEngine(new ExpressionLanguage(), new ResolverConflictManager());

        $rule = $rulesEngine->apply([new Rule('info == "info"', 1)], ['info' => 'info']);

        $this->assertNotNull($rule);
    }

    public function testRulesEngineWithMultipleRules()
    {
        $rulesEngine = new RulesEngine(new ExpressionLanguage(), new ResolverConflictManager());

        $foo = new stdClass();
        $foo->info = "info";
        $rule = $rulesEngine->apply([new Rule('info.info === "info"', 3), new Rule('info.info === "info2"', 1)], ['info' => $foo]);

        $this->assertNotNull($rule);
        $this->assertEquals($rule->getPriority(), 3);
        $this->assertEquals($rule->getCondition(), 'info.info === "info"');
    }
}