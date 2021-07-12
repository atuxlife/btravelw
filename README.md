# btravelw
Consumo de datos del clima mediante API de OpenWeatherMap y renderizado en mapas de OpenStreetMaps

La aplicación tiene la siguiente estructura de archivos y directorios

.htaccess: Apunta como ruta inicial el modelo inicio con su método index. Con esto se carga la página principal

sql/weather.sql: Es el script la base de datos MySQL utilizada para el proyecto

src/globvars.php: En este archivo se configuran las constantes utilizadas durante la ejecución de la aplicación. Incluye las credenciales para acceder a la base de datos.

index.php: Aquí se cargan todas las dependencias y configuraciones iniciales de la aplicación. Indica también cómo será el ruteo de la misma apoyándose con el recurso de src/app.php

models/inicio.model.php: Este archivo contiene los métodos necesarios para hacer funcionar las peticiones a la API de clima y otras operaciones para ejecución de tareas básicas.

Principales métodos:

  - index: Renderiza la página principal ubicada en html/index.html
  - getWeatherInfo: Se conecta a la API de OpenWeatherMap.org para solicitar los datos correspondientes a las ciudades solicitadas (Miami, Orlando, New York) e inserta en la base de datos los resultados obtenidos, con la respectiva fecha/hora de la consulta utilizando el método insertLog, el cual recibe como parámetros el arreglo de datos a guardar.
  - lstWeatherInfo: Lista los datos históricos que se han guardado después de hacer la consulta de los datos del clima. Determina si hay fechas a listar y envía al frontend un JSON para que renderize un listado con los datos solicitados. En dicho JSON están el ID del histórico y su respectiva fecha/hora de consulta.
  - shwDataHist: Este método envía al frontend los datos que se han seleccionado dependiendo del ID del histórico listado, al que se le ha dado clic en el frontend. En el frontend se recibe un JSON con los datos de todas las consultas que se han hecho en ese histórico.
  - insertLog: Recibe como parámetro los datos como string que se han recibido en cada búsqueda, se le asigna una fecha/hora de histórico y se almacena en la tabla datareports.

js/main.js: El codigo de este archivo, apoyándose en jQuery y la librería LeafLet, hace los llamados a la API desarrollada en PHP en el backend. Controla los eventos de clic en los botones de Mostrar Reporte, Listar y el clic en el ítem seleccionado en la lista de resultados.

html/index.html: Contiene la maqueta y los llamados a archivos de apoyo. Aquí están todos los elementos como contenedores para el mapa, para los campos de fitro de fecha, los botones de acción, entre otros.
