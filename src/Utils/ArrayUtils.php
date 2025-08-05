<?php

namespace App\Utils;

use InvalidArgumentException;
use Closure;
use Stringable;

class ArrayUtils {

    /**
     * @template T
     * @param iterable<T> $items
     * @param Closure(T): void $closure
     * @return void
     */
    public static function apply(iterable &$items, Closure $closure): void {
        foreach($items as $item) {
            $closure($item);
        }
    }

    /**
     * @template T
     * @param iterable<T> $items
     * @param Closure(T): bool $predicate
     * @return T|null
     */
    public static function first(iterable $items, Closure $predicate): mixed {
        foreach($items as $item) {
            if($predicate($item) === true) {
                return $item;
            }
        }

        return null;
    }

    /**
     * @template T
     * @param array-key[] $keys
     * @param T[] $values
     * @return array<array-key, T>
     */
    public static function createArray(array $keys, array $values): array {
        $array = [ ];
        $count = count($keys);

        $keys = array_values($keys);
        $values = array_values($values);

        if(count($keys) !== count($values)) {
            throw new InvalidArgumentException('$keys and $items parameter need to have the same length.');
        }

        for($i = 0; $i < $count; $i++) {
            $array[$keys[$i]] = $values[$i];
        }

        return $array;
    }

    /**
     * @template T
     * @template R of array-key|array-key[]
     * @param T[] $items
     * @param Closure(T): R $keyFunc
     * @param bool $multiValue
     * @return array<R, T>|array<R, T[]>
     */
    public static function createArrayWithKeys(iterable $items, Closure $keyFunc, bool $multiValue = false): array {
        $array = [ ];

        foreach($items as $item) {
            $keys = $keyFunc($item);

            if(!is_iterable($keys)) {
                $keys = [ $keys ];
            }

            foreach($keys as $key) {
                if ($multiValue === true) {
                    if (!isset($array[$key])) {
                        $array[$key] = [];
                    }

                    $array[$key][] = $item;
                } else {
                    $array[$key] = $item;
                }
            }
        }

        return $array;
    }

    /**
     * @template T
     * @template R of array-key
     * @param T[] $items
     * @param Closure(T): R $keyFunc
     * @param Closure(T): mixed $valueFunc
     * @return array<R, mixed>
     */
    public static function createArrayWithKeysAndValues(iterable $items, Closure $keyFunc, Closure $valueFunc): array {
        $array = [ ];

        foreach($items as $item) {
            $array[$keyFunc($item)] = $valueFunc($item);
        }

        return $array;
    }

    /**
     * @template T
     * @template K of array-key
     * @param array<K, T> $items
     * @param K[] $keys
     * @return T[]
     */
    public static function findAllWithKeys(iterable $items, array $keys): array {
        $result = [ ];

        foreach($items as $key => $item) {
            if(in_array($key, $keys)) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * Returns all items of an array of object which are the same type as given.
     *
     * @template T of object
     * @template R of T
     * @param iterable<T> $items
     * @param class-string<R> $type
     * @return R[]
     */
    public static function filterByType(iterable $items, string $type): array {
        $result = [ ];

        foreach($items as $item) {
            if(is_object($item) && $item::class === $type) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @template T
     * @param T[] $items
     * @return T[]
     */
    public static function unique(iterable $items): array {
        $result = [ ];

        foreach($items as $item) {
            if(!in_array($item, $result, true)) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @template T
     * @param iterable<T> $items
     * @return T[]
     */
    public static function iterableToArray(iterable $items): array {
        $array = [ ];

        foreach($items as $item) {
            $array[] = $item;
        }

        return $array;
    }

    /**
     * @template T
     * @param iterable<T> $iterableA
     * @param iterable<T> $iterableB
     * @return bool
     */
    public static function areEqual(iterable $iterableA, iterable $iterableB): bool {
        $arrayA = self::iterableToArray($iterableA);
        $arrayB = self::iterableToArray($iterableB);

        if(count($arrayA) != count($arrayB)) {
            return false;
        }

        return count(array_intersect($arrayA, $arrayB)) === count($arrayA);
    }

    /**
     * Like array_intersect but compares using the === operator (and is thus capable of intersecting arrays of objects).
     *
     * @template T
     * @param iterable<T> $iterableA
     * @param iterable<T> $iterableB
     * @return T[]
     */
    public static function intersect(iterable $iterableA, iterable $iterableB): array {
        return array_uintersect(
            self::iterableToArray($iterableA),
            self::iterableToArray($iterableB),
            fn($objectA, $objectB) => $objectA === $objectB ? 0 : 1
        );
    }

    /**
     * @template T of Stringable
     * @param iterable<T> $items
     * @return string[]
     */
    public static function toString(iterable $items): array {
        $result = [ ];

        foreach($items as $item) {
            $result[] = (string)$item;
        }

        return $result;
    }

    /**
     * @template T
     * @param mixed $needle
     * @param T[] $haystack
     * @return bool
     */
    public static function inArray(mixed $needle, iterable $haystack): bool {
        return in_array($needle, self::iterableToArray($haystack), true);
    }

    /**
     * @template T
     * @param iterable<T> $original
     * @param iterable<T> $remove
     * @return T[]
     */
    public static function remove(iterable $original, iterable $remove): array {
        $result = [ ];

        foreach($original as $enum) {
            foreach($remove as $excludeEnum) {
                if($enum === $excludeEnum) {
                    // exclude $enum from result
                    continue 2;
                }
            }

            $result[] = $enum;
        }

        return $result;
    }
}