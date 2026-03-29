# Guía para Agentes de Desarrollo - Proyecto EKLAB

Este documento describe la arquitectura, convenciones y estándares de codificación del proyecto EKLAB para asegurar la consistencia en el desarrollo de nuevas funcionalidades y mantenimientos.

## 🚀 Stack Tecnológico
- **Framework:** Laravel 9/10+
- **Frontend:** Blade + AdminLTE 3 + Tailwind CSS (Jetstream)
- **Base de Datos:** MySQL / MariaDB
- **Autenticación:** Laravel Jetstream (Fortify)

## 🏗️ Arquitectura y Estructura
El proyecto sigue el patrón MVC estándar de Laravel con una organización específica para el panel administrativo.

- **Modelos:** Ubicados en `app/Models/`. Se utiliza `$guarded = []` por defecto.
- **Controladores Administrativos:** Ubicados en `app/Http/Controllers/Admin/`.
- **Rutas:** Las rutas administrativas se definen en `routes/admin.php` bajo el prefijo y nombre `admin.`.
- **Vistas:** Ubicadas en `resources/views/admin/{entidad}/`.

## 📝 Convenciones de Código

### 1. Controladores (CRUD)
Siguen el estándar de `Route::resource`. Ejemplo de métodos obligatorios:
- `index()`: Listado general.
- `create()` / `store()`: Formulario y guardado.
- `edit()` / `update()`: Formulario de edición y actualización.
- `destroy()` / `ajaxDelete($id)`: Eliminación (incluyendo soporte para AJAX).

**Validación:** Se realiza directamente en el controlador usando `$request->validate([...])`.

### 2. Modelos
- **Relaciones:** Definir siempre el tipo de relación (e.g., `belongsTo`, `hasMany`).
- **Accessors:** Usar para lógica de presentación (e.g., `getNombreCompletoAttribute`).
- **Asignación Masiva:** Se prefiere `$guarded = []` sobre `$fillable`.

### 3. Vistas (Blade)
Para cada entidad en `admin`, la estructura de archivos debe ser:
- `index.blade.php`: Tabla principal (usualmente con DataTable).
- `create.blade.php`: Contenedor para creación.
- `edit.blade.php`: Contenedor para edición.
- `form.blade.php`: Partial reutilizable con los campos del formulario.

### 4. Rutas
- Usar siempre rutas nombradas: `Route::resource('entidad', EntidadController::class)->names('admin.entidad');`.
- Rutas AJAX deben seguir el patrón: `admin.{entidad}.ajaxDelete` o similar.

## 🛠️ Workflow para Nuevos CRUDs
Para crear un nuevo mantenimiento (ejemplo: `NuevoModelo`):
1. **Migración:** Crear tabla siguiendo convenciones de nombres en español (plural).
2. **Modelo:** Crear `app/Models/NuevoModelo.php` con sus relaciones.
3. **Controlador:** Crear `app/Http/Controllers/Admin/NuevoModeloController.php` con los métodos de recurso.
4. **Rutas:** Registrar en `routes/admin.php`.
5. **Vistas:** Crear carpeta `resources/views/admin/nuevo_modelos/` y los 4 archivos Blade estándar.
6. **Menú:** Agregar la opción en `config/adminlte.php`.

## ⚙️ Flujo de Trabajo del Agente
- **Git Automático:** Todos los archivos nuevos generados por el agente deben agregarse automáticamente al área de preparación (`git add`).
- **Persistencia de Datos:** Para tablas de catálogos (ej. `examens`, `municipios`), se prefiere la creación de seeders basados en datos reales extraídos de la base de datos local mediante `php artisan tinker`.
- **Registro de Sesiones:** Al finalizar cada bloque de trabajo significativo, se debe actualizar `SESSIONS.md` con los cambios realizados, pendientes y notas técnicas.

## 🔍 Patrones Específicos Identificados
- **Dropdowns Dependientes:** Se manejan vía AJAX en el controlador (ej. `getMunicipiosByDepartamento`).
- **Eliminación:** Se utiliza un método `ajaxDelete` que devuelve un string de confirmación para ser consumido por DataTables/SweetAlert2.
- **Notificaciones:** Se utiliza `with('info', $mensaje)` para alertas flash procesadas por AdminLTE.
- **Totalización Automática:** En la creación de órdenes, la totalización se realiza client-side mediante atributos `data-precio` en el Select2, evitando peticiones AJAX innecesarias.

---
*Este archivo debe ser actualizado si se introducen cambios significativos en la arquitectura o herramientas del proyecto.*
