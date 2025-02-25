<?php
    namespace Tests\Integration\Persistence;

    use Domain\Entities\User;
    use Domain\ValueObjects\UserId;
    use Domain\ValueObjects\Email;
    use Domain\ValueObjects\Password;
    use Infrastructure\Persistence\DoctrineUserRepository;
    use Infrastructure\Persistence\DoctrineConfig;
    use PHPUnit\Framework\TestCase;

    class DoctrineUserRepositoryTest extends TestCase {
        private $em;
        private DoctrineUserRepository $repository;

        protected function setUp(): void {
            $this->em = DoctrineConfig::createEntityManager('test');
            $this->repository = new DoctrineUserRepository($this->em);
            $this->em->getConnection()->executeStatement('DELETE FROM users'); // Limpia la tabla
        }

        protected function tearDown(): void {
            $this->em->close();
        }

        public function testCanSaveAndRetrieveUser(): void {
            $user = new User(
                new UserId('123e4567-e89b-12d3-a456-426614174000'),
                'John Doe',
                new Email('john@example.com'),
                new Password('Password123!')
            );

            $this->repository->save($user);
            $retrieved = $this->repository->findById(new UserId('123e4567-e89b-12d3-a456-426614174000'));

            $this->assertNotNull($retrieved);
            $this->assertEquals('john@example.com', $retrieved->email()->value());
        }
    }