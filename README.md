# 📰 El Faro - Semana 9

## 📌 Descripción del Proyecto

El Faro es una plataforma web de noticias desarrollada en PHP utilizando arquitectura MVC (Modelo - Vista - Controlador), enfocada en la publicación dinámica de artículos, gestión de usuarios e interacción mediante comentarios.

Durante la Semana 9 se incorporaron mejoras orientadas a la usabilidad (UI), experiencia de usuario (UX), validaciones frontend/backend y optimización visual del sistema, manteniendo responsividad y conexión con base de datos MySQL.

---

# 🚀 Tecnologías Utilizadas

- PHP Orientado a Objetos (POO)
- MySQL
- HTML5
- CSS3
- JavaScript
- Bulma CSS
- Arquitectura MVC
- XAMPP

---

# 🏗️ Arquitectura MVC

```plaintext
el-faro-semana-9/
├── app/                        # Capa central de la aplicación (MVC)
│   ├── Controller/             # Controladores que manejan la lógica de negocio y enrutamiento interno
│   │   ├── ArticuloController.php   # Maneja la vista de inicio, detalles de noticias y validación para publicar
│   │   ├── ContactoController.php   # Procesa y valida el envío del formulario de contacto
│   │   └── UsuarioController.php    # Administra el registro, autenticación (login) y listado de usuarios
│   │
│   ├── Model/                  # Lógica de datos, reglas de negocio e interacción con MySQL
│   │   ├── Articulo.php             # Funciones para interactuar con artículos y procedimientos almacenados
│   │   ├── Comentario.php           # Métodos para guardar, obtener y eliminar comentarios de la base de datos
│   │   ├── Contacto.php             # Método para registrar nuevos mensajes de contacto
│   │   ├── Sesion.php               # Gestiona variables de sesión y validación de administrador
│   │   └── Usuario.php              # Clase que representa al usuario y maneja registro/autenticación
│   │
│   └── View/                   # Interfaces gráficas renderizadas para el lector
│       ├── Layout/             # Estructuras reutilizables de la plataforma
│       │   ├── header.php           # Barra de navegación, estructura HTML y carga de Bulma CSS
│       │   └── footer.php           # Pie de página y carga de archivos JavaScript
│       │
│       ├── articulo_detalle.php     # Vista detallada de noticias y sistema de comentarios
│       ├── contacto.php             # Formulario de contacto
│       ├── inicio.php               # Página principal con artículos recientes y multimedia
│       ├── lista_usuario.php        # Listado de usuarios registrados (administrador)
│       ├── login.php                # Formulario de autenticación
│       ├── nuevo_articulo.php       # Formulario para creación de noticias
│       └── registro.php             # Registro de usuarios con validaciones HTML5
│
├── Config/                     # Configuración y conexión a base de datos
│   ├── Conexion.php            # Instancia PDO y métodos encapsulados de conexión
│   └── Config.php              # Definición de constantes de conexión MySQL
│
├── Public/                     # Directorio público accesible desde navegador
│   ├── CSS/
│   │   └── style.css           # Personalización visual y diseño responsive
│   │
│   ├── JS/
│   │   └── script.js           # Funcionalidades dinámicas y validaciones visuales
│   │
│   ├── assets/                 # Recursos multimedia del sistema
│   │   ├── audio/
│   │   │   └── El_Faro_audio.mp3
│   │   │
│   │   └── video/
│   │       └── video_web.mp4
│   │
│   └── index.php               # Front Controller y enrutamiento principal MVC
│
├── elfaro_db.sql               # Base de datos MySQL, tablas y procedimientos almacenados
└── README.md                   # Documentación oficial del proyecto
```
```

## Componentes

### Model
Manejo de datos y conexión a base de datos.

### View
Interfaces visuales y formularios del sistema.

### Controller
Procesamiento de lógica de negocio y control de acciones.

---

# 🧩 Funcionalidades del Sistema

## 👤 Gestión de Usuarios
- Registro de lectores
- Inicio de sesión
- Validación de formularios
- Restricción de contraseñas
- Validación de correo electrónico

## 📰 Gestión de Artículos
- Creación dinámica de noticias
- Visualización de artículos
- Vista detalle de noticias
- Organización por secciones
- Integración de fuentes externas

## 💬 Sistema de Comentarios
- Comentarios por artículo
- Interacción de usuarios autenticados
- Administración básica de comentarios

## 🎨 Mejoras UX/UI
- Diseño responsive con Bulma CSS
- Mejor distribución visual
- Formularios más intuitivos
- Retroalimentación visual en validaciones
- Navegación mejorada

---

# 🔐 Validaciones Implementadas

## Frontend
- Campos requeridos (`required`)
- Validación de correo (`type="email"`)
- Expresiones regulares (`pattern`)
- Restricción mínima de contraseña

## Backend
- Validaciones PHP
- Manejo de sesiones
- Validación de datos antes de inserción
- Conexión segura mediante PDO

---

# 🗄️ Base de Datos

Motor utilizado:

```plaintext
MySQL
```

Archivo incluido:

```plaintext
elfaro_db.sql
```

La base de datos incluye:
- Usuarios
- Artículos
- Comentarios
- Relaciones
- Procedimientos almacenados

---

📱 Responsividad
La plataforma fue desarrollada utilizando Bulma CSS, permitiendo correcta visualización en:

- computadores
- tablets
- dispositivos móviles

---

# ⚠️ Importante

GitHub Pages no permite ejecutar proyectos PHP ni conexiones MySQL de forma nativa, por lo que este proyecto debe ejecutarse en un entorno local utilizando XAMPP o un servidor compatible con PHP y MySQL.

La plataforma fue desarrollada para funcionar en entorno local mediante Apache y MySQL.

---

# ✨ Mejoras Implementadas - Semana 9

## ✅ Mejoras UX/UI
- Vista detalle de artículos
- Jerarquía visual optimizada
- Diseño más limpio y ordenado
- Mejor distribución de contenido

## ✅ Mejoras Funcionales
- Sistema de comentarios
- Botón de fuente externa
- Navegación mejorada
- Formularios optimizados

## ✅ Mejoras de Seguridad
- Validaciones frontend
- Validaciones backend
- Restricción de formatos
- Validación de credenciales

---

# ⚙️ Instalación del Proyecto

## 1. Clonar Repositorio

```bash
git clone https://github.com/EAKVX/el-faro-semana-9.git
```

---

## 2. Mover Proyecto

Copiar carpeta dentro de:

```plaintext
C:\xampp\htdocs\
```

---

## 3. Iniciar Servicios

Abrir XAMPP e iniciar:
- Apache
- MySQL

---

## 4. Crear Base de Datos

Ingresar a:

```plaintext
http://localhost/phpmyadmin
```

Crear base de datos:

```plaintext
elfaro_db
```

---

## 5. Importar Base de Datos

Importar archivo:

```plaintext
elfaro_db.sql
```

---

## 6. Ejecutar Proyecto

Abrir en navegador:

```plaintext
http://localhost/el-faro-semana-9/Public/index.php
```

---

# 🔑 Acceso de Prueba

```plaintext
Usuario: admin
Contraseña: admin
```

---

# 👨‍💻 Integrantes

- Álvaro Brizuela
- Jocelyn González
- Enrique Ahumada Ortiz
- Viviana Catrín Sáez

---

# 📖 Asignatura

**Taller de Aplicaciones para Internet**  
AIEP - Semana 9
