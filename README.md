## 🧩 Información general del proyecto

**Nombre del proyecto:** hs_inventario

**Lenguaje:** PHP 8.3

**Framework:** Laravel 12

**Panel administrativo:** Filament

**Base de datos:** MySQL

**Entorno de desarrollo:** Laravel Sail / XAMPP

**Control de versiones:** Git + GitHub

**Metodología:** Simulación de entorno empresarial (Scrum)

Este sistema tiene como objetivo digitalizar el proceso de arriendo de equipos hidráulicos de la empresa, permitiendo gestionar clientes, contratos y el inventario de equipos. Se desarrolla con **Laravel 12** y **Filament** para la interfaz administrativa.

---

# ETAPA 1:

### 👩‍💻DISEÑO DE BASE DE DATOS

Al principio se creó la Base de Datos para el proyecto con las siguientes tablas:

**Tabla clientes:**

| ID_Clientes | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Empresa | VARCHAR (100) | NN |  |
| Rut | VARCHAR (20) | NN |  |
| Telefono | VARCHAR (20) |  |  |
| Correo | VARCHAR (100) |  |  |
| Direccion | VARCHAR (100) |  |  |
| Ciudad | VARCHAR (200) |  |  |

**Tabla equipos:**

| ID_Equipos | IN | NN |
| --- | --- | --- |
| Nombre_equipos | VARCHAR (100) | NN |
| Descripcion | VARCHAR (255) |  |
| Cantidad_total | INT |  |
| deleted_at | TIMESTAMP |  |

**Tabla arriendos:**

| Contrato | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| ID_Cliente | INT | FK, NN | Apuntando a PK de tabla clientes |
| Fecha_inicio | DATE | NN |  |
| Fecha_fin | DATE | NN |  |
| Guia_Despacho | INT | NN |  |
| Precio_total | DECIMAL (10,2) | NN |  |
| Estado | ENUM (’En curso’, ‘Finalizado’, ‘Cancelado’) | NN |  |
| Observaciones | TEXT |  |  |
| updated_at | DATETIME |  |  |
| created_at | DATETIME |  |  |

**Tabla arriendo_detalle:**

| ID | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Contrato | INT | FK, NN | Apuntando a la PK de tabla arriendos |
| Equipo_id | INT | FK, NN | Apuntando a PK de tabla equipos |
| Equipo_detalle_id | INT | NN |  |
| Estado | ENUM (’En stock’, ‘En arriendo’, ‘Finalizado’) | NN |  |
| Precio_equipo | DECIMAL (15,2) | NN |  |
| Garantia | DECIMAL (15,2) | NN |  |
| created_at | DATETIME |  |  |
| updated_at | DATETIME |  |  |

**Tabla bombas:**

| id | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Id_Equipo | INT | FK, NN | Apuntando al pk de tabla equipos |
| Equipo | VARCHAR (100) | NN |  |
| Marca | VARCHAR (45) |  |  |
| Modelo | VARCHAR (45) |  |  |
| Serie | VARCHAR (45) |  |  |
| Codigo | VARCHAR (20) |  |  |
| Precio | DECIMAL (15,2) | NN |  |
| Garantia | DECIMAL (15,2) | NN |  |
| Estado | ENUM (’En stock’, ‘En arriendo’, ‘En reparacion’, ‘Fuera de servicio’) | NN |  |

**Tabla cabezal:**

| id | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Id_Equipo | INT | FK, NN | Apuntando al pk de tabla equipos |
| Equipo | VARCHAR (100) | NN |  |
| Marca | VARCHAR (45) |  |  |
| Modelo | VARCHAR (20) |  |  |
| Cuadrante | VARCHAR (20) |  |  |
| Serie | VARCHAR (45) |  |  |
| Codigo | VARCHAR (20) |  |  |
| Observacion | VARCHAR (255) |  |  |
| Precio | DECIMAL (15,2) | NN |  |
| Garantia | DECIMAL (15,2) | NN |  |
| Estado | ENUM (’En stock’, ‘En arriendo’, ‘En reparacion’, ‘Fuera de servicio’) | NN |  |

**Tabla cilindros:**

