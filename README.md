# Webhook para observar mensajes entrantes de WhatsApp

API REST desarrollada en **Laravel 12** que actúa como webhook para la API de WhatsApp Business (Meta). Permite recibir, almacenar y gestionar mensajes entrantes de WhatsApp organizados por empresa, cuenta y número de teléfono.

## ¿Qué hace este proyecto?

- **Verificación del webhook**: responde al handshake de Meta para activar la suscripción al webhook de WhatsApp.
- **Recepción de mensajes**: recibe eventos entrantes (texto, imagen, audio, video, documento, ubicación, contactos) desde la API de WhatsApp Cloud.
- **Gestión multi-empresa**: cada empresa tiene su propia configuración de Meta App, cuentas de WhatsApp y números asociados.
- **Almacenamiento de chats y mensajes**: persiste conversaciones y mensajes en base de datos para su consulta posterior.
- **Autenticación**: gestión de usuarios y tokens de acceso personal mediante Laravel Sanctum.

## Requisitos

- PHP >= 8.2
- Composer
- MySQL
- Una cuenta de Meta for Developers con una aplicación de WhatsApp Business configurada

## Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd wapphook-backend
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar variables de entorno

```bash
cp env.txt .env
```

Edita el archivo `.env` y ajusta los siguientes valores:

```env
APP_URL=https://tu-dominio.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=whatsapp_webhook
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones

```bash
php artisan migrate
```

### 6. (Opcional) Poblar la base de datos con datos de prueba

```bash
php artisan db:seed
```

### 7. Iniciar el servidor de desarrollo

```bash
php artisan serve
```

## Endpoints del webhook

| Método | Ruta | Descripción |
|--------|------|-------------|
| `GET` | `/webhook/{company_id}` | Verificación del webhook por parte de Meta |
| `POST` | `/webhook/{company_id}` | Recepción de eventos/mensajes de WhatsApp |

> El parámetro `{company_id}` identifica a qué empresa pertenece el webhook configurado en Meta.

## Configuración en Meta for Developers

1. Crea una aplicación de tipo **Business** en [Meta for Developers](https://developers.facebook.com).
2. Agrega el producto **WhatsApp** a la aplicación.
3. En la sección **Webhook**, configura:
   - **URL de callback**: `https://tu-dominio.com/webhook/{company_id}`
   - **Token de verificación**: el token definido en la base de datos para esa empresa.
4. Suscríbete al campo `messages` para recibir mensajes entrantes.

## Estructura principal

```
app/
├── Http/
│   ├── Controllers/     # Controladores REST (Webhook, Auth, Empresas, Mensajes...)
│   └── Middleware/      # Middleware de validación del webhook
├── Models/              # Modelos Eloquent (Company, WhatsappAccount, WhatsappNumber, WhatsappChat, WhatsappMessage...)
├── Services/            # Lógica de negocio separada por dominio
├── Repositories/        # Capa de acceso a datos
└── Routes/              # Definición de rutas del webhook
```

## Licencia

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT).
