🚀 Proyecto de Microservicios
Este proyecto utiliza Docker y Docker Compose para ejecutar y gestionar varios microservicios. A continuación, encontrarás todo lo necesario para configurar y ejecutar esta aplicación de manera rápida y sencilla.

🛠️ Requisitos previos
Antes de comenzar, asegúrate de que tu máquina cumpla con los siguientes requisitos:

🐙 Git: para clonar el repositorio.
🐋 Docker: para gestionar contenedores.
📦 Docker Compose: para orquestar múltiples contenedores.
🐘 PHP: (opcional) para ejecutar comandos Artisan.
⚙️ Guía de instalación
1️⃣ Clonar el repositorio
Usa este comando para descargar el código en tu máquina:

bash
Copiar código
git clone git@github.com:carlos-asm/microservicios.git
cd microservicios
2️⃣ Construir y levantar los contenedores
Ejecuta el siguiente comando para construir y levantar los contenedores en segundo plano:

bash
Copiar código
docker-compose up -d --build
✅ Este paso:

Descargará las imágenes necesarias.
Construirá los contenedores.
Ejecutará la aplicación en segundo plano.
3️⃣ Configurar las bases de datos
Cada microservicio tiene su propia base de datos. Sigue estos pasos para configurarlas:

🔑 Servicio de Autenticación (auth-service)
bash
Copiar código
cd auth-service
docker exec -it auth-service php artisan migrate --seed
🛍️ Servicio de Tienda (store-service)
bash
Copiar código
cd store-service
docker exec -it store-service php artisan migrate --seed
4️⃣ Acceder a la aplicación
Una vez que los contenedores estén en ejecución, abre tu navegador y accede a:

🌐 http://localhost:8000

🛠️ Comandos útiles
Aquí tienes algunos comandos esenciales para gestionar los contenedores:

🛑 Detener los contenedores:

bash
Copiar código
docker-compose down
📄 Ver los logs de un contenedor:

bash
Copiar código
docker logs <NOMBRE_DEL_CONTENEDOR>
🔍 Ingresar a un contenedor en ejecución:

bash
Copiar código
docker exec -it <NOMBRE_DEL_CONTENEDOR> bash
📌 Notas adicionales
⚠️ Asegúrate de que los puertos especificados en el archivo docker-compose.yml no estén ocupados.
🛡️ Si necesitas ajustes adicionales, consulta los archivos de configuración de cada microservicio.
💡 Si encuentras problemas, no dudes en revisar los logs para identificar el error.
🎉 ¡Listo para empezar!
Con esta guía, deberías tener el proyecto funcionando en poco tiempo. Si tienes preguntas o problemas, ¡estaré encantado de ayudarte! 😄