| id | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Id_Equipo | INT | FK, NN | Apuntando al pk de tabla equipos |
| Equipo | VARCHAR (100) | NN |  |
| Marca | VARCHAR (45) |  |  |
| Modelo | VARCHAR (45) |  |  |
| Accion | ENUM ('Simple', 'Doble') |  |  |
| Toneladas | INT |  |  |
| Altura | VARCHAR (20) |  |  |
| Carrera | VARCHAR (20) |  |  |
| Codigo | VARCHAR (50) | NN |  |
| Precio | DECIMAL (15,2) | NN |  |
| Garantia | DECIMAL (15,2) | NN |  |
| Estado | ENUM (’En stock’, ‘En arriendo’, ‘En reparacion’, ‘Fuera de servicio’) | NN |  |

**Tabla dados:**

| id | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Id_Equipo | INT | FK, NN | Apuntando al pk de tabla equipos |
| Equipo | VARCHAR (100) | NN |  |
| Medida | VARCHAR (20) |  |  |
| Cuadrante | VARCHAR (20) |  |  |
| Cantidad_disponible | INT |  |  |
| Cantidad_arriendo | INT | NN |  |
| Precio | DECIMAL (15,2) | NN |  |
| Garantia | DECIMAL (15,2) | NN |  |

**Tabla Pistolas:**

| id | INT | PK, NN, AI |  |
| --- | --- | --- | --- |
| Id_equipo | INT | FK, NN | Apuntando al pk de tabla equipos |
| Equipo | VARCHAR (100) | NN |  |
| Descripcion | VARCHAR (255) |  |  |
| Marca | VARCHAR (45) |  |  |
| Modelo | VARCHAR (45) |  |  |
| Serie | VARCHAR (45) |  |  |
| Codigo | VARCHAR (45) |  |  |
| Observacion | VARCHAR (255) |  |  |
| Precio | DECIMAL (15,2) | NN |  |
| Garantia | DECIMAL (15,2) | NN |  |
| Estado | ENUM (’En stock’, ‘En arriendo’, ‘En reparacion’, ‘Fuera de servicio’) | NN |  |

---

# ETAPA 2:

### ⚙️CREACION DEL PROYECTO LARAVEL

Después de definir las tablas, se creó el proyecto base con:

-laravel new hs_inventario

-Configuración de conexión a la base de datos en ‘.env’

-Ejecución de migraciones con ‘php artisan migrate’

---

# ETAPA 3:

### ⚙️CREACIÓN DE MODELOS Y RELACIONES

| Modelo | Relación | Descripción |
| --- | --- | --- |
| Cliente | hasMany(Arriendo) | Un cliente puede tener varios contratos. |
| Arriendo | belongsTo(Cliente) | Cada arriendo pertenece a un cliente. |
| Arriendo | hasMany(ArriendoDetalle) | Un contrato puede incluir varios equipos. |
| Equipo | hasMany(ArriendoDetalle) | Un equipo puede estar en varios contratos. |
| ArriendoDetalle | belongsTo(Arriendo) / belongsTo(Equipo) | Define los equipos incluidos en cada contrato. |
| TipoEquipo (Bombas, Cabezales, etc.) | hasMany(Equipo) | Cada tipo agrupa múltiples equipos individuales. |

---

# ETAPA 4:

### ⚙️IMPLEMENTACIÓN DE FILAMENT

Filament se utiliza como **interfaz administrativa** para la gestión de datos.

Cada recurso (`Resource`) incluye:

- Un formulario de creación/edición (`Form`)
- Una tabla de listado (`Table`)
- Relaciones entre entidades (por ejemplo, `Arriendo` muestra los `ArriendoDetalle` asociados)

Además, se personalizaron columnas, filtros y relaciones para facilitar la administración de los equipos.

Se instalaron los paquetes:

-composer require filament/filament

Se generaron los recursos:

-php artisan make:filament-resource Clientes

-php artisan make:filament-resource Equipos

-php artisan make:filament-resource Bombas

-php artisan make:filament-resource Cabezales

-php artisan make:filament-resource Cilindros

-php artisan make:filament-resource Dados

-php artisan make:filament-resource Pistolas

