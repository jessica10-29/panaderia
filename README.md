# 🥐 Sistema de Pedidos – Panadería

Aplicación web desarrollada en **PHP + MySQL** para la gestión de pedidos de una panadería.
Incluye autenticación (login), registro de pedidos, listado, edición y eliminación, con despliegue compatible con **InfinityFree**.

---

## 🚀 Funcionalidades

* 🔐 **Login y Logout** con sesiones PHP
* ➕ Crear nuevos pedidos
* 📋 Listar pedidos registrados
* ✏️ Editar pedidos existentes
* 🗑 Eliminar pedidos
* 📦 Control de estado del pedido
* 🌐 Despliegue en hosting gratuito (InfinityFree)

---

## 🛠 Tecnologías utilizadas

* PHP 7+
* MySQL (InfinityFree)
* HTML5
* CSS3
* Font Awesome (iconos)

---

## 📁 Estructura del proyecto

```
/htdocs
│── index.php          # Formulario para crear pedidos
|── bd.sql             # base de datos 
│── login.php          # Inicio de sesión
│── logout.php         # Cierre de sesión
│── pedidos.php        # Listado de pedidos
│── editar.php         # Editar pedido
│── eliminar.php       # Eliminar pedido
│── guardar.php        # Guardar pedido
│── conexion.php       # Conexión a la base de datos
│── estilos.css        # Estilos CSS
│── README.md
```

---

## 🔐 Acceso al sistema

El sistema está protegido por sesiones.

Para acceder a las páginas principales (`index.php`, `pedidos.php`):

1. Ingresar primero a `login.php`
2. Iniciar sesión correctamente
3. El sistema crea la sesión `$_SESSION['admin']`

---

## 🗄 Base de datos

### Conexión (`conexion.php`)

```php
<?php
$servidor = "sql101.infinityfree.com";
$usuario  = "if0_XXXXXXX";
$clave    = "TU_PASSWORD";
$bd       = "if0_XXXXXXX_panaderia";

$conexion = new mysqli($servidor, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>
```

---

### Tabla `pedidos`

```sql
CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente VARCHAR(100),
  bunuelos INT,
  pan_basico INT,
  cafe INT,
  pandebono INT,
  total DECIMAL(10,2),
  estado VARCHAR(50)
);
```

---

## 🌐 Despliegue en InfinityFree

1. Crear cuenta en [https://infinityfree.net](https://infinityfree.net)
2. Crear hosting y base de datos
3. Subir todos los archivos dentro de `/htdocs`
4. Configurar `conexion.php`
5. Acceder a:

```
https://tusitio.infinityfreeapp.com/login.php
```

---

## 🧪 Pruebas rápidas

Archivo de prueba de conexión:

```php
<?php
include "conexion.php";
echo "Conectado correctamente";
?>
```

---

## ✨ Autor

Proyecto académico / práctico para aprendizaje de desarrollo web con PHP y MySQL.

---

## 📌 Notas

* InfinityFree no muestra errores por defecto → activar `error_reporting` durante desarrollo
* Usar siempre `/htdocs`
* No usar `localhost` en producción

---

✅ Proyecto listo para producción básica y demostraciones.
