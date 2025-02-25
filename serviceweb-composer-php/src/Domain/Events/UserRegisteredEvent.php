<?php
    namespace Domain\Events;

    use Domain\ValueObjects\UserId;

    class UserRegisteredEvent {
        private UserId $userId;

        public function __construct(UserId $userId) {
            $this->userId = $userId;
        }

        public function userId(): UserId {
            return $this->userId;
        }
    }