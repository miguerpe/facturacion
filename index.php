<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
	<h3>MENU FACTURACIÓN</h3>
        <form action="registrarFactura.php" method="get">
			<h3>Nueva factura</h3>
            No. de Factura <input type="text" name="idFactura" value="" />
			Id Cliente <input type="text" name="idCliente" value="" />
            <button>Agregar</button>
        </form>
		</br>
        <form action="elimminarFactura.php">
		    <h3>Eliminar factura</h3>
            No. de Factura <input type="text" name="idFactura" value="" />
        <button>Eliminar</button>
        </form>
		</br>
			<h3>Lista de facturas</h3>
		    <form action="listadoFacturas.php">
            <button>Ver Lista</button>
        </form>
		</br>
        <form action="imprimirFactura.php">
			<h3>Imprimir factura</h3>
            Factura <input type="text" name="idFactura" value="" />
        <button>Imprimir</button>
        </form>
    </body>
</html>
