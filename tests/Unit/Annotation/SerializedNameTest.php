<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

namespace Tebru\Gson\Test\Unit\Annotation;

use LogicException;
use PHPUnit_Framework_TestCase;
use Tebru\Gson\Annotation\SerializedName;

/**
 * Class SerializedNameTest
 *
 * @author Nate Brunette <n@tebru.net>
 */
class SerializedNameTest extends PHPUnit_Framework_TestCase
{
    public function testCreateAnnotation()
    {
        $annotation = new SerializedName(['value' => 'test']);

        self::assertSame('test', $annotation->getName());
    }

    public function testCreateThrowsException()
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('@SerializedName annotation must specify a name as the first argument');

        new SerializedName([]);
    }
}
