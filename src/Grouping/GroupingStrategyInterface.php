<?php

namespace App\Grouping;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/**
 * @template K
 * @template V
 * @template-covariant G of GroupInterface<K, V>
 */
#[AutoconfigureTag('app.grouping_strategy')]
interface GroupingStrategyInterface {

    /**
     * @param V $object
     * @param array<string, mixed> $options
     * @return K|K[]
     */
    public function computeKey(mixed $object, array $options = [ ]): mixed;

    /**
     * @param V $keyA
     * @param V $keyB
     * @param array<string, mixed> $options
     * @return bool
     */
    public function areEqualKeys(mixed $keyA, mixed $keyB, array $options = [ ]): bool;

    /**
     * @param K $key
     * @param array<string, mixed> $options
     * @return G
     */
    public function createGroup(mixed $key, array $options = [ ]): GroupInterface;
}