# WMStor
## WMStor - Sistema de Administración de Bodegas

Desarrollado en LARAVEL v10
Manejo de usuarios con BREEZE
Control de Acceso mediante paquete SPATIE para ñps Roles y permisos.
Panel de administracion mediante paqueteria de FILAMENT v3

* Recordar cambiar en .env nombre de la bsae de datos, usuario y clave
* Correr en la terminal "php artisan migrate:fresh --seed" que crea el usuario "Administrador" con el rol de "Administrador", mas los permisos CRUD de las tablas "users, roles y permissions"
* Para el login:
  * Usuario: sistemas@storage.cl
  * Clave: 15561556
* Como comando en la BD, esto para que se pueda conectar al sistema, correr el sigueinte comando INSERT:
  - INSERT INTO model_has_roles (role_id, model_type , model_id) VALUES (1, "App\\Models\\User", 1);
  - Este insert asigna al usuario Administrador el rol de Administrador, sin esta asignacion el login no mostrara NADA.
* En la terminal ejecurar "php artisan serve"
* URL de coneccion: "http://localhost:8000/admin"

--------

## Historia de cambios.
* 13-02-2024 - Carga inicial sistema base, solo con roles y permisos del administrador.
* 
