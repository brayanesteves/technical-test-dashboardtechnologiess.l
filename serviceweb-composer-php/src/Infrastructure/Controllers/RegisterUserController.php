<?php
    namespace Infrastructure\Controllers;

    use Application\UseCases\RegisterUserUseCase;
    use Application\UseCases\RegisterUserRequest;

    class RegisterUserController {
        private RegisterUserUseCase $useCase;

        public function __construct(RegisterUserUseCase $useCase) {
            $this->useCase = $useCase;
        }

        public function handle(): void {
            $request = json_decode(file_get_contents('php://input'), true);
            $dto = new RegisterUserRequest(
                $request['name'],
                $request['email'],
                $request['password']
            );

            $this->useCase->execute($dto);
            
            header('Content-Type: application/json');
            echo json_encode(['message' => 'User registered successfully']);
        }
    }