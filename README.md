# 🩺 Sistema Web para Gestión de Consultorio Médico

Aplicación web Full Stack desarrollada para optimizar la administración de un consultorio médico, con módulos especializados para la gestión de citas, recetas automatizadas e inventario de medicamentos en tiempo real.

---

## 🚀 Características Principales

- ✅ Registro y administración de usuarios: pacientes, dentistas y personal administrativo.
- 📅 Gestión eficiente de citas médicas.
- 💊 Generación automática de recetas vinculadas al historial del paciente.
- 📂 Acceso seguro a las prescripciones desde el perfil del paciente.
- 📦 Control de inventario de medicamentos en tiempo real.
- 👨‍⚕️ Roles diferenciados con acceso personalizado por tipo de usuario.
- 📊 Monitoreo del sistema mediante logs y métricas.
- 🔄 Integración continua y despliegue controlado.

---

## 🛠️ Tecnologías Utilizadas

### Frontend
- **React** – Interfaz de usuario dinámica y responsiva con componentes reutilizables.

### Backend
- **Laravel (PHP)** – Lógica de negocio y API RESTful para conexión segura con el frontend.

### Base de Datos
- **PostgreSQL** – Almacenamiento estructurado de pacientes, dentistas, recetas y citas.

### DevOps y Mantenimiento
- **GitHub** – Control de versiones centralizado.
- **Travis CI** – Ejecución de pruebas automatizadas en cada push al repositorio.
- **Docker** – Entornos estandarizados para desarrollo y producción.
- **Elastic Stack (ELK)** – Logging y monitoreo avanzado con visualización en **Kibana**.

### Comunicación y Gestión del Proyecto
- **Microsoft Teams** – Comunicación fluida del equipo de desarrollo.
- **Trello** – Gestión ágil de tareas, planificación de sprints y seguimiento del proyecto.

---

## 🖼️ Capturas de Pantalla

Puedes ver todas las capturas en la carpeta [Docs/Screenshots]


⚙️ USO
Una vez que la aplicación está instalada y funcionando, puedes acceder a las distintas partes del sistema según el tipo de usuario y estructura del proyecto:

La carpeta 8ids1 contiene el backend con Laravel y también la interfaz para doctores.

Dentro de la carpeta principal Viene una llamada React, que contiene el frontend hecho con React para pacientes.

Asegúrate de tener ambos servidores corriendo:

Backend (Laravel):


php artisan serve
Accede en: http://localhost:8000

Frontend del paciente (React):


npm install
npm start
Accede en: http://localhost:3000

Puedes:

Registrarte como paciente desde el frontend en React.

Iniciar sesión como doctor directamente desde Laravel (/login).

Desde el panel del doctor puedes gestionar citas, pacientes, recetas e inventario de medicamentos.



## 🛠️ Instalación (Desarrollo)

1. Clona el repositorio:
```bash
git clone https://github.com/Patokiing/Consultorio-App.git

2. **Entra a la carpeta del proyecto--
cd Colsultorio-App

3.. **Entra a la carpeta del backend 8ids1:
cd 8ids1


4. ** Instala las dependencias del backend en 8ids1:
composer install

5. **Copia el archivo de configuración:
copy .env.example .env

6. ** Edita el archivo .env para configurar tu conexión a la base de datos PostgreSQL, por ejemplo:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=8ids1
DB_USERNAME=postgres
DB_PASSWORD=root


7. ** Ejecuta las migraciones y semillas para crear las tablas y datos iniciales:
php artisan migrate --seed

8. ** Levanta el servidor local de Laravel:
php artisan serve

9. ** (Opcional) Para el frontend con React, instala dependencias y levanta el servidor:
npm install
npm start




