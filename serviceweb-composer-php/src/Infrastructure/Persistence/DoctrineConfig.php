<?php
    namespace Infrastructure\Persistence;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Tools\Setup;

    class DoctrineConfig {
        public static function createEntityManager(string $env = 'dev'): EntityManager {
            $config = Setup::createAnnotationMetadataConfiguration(
                [__DIR__ . '/../../Domain/Entities'],
                $env === 'dev',
                null,
                null,
                false
            );

            $conn = $env === 'test' ? [
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '/../../../test_db.sqlite',
            ] : [
                'driver' => 'pdo_mysql',
                'host' => 'db',
                'dbname' => 'test_db',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'utf8mb4',
            ];

            return EntityManager::create($conn, $config);
        }
    }