<?php
    namespace Domain\Entities;

    use Domain\ValueObjects\UserId;
    use Domain\ValueObjects\Email;
    use Domain\ValueObjects\Password;
    use Doctrine\ORM\Mapping as ORM;
    use DateTimeImmutable;

    /**
     * @ORM\Entity
     * @ORM\Table(name="users")
     */
    class User {
        /**
         * @ORM\Id
         * @ORM\Column(type="string")
         */
        private string $id;

        /**
         * @ORM\Column(type="string", length=100)
         */
        private string $name;

        /**
         * @ORM\Column(type="string", unique=true)
         */
        private string $email;

        /**
         * @ORM\Column(type="string")
         */
        private string $password;

        /**
         * @ORM\Column(type="datetime_immutable")
         */
        private DateTimeImmutable $createdAt;

        public function __construct(UserId $id, string $name, Email $email, Password $password) {
            $this->id = $id->value();
            $this->name = $name;
            $this->email = $email->value();
            $this->password = $password->value();
            $this->createdAt = new DateTimeImmutable();
        }

        // Getters
        public function id(): UserId { return new UserId($this->id); }
        public function email(): Email { return new Email($this->email); }
        public function name(): string { return $this->name; }
        public function password(): Password { return new Password($this->password); }
        public function createdAt(): DateTimeImmutable { return $this->createdAt; }
    }