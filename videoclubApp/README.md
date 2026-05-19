# 🎬 VideoClub App — Gestión de Videoclub con Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![TMDB](https://img.shields.io/badge/API-TMDB-01B4E4?style=flat-square&logo=themoviedatabase&logoColor=white)
![Status](https://img.shields.io/badge/Status-Academic%20Project-blue?style=flat-square)

> Aplicación web completa desarrollada con **Laravel** que simula las gestiones más comunes de un videoclub — reservas, cartelera, comentarios y panel de administración — con integración automática de carátulas vía **TMDB API**.

---

## 📋 Descripción

VideoClub App es una aplicación fullstack construida sobre el ecosistema Laravel que cubre tanto la experiencia del usuario final como la gestión administrativa completa. Destaca por su integración con la API de **The Movie Database (TMDB)**, que permite al administrador añadir películas sin necesidad de subir manualmente la carátula — el sistema la obtiene y almacena automáticamente.

---

## ⚙️ Tecnologías

| Capa | Tecnologías |
|------|------------|
| Backend | PHP · Laravel · Eloquent ORM |
| Frontend | Blade · HTML5 · CSS3 · JavaScript |
| Base de datos | MySQL |
| API externa | TMDB (The Movie Database) |
| Autenticación | Laravel Auth |

---

## ✨ Funcionalidades

### 👤 Usuario público
- Consulta de la **cartelera** de películas disponibles
- **Reserva** de películas

### 🔐 Usuario registrado
- Todo lo anterior
- **Comentarios** en fichas de películas

### 🛠️ Administrador
- **CRUD completo de películas** — con carga automática de carátula vía TMDB API si no se sube manualmente
- **CRUD de reservas** — gestión y seguimiento de todas las reservas
- **CRUD de usuarios** — administración de cuentas registradas

---

## 🎯 Integración con TMDB API

Una de las funcionalidades más destacadas del proyecto. Al añadir una nueva película desde el panel de administración:

1. El administrador introduce el título de la película
2. Si no sube una carátula manualmente, el sistema **consulta automáticamente la TMDB API**
3. La imagen se obtiene y almacena en el servidor
4. La ficha queda completa sin intervención manual

Esto elimina la fricción del proceso de alta de películas y demuestra el consumo de APIs externas en un contexto real.

---

## 🚀 Instalación

### Requisitos
- PHP 8.x
- Composer
- MySQL
- Clave de API de TMDB (gratuita en [themoviedb.org](https://www.themoviedb.org/settings/api))

### Pasos

```bash
# 1. Clona el repositorio
git clone https://github.com/rlabper0608/videoclubApp.git
cd videoclubApp

# 2. Instala dependencias
composer install

# 3. Configura el entorno
cp .env.example .env
php artisan key:generate

# 4. Configura la base de datos y la API key en .env
DB_DATABASE=videoclub
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
TMDB_API_KEY=tu_api_key

# 5. Ejecuta las migraciones y seeders
php artisan migrate --seed

# 6. Lanza el servidor
php artisan serve
```

Accede en: `http://localhost:8000`

---

## 📁 Estructura relevante

```
videoclubApp/
├── app/
│   ├── Http/Controllers/
│   │   ├── PeliculaController.php   # CRUD + integración TMDB
│   │   ├── ReservaController.php
│   │   └── ComentarioController.php
│   └── Services/
│       └── TmdbService.php          # Lógica de consulta a la API
├── resources/views/                 # Plantillas Blade
├── database/
│   ├── migrations/
│   └── seeders/
└── routes/
    └── web.php
```

---

## 👨‍💻 Contexto académico

Proyecto desarrollado durante el **Grado Superior de Desarrollo de Aplicaciones Web (DAW)** como práctica avanzada de Laravel, con énfasis en arquitectura MVC, relaciones Eloquent y consumo de APIs externas.

---

## 📄 Licencia

Proyecto académico compartido con fines de portfolio. No está permitida su distribución o uso comercial sin autorización expresa del autor.
