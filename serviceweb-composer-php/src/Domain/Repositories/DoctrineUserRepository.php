<?php
    namespace Infrastructure\Persistence;

    use Domain\Entities\User;
    use Domain\Repositories\UserRepositoryInterface;
    use Domain\ValueObjects\UserId;
    use Doctrine\ORM\EntityManagerInterface;

    class DoctrineUserRepository implements UserRepositoryInterface {
        private EntityManagerInterface $em;

        public function __construct(EntityManagerInterface $em) {
            $this->em = $em;
        }

        public function save(User $user): void {
            $this->em->persist($user);
            $this->em->flush();
        }

        public function findById(UserId $id): ?User {
            return $this->em->find(User::class, $id->value());
        }

        public function delete(UserId $id): void {
            $user = $this->findById($id);
            if ($user) {
                $this->em->remove($user);
                $this->em->flush();
            }
        }
    }