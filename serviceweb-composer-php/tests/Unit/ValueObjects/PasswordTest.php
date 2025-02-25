<?php
    namespace Tests\Unit\ValueObjects;

    use Domain\ValueObjects\Password;
    use PHPUnit\Framework\TestCase;

    class PasswordTest extends TestCase {
        public function testValidPassword(): void {
            $password = new Password('Password123!');
            $this->assertTrue(password_verify('Password123!', $password->value()));
        }

        public function testWeakPasswordThrowsException(): void {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage('Password must be at least 8 characters with uppercase, number, and special character');
            new Password('weak');
        }
    }