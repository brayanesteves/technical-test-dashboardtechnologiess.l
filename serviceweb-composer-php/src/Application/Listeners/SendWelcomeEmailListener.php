<?php
    namespace Application\Listeners;

    use Domain\Events\UserRegisteredEvent;

    class SendWelcomeEmailListener {
        public function handle(UserRegisteredEvent $event): void {
            // Simulación de envío de email
            echo "Sending welcome email to user with ID: " . $event->userId()->value() . "\n";
        }
    }