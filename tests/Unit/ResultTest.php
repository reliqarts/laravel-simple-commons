<?php

declare(strict_types=1);

namespace ReliqArts\Tests\Unit;

use Exception;
use ReliqArts\Result;
use ReliqArts\Tests\TestCase;

/**
 * Class ResultTest.
 *
 * @coversDefaultClass \ReliqArts\Result
 *
 * @internal
 */
final class ResultTest extends TestCase
{
    /**
     * @var Result
     */
    private Result $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Result();
    }

    /**
     * @throws Exception
     */
    public function testInitialState(): void
    {
        $result = $this->subject;

        $this->assertTrue($result->isSuccess());
        $this->assertEmpty($result->getError());
        $this->assertEmpty($result->getMessages());
    }

    /**
     * @throws Exception
     */
    public function testErrorResult(): void
    {
        $error = 'My error';
        $result = $this->subject->setError($error);

        $this->assertFalse($result->isSuccess());
        $this->assertSame($error, $result->getError());
    }

    /**
     * @throws Exception
     */
    public function testResultWithMessages(): void
    {
        $messages = ['hi', 'hello'];
        $result = $this->subject->setMessages(...$messages);

        $this->assertTrue($result->isSuccess());
        $this->assertSame($messages[0], $result->getMessage());
        $this->assertSame($messages, $result->getMessages());
    }

    /**
     * @throws Exception
     */
    public function testResultIsProperlySerializable(): void
    {
        $serializedResult = $this->subject->jsonSerialize();

        $this->assertArrayHasKey('success', $serializedResult);
        $this->assertArrayHasKey('error', $serializedResult);
        $this->assertArrayHasKey('messages', $serializedResult);
        $this->assertArrayHasKey('extra', $serializedResult);
    }
}