# 🧰 Sistema de Arriendo Hidráulico

Aplicación web desarrollada con **Laravel 10** y **FilamentPHP**, diseñada para gestionar el arriendo de equipos hidráulicos, clientes y contratos dentro de una empresa del rubro.

Este sistema surge como una solución a la falta de control en los contratos y el inventario de equipos, reemplazando procesos manuales en Word por una plataforma digital centralizada.

---

## 🚀 Características principales

- 📦 **Gestión de equipos**: registro, edición y control de disponibilidad.
- 👥 **Gestión de clientes**: administración completa de clientes y datos de contacto.
- 📄 **Contratos de arriendo**: generación automática de contratos vinculando cliente y equipos.
- 📊 **Reportes**: visualización de equipos arrendados por mes o año.
- 🔐 **Control de acceso** (en desarrollo): roles y permisos de usuarios.
- 🧾 **Exportación PDF** (pendiente): para contratos y reportes.

---

## ⚙️ Tecnologías utilizadas

| Tipo | Tecnología |
|------|-------------|
| Backend | Laravel 10 (PHP 8.x) |
| Frontend | FilamentPHP + Tailwind CSS |
| Base de datos | MySQL |
| ORM | Eloquent |
| Control de versiones | Git + GitHub |
| Entorno local | XAMPP |
| Documentación | Notion |
| Gestión de tareas | Trello (Kanban) |

---

## 🧱 Arquitectura

El sistema está basado en la arquitectura **MVC (Modelo-Vista-Controlador)**.

/app
├── Http/
│ ├── Controllers/ → Controladores del sistema
│ └── Middleware/
├── Models/ → Modelos Eloquent
/database
├── migrations/ → Migraciones de las tablas
/resources
├── views/ → Vistas Blade y componentes Filament
/routes
└── web.php → Definición de rutas

---

## 🗃️ Estructura de la base de datos

| Tabla | Descripción |
|--------|--------------|
| `clientes` | Almacena datos de clientes. |
| `equipos` | Registra los equipos hidráulicos. |
| `tipos_equipos` | Clasificación de equipos (bomba, cilindro, etc.). |
| `arriendos` | Contratos que vinculan cliente y equipos. |
| `users` | Usuarios del sistema (rol administrador o técnico). |

**Relaciones principales:**

---

## 📅 Estado del proyecto

| Fase | Estado |
|------|--------|
| Diseño de base de datos | ✅ Completado |
| CRUD de clientes | ✅ Listo |
| CRUD de equipos | ✅ Listo |
| Módulo de arriendos | 🧩 En desarrollo |
| Control de roles y usuarios | 🕐 Pendiente |
| Reportes y PDFs | 🕐 Pendiente |

---

## 🧠 Objetivo del proyecto

Este proyecto fue desarrollado con un enfoque **educativo y profesional**, para:
1. Mejorar los procesos de control de arriendo en la empresa.
2. Servir como práctica real de desarrollo con Laravel.
3. Aplicar herramientas de trabajo en equipo (Git, Trello, Notion).

---

## 📘 Documentación

Toda la documentación técnica del proyecto (arquitectura, base de datos, bitácora y tareas) se encuentra en **Notion**.

> 🔗 *(Puedes agregar aquí el enlace público a tu Notion si lo haces visible)*  
> Ejemplo: [Documentación del proyecto en Notion](https://www.notion.so/...)

---

## 🧩 Metodología de trabajo

El desarrollo se organiza con la metodología **Kanban**, utilizando **Trello** para la gestión de tareas y **GitHub** para el control de versiones.

Flujo de trabajo:
1. Crear tarea en Trello.  
2. Crear rama de desarrollo en Git (`feature/nombre-tarea`).  
3. Desarrollar y hacer commit.  
4. Hacer merge con la rama principal (`main`) al completar.  

---

## 👤 Autor

**Chito**  
_Técnico en Informática — Desarrollador en formación_  

📧 [Agrega tu correo o LinkedIn si quieres]  
💻 [Tu GitHub Profile URL]

---

## ⚖️ Licencia

© 2025 Chito.  
Este proyecto fue desarrollado con fines educativos y de demostración.  
No se permite su uso comercial sin autorización expresa del autor.

