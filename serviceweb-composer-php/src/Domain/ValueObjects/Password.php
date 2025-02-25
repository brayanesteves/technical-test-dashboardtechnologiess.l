<?php
    namespace Domain\ValueObjects;

    use InvalidArgumentException;

    class Password {
        private string $value;

        public function __construct(string $value) {
            if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/', $value)) {
                throw new InvalidArgumentException("Password must be at least 8 characters with uppercase, number, and special character");
            }
            $this->value = password_hash($value, PASSWORD_BCRYPT);
        }

        public function value(): string {
            return $this->value;
        }

        public function verify(string $plainPassword): bool {
            return password_verify($plainPassword, $this->value);
        }
    }