<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Infrastructure\Controllers\RegisterUserController;
    use Application\UseCases\RegisterUserUseCase;
    use Infrastructure\Persistence\DoctrineUserRepository;
    use Infrastructure\Persistence\DoctrineConfig;
    use Shared\EventDispatcher;

    // Configurar dependencias
    $em = DoctrineConfig::createEntityManager();
    $repository = new DoctrineUserRepository($em);
    $dispatcher = new EventDispatcher();
    $useCase = new RegisterUserUseCase($repository, $dispatcher);
    $controller = new RegisterUserController($useCase);

    // Manejar la solicitud
    $controller->handle();