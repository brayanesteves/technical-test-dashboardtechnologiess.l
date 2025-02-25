<?php
    namespace Application\UseCases;

    use Domain\Entities\User;
    use Domain\Repositories\UserRepositoryInterface;
    use Domain\ValueObjects\UserId;
    use Domain\ValueObjects\Email;
    use Domain\ValueObjects\Password;
    use Domain\Events\UserRegisteredEvent;

    class RegisterUserUseCase {
        private UserRepositoryInterface $userRepository;
        private EventDispatcher $eventDispatcher;

        public function __construct(UserRepositoryInterface $userRepository, EventDispatcher $eventDispatcher) {
        $this->userRepository = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->eventDispatcher->addListener(
            UserRegisteredEvent::class,
            [new SendWelcomeEmailListener(), 'handle']
        );
    }

        public function execute(RegisterUserRequest $request): void {
            $email = new Email($request->email);
            if ($this->userRepository->findByEmail($email)) {
                throw new UserAlreadyExistsException();
            }

            $user = new User(
                new UserId(),
                $request->name,
                $email,
                new Password($request->password)
            );

            $this->userRepository->save($user);
            $this->eventDispatcher->dispatch(new UserRegisteredEvent($user->id()));
        }
    }