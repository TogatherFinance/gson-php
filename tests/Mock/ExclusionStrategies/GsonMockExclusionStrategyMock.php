<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Gson\Test\Mock\ExclusionStrategies;

use Tebru\Gson\ClassMetadata;
use Tebru\Gson\ClassMetadataVisitor;
use Tebru\Gson\ExclusionData;
use Tebru\Gson\ExclusionStrategy;
use Tebru\Gson\PropertyMetadata;
use Tebru\Gson\Test\Mock\GsonMock;

/**
 * Class GsonMockExclusionStrategyMock
 *
 * @author Nate Brunette <n@tebru.net>
 */
class GsonMockExclusionStrategyMock implements ExclusionStrategy, ClassMetadataVisitor
{
    public $skipProperty = true;

    /**
     * Return true if the class should be ignored
     *
     * @param ClassMetadata $classMetadata
     * @param ExclusionData $exclusionData
     * @return bool
     */
    public function shouldSkipClass(ClassMetadata $classMetadata, ExclusionData $exclusionData): bool
    {
        return false;
    }

    /**
     * Return true if the property should be ignored
     *
     * @param PropertyMetadata $propertyMetadata
     * @param ExclusionData $exclusionData
     * @return bool
     */
    public function shouldSkipProperty(PropertyMetadata $propertyMetadata, ExclusionData $exclusionData): bool
    {
        if (false === $this->skipProperty) {
            return false;
        }

        return $propertyMetadata->getDeclaringClassName() === GsonMock::class
            && $propertyMetadata->getName() === 'excludeFromStrategy';
    }

    /**
     * Handle the class or property metadata
     *
     * @param ClassMetadata $classMetadata
     */
    public function onLoaded(ClassMetadata $classMetadata): void
    {
        $property = $classMetadata->getProperty('excludeFromStrategy');
        if ($property === null) {
            return;
        }

        $property->setSkipSerialize(true)->setSkipDeserialize(true);
    }
}
