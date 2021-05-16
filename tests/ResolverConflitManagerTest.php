<?php

declare(strict_types=1);

namespace nunoron\Tests;

use PHPUnit\Framework\TestCase;
use nunoron\RulesEngine\ResolverConflictManager;
use nunoron\RulesEngine\Rule;

final class ResolverConflitManagerTest extends TestCase
{
    public function testResolverConflitManagerWithSamePriority()
    {
        $resolver = new ResolverConflictManager();

        $rule = $resolver->resolve([new Rule('condition', 1, 'id1'), new Rule('condition', 1), new Rule('condition', 1)], []);

        $this->assertEquals('id1', $rule->getIdentifier());
    }

    public function testResolverConfligsManagerWithReversePriority()
    {
        $resolver = new ResolverConflictManager();

        $rule = $resolver->resolve([new Rule('condition', 3, 'id1'), new Rule('condition', 2, 'id2'), new Rule('condition', 1, 'id3')], []);

        $this->assertEquals('id3', $rule->getIdentifier());
    }
}
