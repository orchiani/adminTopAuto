<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido de venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif;
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        width: 25%;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #000000;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
        background: #fbc02d;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #fbc02d;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facarticulo thead{
        padding: 20px;
        background: #fbc02d;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
        }

        #gracias{
        text-align: center;
        }
    </style>
    <body>
        @foreach ($cabecera as $v)
        <header>
            <div id="logo">
                <img src="img/logo.jpg" alt="TopAuto" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>ACCESORIOS TOP AUTO S.A.</b><br>Magallanes 4409 C.P. 7600) Mar Del Plata, Buenos Aires<br>Telefono: 02234807178/4801481 +542235304926<br>ventas@accesoriostopauto.com<br>www.accesoriostopauto.com<br>I.V.A Responsable Inscripto
                </p>
            </div>
        </header>
        <br>
        <section>
        <div id="fact">
                <p>Numero de pedido<br>
                {{$v->numero}}</p>
            </div>
            <div>
                <table id="facliente">
                    <thead>
                        <tr>
                            <th id="fac">Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">{{$v->razon_social}}<br>
                           Cuit / Dni: {{$v->cuit}} <br>
                           Cuenta: {{$v->cuenta}}<br>
                           Dirección: {{$v->direccion}}<br>
                           Teléfono: {{$v->telefono}}<br>
                           Email: {{$v->email}}</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>Vendedor</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$v->usuario}}</td>
                            <td>{{$v->created_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>P. unitario</th>
                            <th>P. total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                            <td>{{$det->codigo}}</td>
                            <td>{{$det->producto}}</td>
                            <td>{{$det->cantidad}}</td>
                            <td>$ {{$det->precio}}</td>
                            <td>$ {{ $det->precio * $det->cantidad}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                    <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$ {{round($v->total / ( 1+ $v->descuento / 100), 0)}}
                            <td>{{$v->descuento}} %</td>
                            <td>$ {{$v->total}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

            </div>
        </section>
        <br>
        <br>

    </body>
</html>
