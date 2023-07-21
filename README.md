# Prueba Técnica Auxiliar de Programación

...
## 1.	Utilizar GIT para presentar los resultados de la prueba compartiendo el acceso al repositorio.


**R/ https://github.com/MichaelNossa09/CrudPruebaBanasan**

## 2.	Para las siguientes preguntas marque cuál es el valor que continuaría en la serie:

| 1 | 3 | 7 | 13 | 21 |
| 2 | 4 | 10 | 28 | 82 | 244 | 730
| B | D | B | F | D | J |
| 1 | 2 | 4 | 8 | 16 | 32 |
| 3.1 | 1.5 | 5.3 | 3.3 | 3.2 |
| 3 | 6 | 3 | 12 | 7 | 42 | 35 |
| 2 | 4 | 6 | 10 | 16 | 26 |
| 1:05 | 3:10 | 7:20 | 1:35 | 9:55 |


## 3.	SQL. De acuerdo con el siguiente modelo de tablas, elabore las sentencias SQL con las cuales puede realizar las consultas 
 
#### Vendedores:
    - id_vendedor es la llave primaria. 
    - Cada fila de esta tabla indica el nombre y la identificación de un vendedor junto con su salario, tasa de comisión y fecha de contratación.
#### Empresa:
    - id_empresa es la llave primaria.
    - Cada fila de esta tabla indica el nombre y el ID de una empresa y la ciudad en la que se encuentra la empresa.
#### Ordenes:
    - id_orden es la llave principal.
    - id_empresa es una llave foránea a id_empresa de la tabla Empresa.
    - id_vendedor es una llave foránea a id_vendedor de la tabla Vendedores.
    - Cada fila de esta tabla contiene información sobre un pedido. Esto incluye el ID de la empresa, el ID del vendedor, la fecha del pedido y el monto pagado.

1. Escriba una consulta SQL para informar los nombres de todos los vendedores que no tenían ningún pedido relacionado con la empresa con el nombre "RED". Devuelva la tabla de resultados en cualquier orden. El formato del resultado de la consulta se muestra en el siguiente ejemplo.

```sql
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
```

2. Escriba una consulta SQL para informar la cantidad total de dinero que ha recaudado un vendedor por cada empresa que alguna vez le ha realizado una orden. Ordene el resultado por monto recaudado de forma ascendente.

```sql
SELECT Vendedores.nombre as Nombre, Empresa.nombre as Empresa, SUM(Ordenes.qty) as Recaudado
FROM Vendedores
	INNER JOIN Ordenes ON Vendedores.id_vendedor = Ordenes.id_vendedor
	INNER JOIN Empresa ON Ordenes.id_empresa = Empresa.id_empresa
GROUP BY Vendedores.nombre, Empresa.nombre
ORDER BY Recaudado DESC
```

## 4. Diseñar y codificar una interface que simule la popular aplicación https://www.reddit.com/. De lo anterior como mínimo se espera tener las siguientes funcionalidades:
1. Listar publicaciones por fecha (del más reciente al más antiguo:
    * Fecha de publicación
    * Usuario que publica
    * Número de votos
2.	Inicio de sesión (usuario, contraseña) 
#### (No obligatorio) Requiere autenticación para acceder a las siguientes funcionalidades.
3. Crear una publicación (título, contenido (puede ser solo texto), fecha de creación, usuario creador, cantidad de votos).
4. Editar una publicación.
5. Eliminar una publicación.
6. Añadir voto o quitar voto de una publicación (solo un voto por usuario).

**Se puede orientar al desarrollo web o al desarrollo móvil.**
**Se puede utilizar la tecnología de desarrollo con la que se sienta más a gusto.**
**Se puede valer de tecnologías como firebase o afines para presentar una solución.**
**Se tendrán en cuenta factores como rendimiento y el diseño de la propia interface**


#### 5.	(No obligatorio) Realizar una macro en Excel que permita recorrer una lista de personas. En dicho recorrido se debe seleccionar las personas del sexo masculino y con ellas crear una nueva lista en una nueva hoja de Excel.

```vb
Sub FiltrarPorSexo()
        Dim HojaOriginal As Worksheet
        Dim HojaNueva As Worksheet
        Dim filaOriginal As Long
        Dim filaNueva As Long
        Dim ultimaFila As Long

        Set HojaOriginal = ThisWorkbook.Sheets("Hoja2")
        Set HojaNueva = ThisWorkbook.Sheets.Add

        HojaOriginal.UsedRange.Copy Destination:=HojaNueva.Range("A1")

        ultimaFila = HojaOriginal.Cells(HojaOriginal.Rows.Count, 1).End(xlUp).Row

        filaNueva = 2
	   
        For filaOriginal = ultimaFila To 2 Step -1
            If Trim(HojaOriginal.Cells(filaOriginal, 5).Value) <> "Hombre" Then
                HojaNueva.Rows(filaOriginal).Delete
        End If
    Next filaOriginal
	   
    ultimaFila = HojaNueva.Cells(HojaNueva.Rows.Count, 1).End(xlUp).Row

    HojaNueva.Range("A1:J1").AutoFilter
    HojaNueva.Cells.EntireColumn.AutoFit
End Sub
```


