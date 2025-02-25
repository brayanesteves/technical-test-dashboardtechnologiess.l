<?php
    namespace Tests\Unit\ValueObjects;

    use Domain\ValueObjects\Email;
    use PHPUnit\Framework\TestCase;

    class EmailTest extends TestCase {
        public function testValidEmail(): void {
            $email = new Email('test@example.com');
            $this->assertEquals('test@example.com', $email->value());
        }

        public function testInvalidEmailThrowsException(): void {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage('Invalid email format');
            new Email('invalid-email');
        }
    }