-php artisan make:filament-resource Arriendos

Cada recurso gestiona el CRUD de su respectivo modelo dentro del panel de administración

---

# ⚙️ Instalación y Configuración — Sistema de Arriendos Hidráulicos

## 🔧 Requisitos previos

Antes de comenzar con la instalación del proyecto, asegúrate de tener instalado lo siguiente:

- **PHP 8.2** o superior
- **Composer** (para la gestión de dependencias de Laravel)
- **Node.js** y **NPM** (para la compilación de recursos front-end)
- **MySQL** o **MariaDB**
- **Servidor local** (XAMPP, Laragon o WAMP recomendado)
- **Git** (para clonar el repositorio)

---

## 📂 Clonar el repositorio

Clona el proyecto desde GitHub y entra a la carpeta del sistema:

```bash
git clone <https://github.com/Francisco-Jara-v/hs_inventario>
cd hs_inventario
```

## 📦 Instalar dependencias de Laravel

Instala las dependencias del backend con Composer:

```bash
composer install

```

---

## 🧰 Instalar dependencias del front-end

Instala las dependencias de JavaScript y compila los recursos:

```bash
npm install
npm run build

```

---

## ⚙️ Configuración del entorno

Copia el archivo de entorno de ejemplo y renómbralo:

```bash
cp .env.example .env

```

Luego abre el archivo `.env` con tu editor de texto y configura las variables de entorno según tu entorno local:

```
APP_NAME="Sistema de Arriendos Hidráulicos"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arriendos_hidraulicos
DB_USERNAME=root
DB_PASSWORD=

# Filament Admin Panel
FILAMENT_PATH=/admin

```

Genera la clave de aplicación:

```bash
php artisan key:generate

```

---

## 🗄️ Migrar y sembrar la base de datos

Ejecuta las migraciones para crear las tablas necesarias:

```bash
php artisan migrate --seed

```

Esto creará todas las tablas y cargará los datos iniciales si existen seeders configurados.

---

## 🔑 Crear usuario administrador (si no existe)

Si el usuario administrador no se creó automáticamente, puedes generarlo con:

```bash
php artisan make:filament-user

```

Completa los datos en consola:

- **Nombre:** Administrador
- **Correo:** admin@arriendos.cl
- **Contraseña:** (elige una segura)

---

## ▶️ Iniciar el servidor de desarrollo

Inicia el servidor local de Laravel con:

```bash
php artisan serve

```

Luego abre tu navegador en:

```
http://localhost:8000/admin

```

---

## 🧱 Acceso al panel administrativo (Filament)

Accede al panel de administración con tus credenciales.

Si utilizas el seeder o el usuario creado manualmente, los datos de ejemplo son:

- **Usuario:** admin@arriendos.cl
- **Contraseña:** password

---

## 🧩 Tecnologías utilizadas

| Categoría | Herramienta |
| --- | --- |
| Framework Backend | Laravel 11 |
| Panel Administrativo | FilamentPHP |
| Interactividad | Livewire |
| Estilos | Tailwind CSS |
| Base de Datos | MySQL |
| Lenguaje | PHP 8.2 |
| Gestor de Dependencias | Composer |
| Frontend Build | Node.js / NPM |

---

## 🧠 Notas adicionales

- Si realizas cambios en el front-end, recuerda recompilar los assets con:
    
    ```bash
    npm run build
    
    ```
    
- Si agregas nuevas migraciones, ejecútalas con:
    
    ```bash
    php artisan migrate
    
    ```
    
- En caso de errores de caché, limpia la configuración:
    
    ```bash
    php artisan optimize:clear
    
    ```
    

---

## 🚀 Estado del Proyecto

✅ Proyecto en desarrollo avanzado

✅ CRUDs principales implementados (Clientes, Equipos, Arriendos)

🚧 En proceso: optimización de recursos y mejoras en el flujo de arriendos

📅 Última actualización: **11 de noviembre de 2025**

# 

---

> 🗓️ Última actualización: 11 de noviembre de 2025
> 
> 
> ✍️ **Autor:** Francisco Jara
> 
> 💻 **Rol:** Técnico en Informática / Desarrollador Full Stack (en formación)
>
