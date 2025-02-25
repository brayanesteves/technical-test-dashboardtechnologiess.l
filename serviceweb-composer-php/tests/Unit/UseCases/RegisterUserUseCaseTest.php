<?php
    namespace Tests\Unit\UseCases;

    use Application\UseCases\RegisterUserUseCase;
    use Application\UseCases\RegisterUserRequest;
    use Domain\Repositories\UserRepositoryInterface;
    use Domain\ValueObjects\UserId;
    use Shared\EventDispatcher;
    use PHPUnit\Framework\TestCase;
    use PHPUnit\Framework\MockObject\MockObject;

    class RegisterUserUseCaseTest extends TestCase {
        private UserRepositoryInterface|MockObject $repository;
        private EventDispatcher|MockObject $dispatcher;
        private RegisterUserUseCase $useCase;

        protected function setUp(): void {
            $this->repository = $this->createMock(UserRepositoryInterface::class);
            $this->dispatcher = $this->createMock(EventDispatcher::class);
            $this->useCase = new RegisterUserUseCase($this->repository, $this->dispatcher);
        }

        public function testCanRegisterUser(): void {
            $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Password123!');
            $this->repository->method('findByEmail')->willReturn(null);
            $this->repository->expects($this->once())->method('save');
            $this->dispatcher->expects($this->once())->method('dispatch');

            $this->useCase->execute($request);
            $this->assertTrue(true); // Si no hay excepciones, pasa
        }

        public function testThrowsExceptionIfEmailExists(): void {
            $request = new RegisterUserRequest('John Doe', 'john@example.com', 'Password123!');
            $this->repository->method('findByEmail')->willReturn(new \Domain\Entities\User(
                new UserId(),
                'Existing User',
                new Email('john@example.com'),
                new Password('Password123!')
            ));

            $this->expectException(\UserAlreadyExistsException::class);
            $this->useCase->execute($request);
        }
    }