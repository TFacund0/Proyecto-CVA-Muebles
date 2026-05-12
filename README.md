# 🪵 CVA Muebles - Carpintería de Autor

![CVA Muebles Banner](https://img.shields.io/badge/Status-Artisan--Panel--Active-brightgreen)
![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-777bb4)
![Framework](https://img.shields.io/badge/Framework-CodeIgniter--4-ee4323)
![Database](https://img.shields.io/badge/Database-MySQL-4479a1)

**CVA Muebles** es una solución web integral diseñada para la profesionalización de un taller de carpintería artesanal en Mantilla, Corrientes. Este proyecto transforma un e-commerce tradicional en una herramienta de gestión estratégica y exhibición de catálogo (Showroom Mode).

---

## 🚀 Características Principales

### 🛋️ Modo Showroom (Consultoría de Autor)
El sistema permite alternar entre un e-commerce funcional y un catálogo de exhibición. Al desactivar el carrito, los botones de compra se transforman en enlaces directos a **WhatsApp**, permitiendo una atención personalizada para muebles a medida.

### 🛠️ Artisan Panel (Gestión de Taller)
Panel administrativo robusto para el artesano, que incluye:
- **Control de Estados**: Seguimiento de pedidos desde `PENDIENTE` hasta `ENTREGADO`.
- **Dashboard de Estadísticas**: Visualización en tiempo real de la carga de trabajo y pedidos listos.
- **Gestión de Inventario**: Control de stock mínimo y alertas.

### 🔐 Seguridad y Perfiles
- **Validaciones de Seguridad**: Control estricto de duplicados y sanitización de datos en perfiles.
- **Arquitectura MVC**: Código limpio, escalable y siguiendo las mejores prácticas de CodeIgniter 4.

---

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.1+ (CodeIgniter 4)
- **Frontend**: HTML5, CSS3 (Vanilla), JavaScript, Bootstrap 5
- **Base de Datos**: MySQL
- **Servidor Local**: XAMPP (Apache)

---

## 📂 Estructura del Proyecto

```bash
├── app/
│   ├── Controllers/    # Lógica de negocio (Usuario, Ventas, Productos)
│   ├── Models/         # Interacción con la DB
│   └── Views/          # Interfaces de usuario (Front & Back Office)
├── assets/             # Recursos estáticos (CSS, JS, Imágenes)
├── public/             # Punto de entrada público
└── writable/           # Archivos temporales y logs
```

---

## 📝 Instalación y Configuración

1. Clonar el repositorio: `git clone https://github.com/TFacund0/Proyecto-CVA-Muebles.git`
2. Configurar el archivo `.env`:
   ```env
   app.baseURL = 'http://localhost/Proyecto-CVA-Muebles'
   SHOPPING_CART_ENABLED = false
   ```
3. Importar la base de datos `arce_acevedo.sql`.
4. Configurar el Alias en Apache para apuntar a la raíz del proyecto.

---

## 🧔 Autor
Desarrollado para la profesionalización del portfolio personal y uso real de **César Víctor Acevedo**.

---

> [!TIP]
> **Carpintería de Autor**: Cada veta de madera cuenta una historia. Este software asegura que el proceso detrás de cada historia sea impecable.
