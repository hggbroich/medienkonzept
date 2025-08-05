<?php

namespace App\Sorting;

use App\Grouping\SortableGroupInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class Sorter {

    /** @var SortingStrategyInterface<mixed>[] */
    private ?array $strategies = null;

    /**
     * @param SortingStrategyInterface<mixed>[] $strategies
     */
    public function __construct(#[AutowireIterator('app.sorting_strategy')] iterable $strategies) {
        foreach($strategies as $strategy) {
            $this->strategies[$strategy::class] = $strategy;
        }
    }

    /**
     * @template T
     * @param array<SortableGroupInterface<T>> $groups
     * @param class-string<SortableGroupInterface<T>> $strategyService
     * @param SortDirection $direction
     * @return void
     */
    public function sortGroupItems(array $groups, string $strategyService, SortDirection $direction = SortDirection::Ascending): void {
        foreach($groups as $group) {
            if($group instanceof SortableGroupInterface) {
                $this->sort($group->getItems(), $strategyService, $direction);
            }
        }
    }

    /**
     * @template T
     * @param array<T> $array
     * @param class-string<SortingStrategyInterface<T>> $strategyService
     * @param SortDirection $direction
     * @param bool $keepIndices
     * @return void
     */
    public function sort(array &$array, string $strategyService, SortDirection $direction = SortDirection::Ascending, bool $keepIndices = false): void {
        $strategy = $this->strategies[$strategyService] ?? null;

        if($strategy === null) {
            throw new ServiceNotFoundException($strategyService);
        }

        if($keepIndices === true) {
            uasort($array, [$strategy, 'compare']);
        } else {
            usort($array, [$strategy, 'compare']);
        }

        if(SortDirection::Descending === $direction) {
            $array = array_reverse($array);
        }
    }
}