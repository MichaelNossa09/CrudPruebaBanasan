Prueba Técnica Auxiliar de Programación.

1.	Utilizar GIT para presentar los resultados de la prueba compartiendo el acceso al repositorio.
R/ https://github.com/MichaelNossa09/CrudPruebaBanasan

2.	Para las siguientes preguntas marque cuál es el valor que continuaría en la serie:
1	3	7	13	21
2	4	10	28	82	244	730
B	D	B	F	D	J
1	2	4	8	16	32
3,1	1,5	5,3	3,3	3,2
3	6	3	12	7	42	35
2	4	6	10	16	26
1:05	3:10	7:20	1:35	9:55


3.	SQL. De acuerdo con el siguiente modelo de tablas, elabore las sentencias SQL con las cuales puede realizar las consultas 
 
Vendedores:
•	id_vendedor es la llave primaria. 
•	Cada fila de esta tabla indica el nombre y la identificación de un vendedor junto con su salario, tasa de comisión y fecha de contratación.
Empresa:
•	id_empresa es la llave primaria.
•	Cada fila de esta tabla indica el nombre y el ID de una empresa y la ciudad en la que se encuentra la empresa.
Ordenes:
•	id_orden es la llave principal.
•	id_empresa es una llave foránea a id_empresa de la tabla Empresa.
•	id_vendedor es una llave foránea a id_vendedor de la tabla Vendedores.
•	Cada fila de esta tabla contiene información sobre un pedido. Esto incluye el ID de la empresa, el ID del vendedor, la fecha del pedido y el monto pagado.

a)	Escriba una consulta SQL para informar los nombres de todos los vendedores que no tenían ningún pedido relacionado con la empresa con el nombre "RED". Devuelva la tabla de resultados en cualquier orden. El formato del resultado de la consulta se muestra en el siguiente ejemplo.

R/

SELECT DISTINCT Vendedores.nombre as Nombre, Empresa.nombre as Empresa
FROM Vendedores
	INNER JOIN Ordenes ON Vendedores.id_vendedor = Ordenes.id_vendedor
	INNER JOIN Empresa ON Ordenes.id_empresa = Empresa.id_empresa
WHERE Vendedores.id_vendedor NOT IN (
    	SELECT Vendedores.id_vendedor
    	FROM Vendedores
    		INNER JOIN Ordenes ON Vendedores.id_vendedor = Ordenes.id_vendedor
    		INNER JOIN Empresa ON Ordenes.id_empresa = Empresa.id_empresa
    	WHERE Empresa.nombre = 'RED')


b)	Escriba una consulta SQL para informar la cantidad total de dinero que ha recaudado un vendedor por cada empresa que alguna vez le ha realizado una orden. Ordene el resultado por monto recaudado de forma ascendente.
Ejemplo:
Entrada	Salida
Misma entrada que el ejercicio anterior.	 
Explicación: Por cada pedido en la tabla Ordenes, hay tanto una empresa asociada como un monto recaudado. Se deben sumar los montos recaudados (qty de cada pedido) por pareja vendedor, empresa. Pam tiene dos órdenes de la empresa YELLOW por $10,000 y $35,000; si se suman ambos valores, se obtiene $45,000 (primer registro de la salida). Lo mismo para los demás vendedores y empresas.


R/

SELECT Vendedores.nombre as Nombre, Empresa.nombre as Empresa, SUM(Ordenes.qty) as Recaudado
FROM Vendedores
	INNER JOIN Ordenes ON Vendedores.id_vendedor = Ordenes.id_vendedor
	INNER JOIN Empresa ON Ordenes.id_empresa = Empresa.id_empresa
GROUP BY Vendedores.nombre, Empresa.nombre
ORDER BY Recaudado DESC

4.	Diseñar y codificar una interface que simule la popular aplicación https://www.reddit.com/. De lo anterior como mínimo se espera tener las siguientes funcionalidades:
a.	Listar publicaciones por fecha (del más reciente al más antiguo:
i.	Fecha de publicación
ii.	Usuario que publica
iii.	Número de votos
b.	Inicio de sesión (usuario, contraseña) 
(No obligatorio) Requiere autenticación para acceder a las siguientes funcionalidades.
c.	Crear una publicación (título, contenido (puede ser solo texto), fecha de creación, usuario creador, cantidad de votos).
d.	Editar una publicación.
e.	Eliminar una publicación.
f.	Añadir voto o quitar voto de una publicación (solo un voto por usuario).

Se puede orientar al desarrollo web o al desarrollo móvil.
Se puede utilizar la tecnología de desarrollo con la que se sienta más a gusto.
Se puede valer de tecnologías como firebase o afines para presentar una solución.
Se tendrán en cuenta factores como rendimiento y el diseño de la propia interface


5.	(No obligatorio) Realizar una macro en Excel que permita recorrer una lista de personas. En dicho recorrido se debe seleccionar las personas del sexo masculino y con ellas crear una nueva lista en una nueva hoja de Excel.


R/
1.	Sub FiltrarPorSexo()
2.	    Dim HojaOriginal As Worksheet
3.	    Dim HojaNueva As Worksheet
4.	    Dim filaOriginal As Long
5.	    Dim filaNueva As Long
6.	    Dim ultimaFila As Long
7.	   
8.	    Set HojaOriginal = ThisWorkbook.Sheets("Hoja2")
9.	    Set HojaNueva = ThisWorkbook.Sheets.Add
10.	   
11.	    HojaOriginal.UsedRange.Copy Destination:=HojaNueva.Range("A1")
12.	   
13.	    ultimaFila = HojaOriginal.Cells(HojaOriginal.Rows.Count, 1).End(xlUp).Row
14.	   
15.	    filaNueva = 2
16.	   
17.	    For filaOriginal = ultimaFila To 2 Step -1
18.	        If Trim(HojaOriginal.Cells(filaOriginal, 5).Value) <> "Hombre" Then
19.	            HojaNueva.Rows(filaOriginal).Delete
20.	        End If
21.	    Next filaOriginal
22.	   
23.	    ultimaFila = HojaNueva.Cells(HojaNueva.Rows.Count, 1).End(xlUp).Row
24.	   
25.	    HojaNueva.Range("A1:J1").AutoFilter
26.	    HojaNueva.Cells.EntireColumn.AutoFit
27.	End Sub
