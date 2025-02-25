# Technical Test - Dashboard Technologies

Este proyecto es una solución a una prueba técnica en PHP que implementa un sistema de registro de usuarios siguiendo los principios de **Domain-Driven Design (DDD)**, **Clean Architecture**, y el patrón **Ports and Adapters**. Utiliza Doctrine para la persistencia de datos y PHPUnit para pruebas automatizadas.

Repositorio: [https://github.com/brayanesteves/technical-test-dashboardtechnologiess.l](https://github.com/brayanesteves/technical-test-dashboardtechnologiess.l)

## Requisitos Previos

### Para Docker
- [Docker](https://www.docker.com/get-started) y [Docker Compose](https://docs.docker.com/compose/install/) instalados.

### Para Ejecución Local
- PHP 8.2 o superior.
- MySQL 5.7 o superior.
- [Composer](https://getcomposer.org/download/).
- Opcional: [Postman](https://www.postman.com/downloads/) para pruebas manuales.

## Estructura del Proyecto

```
serviceweb-composer-php/
├── docker/                # Configuración de Docker
│   └── php/
│       └── Dockerfile     # Dockerfile para el contenedor PHP
├── public/                # Punto de entrada HTTP
│   └── index.php          # Controlador principal
├── src/                   # Código fuente
│   ├── Application/       # Casos de uso y listeners
│   ├── Domain/            # Lógica del dominio (entidades, eventos, repositorios, value objects)
│   ├── Infrastructure/    # Implementaciones específicas (controladores, persistencia)
│   └── Shared/            # Utilidades compartidas
├── tests/                 # Pruebas unitarias y de integración
│   ├── Integration/       # Pruebas de integración
│   └── Unit/              # Pruebas unitarias
├── composer.json          # Dependencias del proyecto
├── docker-compose.yml     # Configuración de Docker Compose
├── Makefile               # Comandos rápidos
└── phpunit.xml            # Configuración de PHPUnit
```

## Instalación y Ejecución

### Opción 1: Usando Docker

1. **Clonar el Repositorio**
   ```bash
   git clone https://github.com/brayanesteves/technical-test-dashboardtechnologiess.l.git
   cd serviceweb-composer-php
   ```

2. **Construir e Iniciar los Contenedores**
   ```bash
   make setup
   ```
   Esto:
   - Construye las imágenes Docker.
   - Inicia los servicios (PHP y MySQL).
   - Instala las dependencias de Composer.
   - Crea el esquema de la base de datos.

3. **Acceder a la Aplicación**
   La aplicación estará disponible en `http://localhost:8000/index.php`.

4. **Detener los Contenedores**
   ```bash
   make down
   ```

### Opción 2: Ejecución Local

1. **Clonar el Repositorio**
   ```bash
   git clone https://github.com/brayanesteves/technical-test-dashboardtechnologiess.l.git
   cd serviceweb-composer-php
   ```

2. **Instalar Dependencias**
   ```bash
   composer install
   ```

3. **Configurar la Base de Datos**
   - Crea una base de datos MySQL: `CREATE DATABASE test_db;`
   - Edita `src/Infrastructure/Persistence/DoctrineConfig.php` con tus credenciales locales:
     ```php
     $conn = [
         'driver' => 'pdo_mysql',
         'host' => 'localhost',
         'dbname' => 'test_db',
         'user' => 'tu_usuario',
         'password' => 'tu_contraseña',
         'charset' => 'utf8mb4',
     ];
     ```
   - Genera el esquema:
     ```bash
     php vendor/bin/doctrine orm:schema-tool:update --force
     ```

4. **Iniciar el Servidor**
   ```bash
   php -S localhost:8000 -t public
   ```
   La aplicación estará disponible en `http://localhost:8000/index.php`.

## Uso

### Registrar un Usuario
La aplicación expone un endpoint para registrar usuarios mediante una solicitud POST.

#### Ejemplo de Solicitud (usando Postman o cURL)
- **URL**: `http://localhost:8000/index.php`
- **Método**: `POST`
- **Headers**: `Content-Type: application/json`
- **Body** (JSON):
  ```json
  {
      "name": "John Doe",
      "email": "john@example.com",
      "password": "Password123!"
  }
  ```

#### Respuesta Exitosa
- **Código**: `200 OK`
- **Body**:
  ```json
  {"message": "User registered successfully"}
  ```

#### Respuestas de Error
- **Email inválido**: `400 Bad Request` - `{"error": "Invalid email format"}`
- **Contraseña débil**: `400 Bad Request` - `{"error": "Password must be at least 8 characters with uppercase, number, and special character"}`
- **Email duplicado**: `409 Conflict` - `{"error": "User already exists"}`

#### Probar con cURL
```bash
curl -X POST http://localhost:8000/index.php \
-H "Content-Type: application/json" \
-d '{"name":"John Doe","email":"john@example.com","password":"Password123!"}'
```

## Pruebas Automatizadas

### Ejecutar Pruebas con Docker
```bash
make test
```

### Ejecutar Pruebas Localmente
```bash
vendor/bin/phpunit
```

Esto ejecuta todas las pruebas unitarias (entidades, Value Objects, casos de uso) y de integración (repositorio con Doctrine).

## Comandos del Makefile

- `make setup`: Configura e inicia el entorno Docker.
- `make build`: Construye las imágenes Docker.
- `make up`: Inicia los contenedores en segundo plano.
- `make down`: Detiene y elimina los contenedores.
- `make test`: Ejecuta las pruebas automatizadas.
- `make db-schema`: Actualiza el esquema de la base de datos.

## Detalles Técnicos

- **PHP**: 8.2
- **Base de Datos**: MySQL (Docker) o SQLite (pruebas de integración)
- **Dependencias**: Doctrine ORM, Ramsey UUID, PHPUnit
- **Patrones**: DDD, Clean Architecture, Ports and Adapters
- **Pruebas**: Unitarias (PHPUnit) y de integración con Doctrine

## Contribuciones

Si deseas contribuir, por favor:
1. Haz un fork del repositorio.
2. Crea una rama para tu cambio (`git checkout -b feature/nueva-funcionalidad`).
3. Envía un pull request.

## Licencia

Este proyecto no tiene una licencia específica definida.

---