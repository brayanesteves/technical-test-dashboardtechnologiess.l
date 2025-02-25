<?php
    namespace Tests\Integration\Controllers;

    use Application\UseCases\RegisterUserUseCase;
    use Infrastructure\Controllers\RegisterUserController;
    use PHPUnit\Framework\TestCase;

    class RegisterUserControllerTest extends TestCase {
        public function testHandleReturnsJsonResponse(): void {
            $useCase = $this->createMock(RegisterUserUseCase::class);
            $controller = new RegisterUserController($useCase);

            // Simula entrada HTTP
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $input = ['name' => 'John', 'email' => 'john@example.com', 'password' => 'Password123!'];
            $GLOBALS['php://input'] = json_encode($input);

            ob_start();
            $controller->handle();
            $output = ob_get_clean();

            $this->assertJsonStringEqualsJsonString(
                '{"message": "User registered successfully"}',
                $output
            );
        }
    }