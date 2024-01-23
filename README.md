# Resumen de cambios

* Se ha separado la funcionalidad de la base de datos en una carpeta model, que tiene los scripts para crear la base de datos y 2 archivos, uno par gestionar la conexion y otro con las funciones para realizar las consultas.

* Se ha creadoo una carpeta templates donde iran los componentes que se puedan reutilizar, de momento solo tenemos un fichero con la cabecera que llevarán las distintas páginas

* Se ha creado una carpeta config para los archivos de configuración. De momento tenemos un archivo db_settings.ini que almacena los parámetros de configuración de la base de datos.

* De los scripts de las páginas se ha eliminado el código relativo a las consultas y se ha intentado que queden un poco más legibles.
