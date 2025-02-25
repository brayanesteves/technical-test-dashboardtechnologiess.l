<?php
    namespace Domain\Repositories;

    use Domain\Entities\User;
    use Domain\ValueObjects\UserId;

    interface UserRepositoryInterface {
        public function save(User $user): void;
        public function findById(UserId $id): ?User;
        public function delete(UserId $id): void;
    }