<?php
    namespace Tests\Unit\Entities;

    use Domain\Entities\User;
    use Domain\ValueObjects\UserId;
    use Domain\ValueObjects\Email;
    use Domain\ValueObjects\Password;
    use PHPUnit\Framework\TestCase;

    class UserTest extends TestCase {
        public function testCanCreateUser(): void {
            $user = new User(
                new UserId('123e4567-e89b-12d3-a456-426614174000'),
                'John Doe',
                new Email('john@example.com'),
                new Password('Password123!')
            );

            $this->assertEquals('123e4567-e89b-12d3-a456-426614174000', $user->id()->value());
            $this->assertEquals('John Doe', $user->name());
            $this->assertEquals('john@example.com', $user->email()->value());
            $this->assertInstanceOf(\DateTimeImmutable::class, $user->createdAt());
        }
    }