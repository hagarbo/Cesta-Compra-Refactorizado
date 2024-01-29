# Resumen de cambios

* Se ha separado la funcionalidad de la base de datos en una carpeta model, que tiene los scripts para crear la base de datos y 2 archivos, uno para gestionar la conexion y otro con las funciones para realizar las consultas.

* Se ha creado una carpeta templates donde iran los componentes que se puedan reutilizar, de momento solo tenemos un fichero con la cabecera que llevarán las distintas páginas. La idea es poner aquí las partes de html que se puedan reutilizar.

* Se ha creado una carpeta config para los archivos de configuración. De momento tenemos un archivo db_settings.ini que almacena los parámetros de configuración de la base de datos.

* Se ha creado una carpeta util para los archivos que contengan funcionalidades de utilidad. Ahora mismo solo tenemos un archivo util con funciones para mostrar el html de ciertas partes y funciones para gestionar la sesion y las cookies.

* De los scripts de las páginas se ha eliminado el código relativo a las consultas y se ha intentado que queden un poco más legibles.

# Nuevas funcionalidades

* Ahora es posible añadir unidades de un mismo producto a la cesta. El número de unidades está limitado a 3 y se realiza la comprobación en el formulario y al ejecutar el script en el servidor. Además, si se ha añadido el número máximo de unidades el botón añadir se deshabilita.

* Ahora la cesta se muestra en formato tabla con información sobre las unidades de cada producto y el subtotal de los mismos. 

* Ahora en el carrito se muestra el número total de unidades añadidas a la cesta independientemente de que sean de un mismo producto.

