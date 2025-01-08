<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Arriendo</title>
<!--- --->
    <style>

        body { font-family: Arial Narrow, Normal; font-size:11; text-align: justify;}
        xxxtable { width: 100%; border-collapse: collapse; }
        table { border-collapse: collapse; }
        th, td { padding: 1px; border: 0px solid; text-align: left; vertical-align: top;}
        @page{
            margin: 2.9cm 0.8cm 1.2cm 0.8cm;
        }
        #header{
            position: fixed;
            top: -2.2cm;
            left: 0cm;
        }
        .imgHeader{
            float: left;
            width: 3cm;
        }
        .infoHeader{
            float: right;
            width: 19.5cm;
        }
        #footer{
            position: fixed;
            bottom: -1cm;
            left: 0cm;
            width: 100%;
            background-color: blueviolet;
        }
        .saltoPagina{
            page-break-after: always;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.12;
            font-size: 150px;
            color: #000;
            z-index: -1; /* Ensure the watermark is behind the text */
        }
        .watermark img {
            width: 600px;
            height: auto;
        }
        .content {
            position: relative;
            z-index: 1;
        }
    </style>
<!--- --->
</head>
<!--- body class="fontArialNarrow" --->
<body>
    <!---
    <div class="watermark">{{ $contrato->empresa->sigla }}</div>
    --->
    <div class="watermark">
        <img src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo) }}" alt="Watermark">
    </div>
    
    @php
        $el_articulo = 'el';
        $el_tipo = 'Modulo';    
    @endphp
    <div id="header">
        <img class="imgHeader" src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo) }}" alt="Logo de la Empresa" width="100px">
        <div class="infoHeader">
            <p align="right">Contrato {{ $contrato->ccosto->codigo }}/{{ $contrato->folioContrato }}<br>
            {{ $contrato->cliente->nombre }}</p>
        </div>
    </div>

<p align='center'><u><b><font size="+1">CONTRATO ARRIENDO {{ $contrato->ccosto->descripcion }}</font></b><br>
<b>{{ $el_tipo }} {{ $contrato->bodega->codigo }} DE {{ $contrato->bodega->mt2 }} m2</b></u></p>
<p>**** para direrenciar este seria del tipo LLM ****</p>
    <p>En Santiago, a <b>{{ \Carbon\Carbon::parse($contrato->fecha_ini)->translatedFormat('d \d\e F \d\e Y') }}</b>, 
        entre <b>{{ $contrato->cliente->nombre }}</b>, Rut: <b>{{ $contrato->cliente->rut }}</b>, Giro: <b>{{ $contrato->cliente->giro }}</b>, 
        representada por 
        <!--- Lista de los representantes legales --->
        @foreach ($contrato->contratoreplegals as $replegal)
            @if ($loop->last && !$loop->first) y @endif
            {{ $replegal->titulo }} <b>{{ $replegal->nombre}}</b>,  Rut: <b>{{ $replegal->rut }}</b>, 
        @endforeach
        <!--- FIN Lista de los representantes legales --->
        con domicilio en <b>{{ $contrato->cliente->direccion }},</b> <b>{{ $contrato->cliente->comuna->nombre }}</b>, 
        <b>{{ $contrato->cliente->comuna->ciudad->nombre }}</b>, 
        Teléfono: <b>@if (!is_null($contrato->cliente->telefono)) (+56){{ $contrato->cliente->telefono }} @else N/A @endif</b>, 
        Celular: <b>@if (!is_null($contrato->cliente->celular)) (+56){{ $contrato->cliente->celular }} @else N/A @endif</b>, 
        E-mail: <b>{{ $contrato->cliente->email }}</b>, por una parte, en adelante indistintamente también como el “<b>Cliente</b>”; 
        y por la otra, <b>{{ $contrato->empresa->razonsocial }}</b>, Rut No. <b>{{ $contrato->empresa->rut }}</b>, 
        representada por don <b>{{ $contrato->empresa->repl_nombre }}</b>, chileno, casado, Rut No. <b>{{ $contrato->empresa->repl_rut }}</b>, 
        con domicilio en calle <b>{{ $contrato->empresa->direccion }}</b>, comuna de <b>{{ $contrato->empresa->comuna->nombre }}</b>, 
        ciudad de <b>{{ $contrato->empresa->comuna->ciudad->nombre }}</b> en adelante indistintamente también como “<b>{{ $contrato->empresa->sigla }}</b>”, 
        quienes vienen en celebrar el siguiente contrato de arriendo, que se regirá por las disposiciones del Código Civil y del Código de 
        Comercio, así como por las cláusulas y estipulaciones que se expresan en adelante:</p>

        <b>PRIMERO: @for ($i = 0; $i < 25; $i++) &nbsp; @endfor <u>OBJETO</u></b><br>
        <ol type="a">
            <li>{{ $contrato->empresa->sigla }} entrega en arriendo al cliente el <b>{{ $el_tipo }} {{ $contrato->bodega->codigo }}</b> de 
                <b>{{ $contrato->bodega->mt2 }}</b> m2, ubicado en calle <b>{{ $contrato->empresa->direccionContrato }}</b>, comuna de 
                <b>{{ $contrato->empresa->comuna->nombre }}</b>, <b>{{ $contrato->empresa->comuna->ciudad->nombre }}</b></li>
            <li>El cliente solamente podrá usar el {{ $el_tipo }} para actividades propias de su giro.</li>
        </ol>
        <p></p>
        <b>SEGUNDO: @for ($i = 0; $i < 17; $i++) &nbsp; @endfor <u>INICIO, VIGENCIA Y GARANTIA</u></b><br>
        <ol type="a">
        <li>Las cláusulas establecidas en este contrato empezarán a regir desde el <b>{{ \Carbon\Carbon::parse($contrato->fecha_ini)->translatedFormat('d \d\e F \d\e Y') }}</b>, 
            fecha en la cual el cliente pagará el canon de arriendo proporcional correspondiente al primer mes y 1 mes de garantía equivalente 
            a <b>${{ number_format($contrato->montoGarantia, 0) }}</b>.- que será devuelto una vez que se termine el contrato. La garantía se dará por cancelada una 
            vez que el cliente envíe comprobante de transferencia y se otorgue por parte de {{ $contrato->empresa->sigla }} un Recibo de Garantía, debido a que 
            ésta no es facturable.</li>
        <li>El presente contrato será por mes calendario, renovable mes a mes en forma indefinida, por lo que cualquiera de las partes podrá ponerle término y sin 
            expresión de causa dando a la otra un aviso por escrito de a lo menos con 15 días corridos de anticipación al término del mes correspondiente a través 
            de carta certificada enviada al domicilio que consta en la comparecencia de este instrumento.</li>
        <li>Antes de que termine el contrato el cliente deberá retirar el total de la mercadería almacenada. Transcurrida la fecha de término de contrato sin que 
            el cliente, mandatario o representante hubiere retirado las especies o mercaderías que depositó, se entenderá que las ha abandonado y 
            {{ $contrato->empresa->sigla }}, discrecionalmente, tendrá las siguientes facultades:</li>
        <ol type="i">
            <li>Proceder a la venta de todo o parte de las mercaderías almacenadas en el {{ $el_tipo }} por medio de un martillero público de libre elección de 
                {{ $contrato->empresa->sigla }}. El producto del remate se imputará en la parte que corresponda al pago de las obligaciones adeudadas para con 
                {{ $contrato->empresa->sigla }} y el saldo, si lo hubiere, quedará en cuenta corriente a disposición del cliente por un periodo máximo de 180 
                días al término del cual se entenderá que los fondos quedan en beneficio exclusivo de {{ $contrato->empresa->sigla }}; o,</li>
            <li>Eliminar del {{ $el_tipo }} todo o parte de las especies o mercaderías de que se trate, sin procedimiento, formalidad o solemnidad alguna, 
                encontrándose expresamente eximida de toda responsabilidad respecto de aquellas, cualquiera sea la naturaleza de la responsabilidad, debiendo el 
                cliente abonar los gastos que produjo el traslado o eliminación de las mismas.</li>
        </ol>
        <li>En situaciones de caso fortuito o fuerza mayor que escapen del control razonable de las partes tales como caídas de energía, huelgas, lock outs, eventos 
            imprevistos de la naturaleza o del hombre, etc., relevarán a la parte afectada del cumplimiento de sus obligaciones hasta que termine el hecho que 
            la motivó. En todo caso, tan pronto ocurra el hecho, deberá ser suficientemente informado a la otra parte a fin de tomarse las medidas de mitigación 
            que el caso requiera.</li>
        <li>Si no se pudiere subsanar el impedimento dentro de plazos y parámetros razonables y que hagan imposible la completa ejecución del presente contrato, 
            se procederá a ponerle término anticipadamente incluso sin esperar el plazo de que da cuenta la Segunda cláusula inciso b), lo que en todo caso deberá 
            verificarse de común acuerdo entre las partes.</li>
    </ol>
    <p></p>
        <b>TERCERO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>ALMACENAMIENTO</u></b><br>
        <ol type="a">
            <li>El cliente declara bajo juramento, que en caso de almacenar especies, estas son de su propiedad o que el cliente se encuentra debidamente facultado 
                por el propietario de las mismas para administrarlas libremente y que no se encuentran embargadas ni sujetas a procedimiento judicial. </li>
            <li>La descarga, carga, ubicación, control de existencias y manejo de las mercaderías será responsabilidad del cliente y serán realizadas por el 
                cliente o con personal contratado por éste. </li>
            <li>Será de exclusiva responsabilidad del cliente que la mercadería que almacena en {{ $contrato->empresa->sigla }} cuente con todos los permisos 
                y autorizaciones para su traslado, almacenaje, despacho, comercialización, etc., sean éstas de carácter aduaneras, sanitarias, municipales, 
                ambientales, tributarias y/o de cualquier otra autoridad.</li>
            <li>{{ $contrato->empresa->sigla }} no admitirá el almacenamiento en sus instalaciones, de sustancias peligrosas, explosivos, venenos, corrosivos, 
                productos inflamables, armas, líquidos, caldos, mercaderías, materiales que causen perjuicios a las instalaciones o a las personas o acarreen 
                trastornos en el desenvolvimiento normal de las instalaciones de {{ $contrato->empresa->sigla }} y se reserva el derecho de exigir el retiro 
                inmediato de las mercaderías que estime están causando daños o trastornos. El cliente que no obstante ingrese tal clase de mercaderías en 
                el {{ $el_tipo }}, responderá de todos los daños, perjuicios y gastos que puedan sobrevenir por incumplimiento de esta cláusula.</li>
            <li>Al cliente le estará prohibido efectuar cualquier tipo de procesos en el inmueble arrendado sin que medie autorización previa expresa y por 
                escrito de {{ $contrato->empresa->sigla }} En virtud de lo anterior y modo meramente ejemplar y de ninguna manera taxativo, no podrá instalar 
                talleres, fabricar, transformar, modificar, envasar, confeccionar, preparar, mezclar, trasvasijar cualquier tipo de productos o mercaderías, etc. 
                y/o prestar estos u otros servicios a terceros.</li>
            <li>Sin perjuicio de lo anterior, las especies o mercaderías señaladas en el párrafo anterior deberán ser retiradas por el cliente dentro del plazo 
                máximo de 5 días, contados desde que {{ $contrato->empresa->sigla }} ponga en su conocimiento esta situación al cliente, mandatario o representante. </li>
            <li>Transcurrido dicho plazo sin que el cliente, mandatario o representante hubiere retirado las especies o mercaderías que almacenó en infracción 
                a esta cláusula, se entenderá que las ha abandonado. En este caso {{ $contrato->empresa->sigla }} procederá a descerrajar el {{ $el_tipo }} y, 
                discrecionalmente, tendrá las siguientes facultades descritas en la cláusula Segunda inciso c).</li>
        </ol>
        <p></p>
        <b>CUARTO: @for ($i = 0; $i < 17; $i++) &nbsp; @endfor <u>RESPONSABILIDADES Y OBLIGACIONES</u></b><br>
        <ol type="a">
            <li>El cliente no podrá hacer modificaciones ni construcciones en el {{ $el_tipo }} arrendado sin autorización expresa de {{ $contrato->empresa->sigla }}.</li>
            <li><b>El cliente al término del contrato estará obligado a entregar a {{ $contrato->empresa->sigla }} el {{ $el_tipo }} vacío, limpio y sin pagos 
                pendientes</b>, de lo contrario se entenderá que las condiciones de entrega no fueron cumplidas por lo que el contrato continuará plenamente 
                vigente para todos los efectos legales hasta el momento que se perfeccione la entrega en conformidad al presente contrato. En el caso del pago 
                con cheque, sólo se entenderá que la deuda está pagada cuando el cheque sea liberado en la cuenta corriente de {{ $contrato->empresa->sigla }}.</li>
            <li>El cliente también es responsable de la limpieza, mantención, control de plagas, desratización y todas las labores necesarias para la mantención 
                de las mercaderías y del {{ $el_tipo }}. Para estos efectos podrá pedir a {{ $contrato->empresa->sigla }} personal y/o grúas horquillas con operador 
                de acuerdo a las tarifas establecidas en este contrato. También podrá pedir cebos de bloque sin costo para desratizar u otros servicios que serán 
                cotizados de acuerdo al 
                procedimiento establecido en este contrato.</li>
            <li>El presente contrato no constituye bajo ningún respecto relación laboral entre las partes ni de los empleados de {{ $contrato->empresa->sigla }} 
                respecto del cliente.</li>
            <li>Se prohíbe a las partes ceder en todo o parte el presente contrato así como los derechos u obligaciones que de él emanen.</li>
            <li>El cliente libera desde ya a {{ $contrato->empresa->sigla }} de toda responsabilidad por perjuicios, demandas o reclamaciones provenientes de 
                terceros en relación a las mercaderías almacenadas en {{ $contrato->empresa->sigla }}, materia de este contrato. Asimismo se obliga a asumir la 
                defensa de {{ $contrato->empresa->sigla }} y mantenerla indemne en caso de ser objeto de acciones, demandas, medidas, etc., así como a hacerse 
                cargo de las resultas y gastos de las mismas.</li>
            <li>{{ $contrato->empresa->sigla }} no se responsabiliza de las medidas tanto judiciales como prejudiciales de cualquier índole que recaigan sobre la 
                mercadería que tenga almacenada el cliente y que impliquen retenciones, embargos, precautorias, etc. así como de los perjuicios que de ello se 
                deriven para éste o para terceros.</li>
            <li>En ningún caso {{ $contrato->empresa->sigla }} será responsable del lucro cesante, pérdidas de ingresos, daños consecuenciales y del daño moral.</li>
            <li>El presente contrato es independiente de otros contratos que pueda haber celebrado {{ $contrato->empresa->sigla }} con el cliente o con otros 
                clientes, aunque sean relativos a materias similares a las que regula este contrato.</li>
            <li>El hecho de que cualquiera de las partes no insista en el cumplimiento estricto de cualquier obligación establecida en este contrato o no ejerza 
                las acciones legales que pudiera corresponderle, no deberá afectar, limitar o quitar a dicha parte el derecho posterior a exigir el cumplimiento 
                estricto de la misma obligación.</li>
            <li>La renuncia de cualquiera de las partes a tomar acción contra la otra por cualquier incumplimiento de las obligaciones o condiciones estipuladas 
                en este contrato, no podrá ser interpretada como una renuncia a la acción por cualquier otro incumplimiento posterior de la misma obligación.</li>
        </ol>
        <p></p>
        <b>QUINTO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>FACTURACION Y PAGOS</u></b><br>
        <ol type="a">
                <li>{{ $contrato->empresa->sigla }} facturará el arriendo en forma mensual, bajo el concepto de mes anticipado, de acuerdo a los precios 
                    establecidos en el <b>Anexo 1</b>.</li>
                <li>{{ $contrato->empresa->sigla }} facturará los Gastos Comunes, mensualmente y anticipados, de acuerdo a lo establecido en el presente 
                    contrato y a las tarifas del <b>Anexo 1</b>.</li>
                <li>Los demás servicios que {{ $contrato->empresa->sigla }} preste al cliente se facturarán bajo la modalidad de mes vencido, también de 
                    acuerdo a las tarifas del <b>Anexo 1</b>.</li>
                <li>{{ $contrato->empresa->sigla }} facturará al cliente el seguro por las mercaderías de acuerdo a lo establecido en el <b>Anexo 2</b>.</li>
                <li>El cliente se obliga al <b>pago de facturas al contado</b>, por concepto de arriendo del {{ $el_tipo }} y de cualquier otro servicio prestado 
                    por {{ $contrato->empresa->sigla }}, <b>dentro de 10 días de recibida cada factura</b>, en las oficinas de {{ $contrato->empresa->sigla }} ubicadas 
                    en {{ $contrato->empresa->direccionContrato }}, {{ $contrato->empresa->comuna->nombre }}. Además se obliga al pago de los impuestos y demás 
                    gastos que pudiere originar la suscripción de este contrato, los que serán pagados, conjuntamente con el precio de los demás 
                    servicios facturados.</li>
                <li>Para facilitar el pago de los servicios, {{ $contrato->empresa->sigla }} pone a disposición del cliente la posibilidad de pagar mediante 
                    el Pago Automático de Cuentas. Para usar este modo de pago debe llenar el mandato del <b>Anexo 4.</b></li>
                <li>{{ $contrato->empresa->sigla }} se reserva el derecho de negar el acceso al {{ $el_tipo }} y retener los bienes en su interior, hasta 
                    el pago íntegro de las facturas así como de cualquier otra obligación pendiente que este último mantuviere para con aquella.</li>
                <li>Sin perjuicio del derecho de retención sobre las especies almacenadas que el cliente le reconoce en forma expresa a {{ $contrato->empresa->sigla }} 
                    para seguridad de lo que aquí pudiere adeudarle con motivo del presente contrato, todo ello en conformidad con lo dispuesto en los artículos 
                    2234 y 2235 del Código Civil, por este acto el cliente confiere a {{ $contrato->empresa->sigla }} mandato especial irrevocable, en los términos del 
                    art. 241 del Código de Comercio para que en caso que el cliente incurra en mora o simple retardo en <b>dos o más meses</b> en el pago de una factura 
                    u obligación cualquiera para con {{ $contrato->empresa->sigla }}, ésta proceda a se pague el total de las cantidades adeudadas a través de la venta 
                    de todo o parte de las mercaderías almacenadas utilizando el procedimiento de venta descrito en la Segunda cláusula letra c) inciso i., precedente. 
                    Si el producto de la venta no alcanzare a cubrir lo adeudado, tal operación podrá efectuarse tantas veces como al efecto sea necesario. Así mismo 
                    con el producto del remate se pagarán los gastos y costos propios de éste, así como impuestos y honorarios del martillero. En caso de no cumplimiento 
                    del pago de las obligaciones, {{ $contrato->empresa->sigla }} queda facultado para descerrajar {{ $el_articulo }} {{ $el_tipo }} correspondiente 
                    y tomar posesión de la mercadería a objeto del remate de estas. </li>
                <li>{{ $contrato->empresa->sigla }} deberá dar aviso al cliente de su intención de rematar las mercaderías con el objeto señalado precedentemente, por 
                    medio de carta certificada dirigida al domicilio indicado en el presente contrato, con una anticipación mínima de 15 días corridos a la fecha del 
                    remate, plazo en el cual este último podrá pagar lo adeudado.</li>
                <li>El cliente autoriza irrevocablemente desde ya este procedimiento, estipulándose además que la mora o simple retardo en el cumplimiento de una o 
                    más obligaciones cualesquiera del cliente para con {{ $contrato->empresa->sigla }} se reajustará de acuerdo con la variación que experimente el 
                    Índice de Precios al Consumidor y devengará el interés máximo permitido. Tanto el reajuste como el interés se aplicarán entre la fecha de 
                    vencimiento de cada obligación y la fecha de su pago efectivo.</li>
                <li>Asimismo, por este acto el cliente libera expresamente a {{ $contrato->empresa->sigla }} de la obligación de rendir cuenta de su mandato y lo 
                    autoriza a que en caso de incumplimiento, simple retardo o mora en el pago de las obligaciones a que se refieran los documentos emitidos a su nombre 
                    tales como: contratos, facturas, pagares, letras u otros, los datos personales del cliente y los relacionados con los documentos emitidos 
                    sean ingresados en un sistema de información comercial público o en un registro de morosidades públicos pudiendo ser procesados, tratados y 
                    comunicados en cualquier forma o medio.</li>
                <li>Sin perjuicio de lo señalado anteriormente, en el evento que las mercaderías no sean susceptibles de ser rematadas dada su naturaleza o el estado 
                    en que se encuentren, lo cual será calificado unilateralmente por {{ $contrato->empresa->sigla }}, facultará a esta última para eliminar del 
                    {{ $el_tipo }} todo o parte de las especies o mercaderías de que se trate de acuerdo a la Segunda cláusula letra c) inciso ii. </li>
                <li>Si el cliente requiere generar una Orden de Compra previo a la facturación de los servicios, esta deberá ser emitida a más tardar el día 15 del 
                    mes en curso, para ser facturada anticipado los primeros días del mes siguiente. En caso de no recibirla dentro del plazo el cliente faculta a 
                    {{ $contrato->empresa->sigla }} para proceder a facturar sin la Orden de Compra. La Orden de Compra se hará en UF, en caso de hacerse en pesos 
                    se deberá hacer con el valor de la UF del día 1ro del mes siguiente.</li>
        </ol>
        <p></p>
        <b>SEXTO: @for ($i = 0; $i < 25; $i++) &nbsp; @endfor <u>SEGUROS</u></b><br>
        <ol type="a">
            <li>{{ $contrato->empresa->sigla }} no responderá por los perjuicios o pérdidas que se produzcan en las mercaderías por efecto de caso fortuito o de 
                fuerza mayor, huelgas, guerras, sedición o tumulto popular, vandalismo, actos terroristas, asalto a mano armada, fuego, robo, contaminación, 
                inundación, granizo, nieve, tormenta, terremoto, rayos, etc. </li>
            <li>Por tal razón el Cliente en este acto podrá contratar un seguro por su mercadería contra Robo, Incendio y Sismo. El seguro se cobrará a las tarifas 
                y con los deducibles indicados en el <b>Anexo 2</b>.</li>
            <li>El Cliente, junto con la firma del contrato deberá llenar el <b>Anexo 2</b> informando el costo de los bienes que se mantendrán del inmueble arrendado. 
                En el evento que dicho <b>Anexo 2</b> no sea completado conforme a lo señalado, se entenderá que el Cliente no requiere contratar seguros por lo 
                que asume todos los riesgos por deterioro o pérdida de la mercadería por cualquier causa. </li>
            <li>Si el cliente asegura con otra compañía aseguradora, renuncia a los derechos de subrogación en contra de {{ $contrato->empresa->sigla }} y la 
                compañía aseguradora que esta última tenga.</li>
            <li>Los riesgos, perjuicios y/o daños no cubiertos que pudieran producirse por cualquier causa, serán de exclusiva cuenta y cargo del cliente que 
                renuncia a toda indemnización por parte de {{ $contrato->empresa->sigla }} por los riesgos antes señalados. </li>
        </ol>
        <p></p>
        <b>SÉPTIMO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>HORARIOS</u></b><br>
        <ol type="a">
            <li>El cliente tendrá acceso al {{ $el_tipo }} los días hábiles de lunes a viernes de 8:30 a 18:30 horas. </li>
            <li>Fuera de este horario los días sábado de 8:30 a 13:00 tendrá y los días Hábiles de 18:30 a 19:30, el cliente tendrá acceso al {{ $el_tipo }} previo 
                aviso por escrito (carta o mail), para lo cual deberá avisar el día hábil anterior y ser confirmado por {{ $contrato->empresa->sigla }}.</li>
            <li>En caso de requerir servicios por parte de personal de {{ $contrato->empresa->sigla }} fuera del horario del punto a) anterior, se cobrarán 
                horas extra que se facturarán de acuerdo a las tarifas del <b>Anexo 1</b> y a las condiciones establecidas en este contrato. Además se cobrarán 
                de los costos involucrados en los servicios prestados.</li>
        </ol>
        <p></p>
        <b>OCTAVO: @for ($i = 0; $i < 22; $i++) &nbsp; @endfor <u>RETIRO</u></b><br>
        <ol type="a">
            <li>Todo retiro total de mercaderías almacenadas deberá ser avisado con al menos un (1) día hábil de anticipación para que esta sea autorizada 
                por {{ $contrato->empresa->sigla }}. Para proceder a dicho retiro el cliente deberá:</li>
            <ol type="a">
                <li>Estar al día en todos los pagos que se hayan generado por los servicios prestados por {{ $contrato->empresa->sigla }}. En el 
                    caso del pago con cheque, sólo se entenderá que la deuda está pagada cuando el cheque sea liberado en la cuenta corriente 
                    de {{ $contrato->empresa->sigla }}.</li>
                <li>Estar cumplidas todas las obligaciones señaladas en el presente contrato y pagadas todas las facturas por concepto de rentas 
                    de arrendamiento, considerándose ésta(s) como de plazo vencido en la fecha efectiva de retiro de las mercaderías para todos 
                    los efectos legales.</li>
            </ol>
        </ol>
        <p></p>
        <b>NOVENO: @for ($i = 0; $i < 15; $i++) &nbsp; @endfor <u>CONTRATACION DE PERSONAL</u></b><br>
        <ol type="a">
            <li>Si el cliente contrata directa o indirectamente, durante la vigencia del presente contrato y hasta 90 días después de su término, 
                a algún trabajador que realice sus labores en las instalaciones administradas por {{ $contrato->empresa->sigla }}, el cliente 
                deberá indemnizar al empleador con un monto equivalente a las últimas 4 remuneraciones del trabajador contratado, directa o 
                indirectamente, por parte del cliente. Este cobro corresponde al costo de reclutamiento, capacitación y entrenamiento que se 
                hace al personal que trabaja en las instalaciones de {{ $contrato->empresa->sigla }}.</li>
            <li>Para los efectos de esta cláusula se entenderá por remuneración: sueldos, bonos imponibles y exentos, premios, gratificaciones, 
                seguros, seguros de cesantía, cotizaciones previsionales y de salud, mutuales, vacaciones, finiquitos y cualquier otro costo 
                imputable al trabajador en que el empleador haya incurrido.</li>
        </ol>
        <p></p>
        <b>DÉCIMO: @for ($i = 0; $i < 25; $i++) &nbsp; @endfor <u>TARIFAS</u></b><br>
        <ol type="a">
            <li>Las <b>tarifas</b> por los servicios que contempla el presente contrato serán las indicadas en el <b>Anexo 1</b> que es parte 
                integrante de este contrato. Cualquier cambio en las tarifas será avisado por {{ $contrato->empresa->sigla }} por escrito con 
                al menos 60 días corridos de anticipación.</li>
            <li>Los precios del Anexo 1 están expresados en Unidades de Fomento (UF) y son netos más IVA. El valor del {{ $el_tipo }} mensual 
                se facturará por mes anticipado. El valor correspondiente a servicios adicionales se facturará mensualmente, basándose en la 
                liquidación de lo realizado en el mes.</li>
            <li>Las tarifas por servicios no incluidos en este contrato serán informadas al cliente por escrito (e-mail, carta) antes de prestar 
                el servicio. Una vez que {{ $contrato->empresa->sigla }} reciba la aceptación de las tarifas por parte del Cliente también por 
                escrito, pasarán a ser parte integrante de este contrato.</li>
            <li>Si la Unidad de Fomento (UF) dejare de ser un padrón de reajustabilidad diaria o variare su base de cálculo, los valores antes 
                indicados se reajustarán en la misma proporción en que varíe el Índice de Precios al Consumidor (IPC) con un mes de desfase 
                entre la fecha en que ocurriere el hecho descrito y la fecha del pago efectivo de la obligación, calculándose al efecto los 
                reajustes por numerales diarios respecto de la variación que haya experimentado el IPC entre la fecha de dicho hecho y la fecha 
                del pago efectivo de la obligación, de modo que, el reajuste se aplicará en los mismos términos y condiciones que se aplicaría 
                si es que se continuare con el sistema de reajustabilidad de la UF.</li>
        </ol>
        <p></p>
        <b>UNDÉCIMO: @for ($i = 0; $i < 10; $i++) &nbsp; @endfor <u>SERVICIOS, GASTOS COMUNES, ESTACIONAMIENTOS Y OTROS</u></b><br>
        <ol type="a">
            <li>En caso de contratar servicios de {{ $contrato->empresa->sigla }} adicionales al arrendamiento del {{ $el_tipo }}, el cliente 
                deberá pagar el valor de los mismos a los precios establecidas en este contrato. Los servicios de {{ $contrato->empresa->sigla }} 
                deberán ser solicitados con 1 día hábil de anticipación y ser debidamente confirmados por {{ $contrato->empresa->sigla }}.</li>
            <li><b>Gastos Comunes:</b> Mensualmente {{ $contrato->empresa->sigla }} cobrará al Cliente un monto por concepto de Gastos Comunes. 
                Este cobro es para cubrir los costos de mantención y aseo de áreas comunes.</li>
            <li><b>Electricidad y Agua:</b> Los gastos comunes no consideran uso de electricidad y/o agua, estos consumos se cobrarán aparte. 
                Sin embargo, los consumos de iluminación del {{ $el_tipo }} no se cobrarán adicionalmente.</li>
            <li>Si el cliente requiere un uso mayor de energía eléctrica derivada de electrodomésticos, a parte del {{ $el_tipo }}, equipos 
                de frío o cualquier otro equipo eléctrico, deberá informarlo a {{ $contrato->empresa->sigla }}. {{ $contrato->empresa->sigla }} 
                deberá aprobar por escrito el consumo solicitado.</li>
            <li>En caso de ser aprobado, {{ $contrato->empresa->sigla }} facturará al cliente el consumo proporcionalmente al costo total de 
                energía pagado por {{ $contrato->empresa->sigla }} al proveedor eléctrico, el cual se recargará en un 20%. Para realizar este 
                cobro se instalará un remarcador eléctrico.</li>
            <li>Si el consumo eléctrico requerido es mayor a la capacidad instalada en {{ $el_articulo }} {{ $el_tipo }}, {{ $contrato->empresa->sigla }} 
                evaluará la factibilidad técnica del consumo solicitado y de ser factible cotizará la instalación eléctrica necesaria. </li>
            <li>Del mismo modo se procederá con el uso del agua.</li>
            <li><b>Estacionamientos:</b> los vehículos particulares y de transporte solamente pueden estacionar dentro de la propiedad durante 
                las labores de carga y descarga, máximo 2 horas al día por vehículo.</li>
            <li>Los vehículos de transporte deberán esperar afuera de las instalaciones hasta el momento de su turno para ser descargados 
                o cargados.</li>
            <li>En caso de requerir un estacionamiento por todo el día o día y noche el cliente deberá informar a {{ $contrato->empresa->sigla }}, 
                quién facturará el servicio de estacionamiento de acuerdo a las tarifas del <b>Anexo 1</b>.</li>
            <li>El lugar de estacionamiento será asignado de acuerdo a la disponibilidad de los mismos.</li>
            <li>Los vehículos no informados se cobrarán a la tarifa diaria.</li>
        </ol>
        <p></p>
        <b>DUODÉCIMO: @for ($i = 0; $i < 17; $i++) &nbsp; @endfor <u>ARBITRAJE</u></b><br>
        <ol type="a">
            <li>Cualquier dificultad que se pueda producir con motivo de este contrato, su interpretación, aplicación, validez, nulidad o 
                cualquiera otra, será resuelta en calidad de árbitro mixto y en única instancia por un árbitro designado de común acuerdo entre 
                las partes. En caso de no aceptar o no poder ejercer el cargo, la designación del árbitro será hecha por la Justicia 
                Ordinaria. El arbitraje tendrá lugar en la ciudad de Santiago.</li>
        </ol>
        <p></p>
        <b>DECIMOTERCERO: @for ($i = 0; $i < 15; $i++) &nbsp; @endfor <u>DOMICILIO</u></b><br>
        <ol type="a">
            <li>Las partes fijan domicilio convencional en la ciudad y comuna de Santiago para todos los efectos legales que pudieren emanar 
                del presente contrato y se someten expresamente a la competencia y jurisdicción del Tribunal Arbitral que se designe conforme 
                lo expresado en la cláusula Quinta precedente.</li>
        </ol>
        <p></p>
        <b>DECIMOCUARTO: @for ($i = 0; $i < 17; $i++) &nbsp; @endfor <u>FIRMA</u></b><br>
        <ol type="a">
            <li>El presente contrato se firma en dos ejemplares del mismo tenor, quedando uno en poder de cada una de las partes.<br>
            No obstante lo señalado en la comparecencia del presente instrumento, quienes se individualizan como representantes de las partes 
            viene en declarar expresamente que asumen sobre sí todas las responsabilidades a que diere lugar la insuficiencia o inexistencia 
            del mandato en virtud del cual comparecen en representación del cada parte, obligándose cada uno personalmente para con la 
            contraparte a pagarle todas aquellas sumas que se adeuden y/o los perjuicios que se le hubiesen producido. Lo anterior, sin 
            perjuicio de las demás responsabilidades legales que pudieren corresponderle en conformidad a la ley.</li>
        </ol>
        <p></p>
    
        <br><br><br>
        <table>
            <tbody>
                <tr>
                <!--- Firma de los Rep.Legales del Cliente --->
                @foreach ($contrato->contratoreplegals as $replegal)
                    <td>_________________________<br>
                        Depositante<br>
                        R.L.: {{ $replegal->nombre}}<br>
                        RUT: {{ $replegal->rut}}<br>
                        {{ $contrato->cliente->sigla }}
                    </td>
                    @endforeach
                    <!--- FIN Firma de los Rep.Legales del Cliente --->
                    <td>_________________________<br>
                        p.p. {{ $contrato->empresa->sigla }}<br>
                    </td>
                </tr>
            </tbody>
        </table>
        
<!---  SALTO DE PAGINA --->
<div class="saltoPagina"></div>

<p align='center'><u><b><font size="+1">ANEXO 1: TARIFAS</font></b></u></p>
<table>
    <tbody>
        <tr>
            <td>Tipo Arriendo:</td><td>: {{ $contrato->tipoArriendo }}</td>
        </tr>
        <tr>
            <td>Valor Arriendo:</td><td>: {{ $contrato->valorArriendo }} U.F.</td>
        </tr>
        @if ($contrato->montoMinimo > 0.0)
        <tr>
            <td>Minimo:</td><td>: {{ $contrato->montoMinimo }} {{ $contrato->unimedMinimo }}</td>
        </tr>
        @endif
        @if ($contrato->gcomun->valor > 0.0)
        <tr>
            <td>Gascos Comunes:</td><td>: {{ $contrato->gcomun->descripcion }}</td>
        </tr>
        @endif
        @if ($contrato->gadmin->valor > 0.0)
        <tr>
            <td>Gascos de Administracion:</td><td>: {{ $contrato->gadmin->descripcion }}</td>
        </tr>
        @endif

        
        <br><b>SERVICIOS ADICIONALES:</b></td></tr>
        @foreach ($valores as $valor)
        <tr>
            <td>{{ $valor->servicio->descripcion }}</td>
            <td>: {{ $valor->valor }} UF por C/ {{ $valor->servicio->uni_cobro->descripcion }}</td>
        </tr>
        @endforeach
    
    </tbody>
</table>
<p><b>NOTAS:</b></p>
(1): Las horas extra incluyen 1 persona. Los días sábado se cobra un mínimo de 2 horas extra.<br>
(2): Las horas extra incluidas en esta tarifa son las realizadas los días hábiles de 7:00 a 8:30 y/o de 18:30 a 19:30 y los sábados de 8:30 a 13:00 hrs.<br>
Los precios están expresados en Unidades de Fomento (UF) y son netos más IVA. El valor del {{ $el_tipo }} mensual y los gastos comunes se facturarán 
por mes anticipado. El valor correspondiente a servicios adicionales se facturará mensualmente, basándose en la liquidación de lo realizado en el mes.


<!---  SALTO DE PAGINA --->
<div class="saltoPagina"></div>

<p align='center'><u><b><font size="+1">ANEXO 2: SEGURO</font></b></u></p>

<p>Los bienes en {{ $el_articulo }} {{ $el_tipo }} arrendado contarán con seguro contra Robo, Incendio y Terremoto, amparado por la <b>Póliza 
de Seguro Nro. {{ $contrato->pseguro->polizaSeguro }} de {{ $contrato->pseguro->ciaSeguro }}</b>, la cual declaramos conocer y aceptar en 
todas sus partes.</p>
El costo de los bienes almacenados en {{ $el_articulo }} {{ $el_tipo }} es de: 
@if ($contrato->montoAsegurado > 0) 
    <b>{{ number_format($contrato->montoAsegurado, 0) }} de {{ $contrato->monedaSeguro->codigo }} declarados.</b> 
@else 
    <b>_______________________.</b> 
@endif <p></p>
Dentro de los últimos 5 días hábiles de cada mes, el cliente deberá informar el costo del inventario depositado en {{ $el_articulo }} {{ $el_tipo }} 
para ser declarado a la Compañía de Seguros. En caso de no recibir comunicación de parte del cliente, {{ $contrato->empresa->sigla }} asumirá que 
el último valor informado se mantiene.
<p></p>
<h3>1) <u> CONTRATACION DE SEGURO POR {{ $contrato->empresa->sigla }}:</u></h3>
La Póliza de Seguro que contrata el arrendatario de acuerdo a la cláusula Sexta es la <b>Nro. {{ $contrato->pseguro->polizaSeguro }} de 
{{ $contrato->pseguro->ciaSeguro }}</b>. El <b>deducible</b> de la póliza se definirá de acuerdo a la siguiente tabla:<p></p>
<p></p><p></p>
<table>
    <thead>
        <tr>
            <th>Cia.de seguros</th>
            <th>Tasa Anual</th>
            <th>Deducible Mínimo<br>Robo e Incendio</th>
            <th>Deducible Mínimo<br>Terremoto</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $contrato->pseguro->ciaSeguro }}</td>
            <td>{{ $contrato->pseguro->valor }} %</td>
            <td>{{ $contrato->pseguro->monedaDeducibleRoboIncendio->simbolo }} {{ number_format($contrato->pseguro->montoDeducibleRoboIncendio,0) }}</td>
            <td>{{ $contrato->pseguro->monedaDeducibleTerremoto->simbolo }} {{ number_format($contrato->pseguro->montoDeducibleTerremoto,0) }}</td>
        </tr>
    </tbody>
</table>
<br><br><br>
<table>
    <tbody>
        <tr>
        @foreach ($contrato->contratoreplegals as $replegal)
            <td>_________________________<br>
                Firma Representante Legal<br>
                R.L.: {{ $replegal->nombre}}<br>
                {{ $contrato->cliente->sigla }}
            </td>
        @endforeach
        </tr>
    </tbody>
</table>
<h3>2) <u> RENUNCIA EXPRESA DE SEGURO CONTRATADO POR {{ $contrato->empresa->sigla }}:</u></h3>
Solicitamos <b>NO contratar seguro</b> por los bienes en {{ $el_articulo }} {{ $el_tipo }} arrendado, renunciando además a los derechos de 
subrogación en contra de {{ $contrato->empresa->sigla }}.<br><br><br>
<table>
    <tbody>
        <tr>
        @foreach ($contrato->contratoreplegals as $replegal)
            <td>_________________________<br>
                Firma Representante Legal<br>
                R.L.: {{ $replegal->nombre}}<br>
                {{ $contrato->cliente->sigla }}
            </td>
        @endforeach
        </tr>
    </tbody>
</table>

<!---  SALTO DE PAGINA --->
<div class="saltoPagina"></div>

<p align='center'><u><b><font size="+1">ANEXO 3: AVISOS Y COMUNICACIONES</font></b></u></p>

Todo aviso entre las partes deberá efectuarse por escrito, debiendo ser remitido por carta certificada o mail. Los avisos relativos al 
contrato deberán enviarse al representante legal.
<p></p>
Los avisos sólo serán válidos si son remitidos a las direcciones postales o de correos electrónicos que a continuación se indican, 
a menos que alguna de las partes haya dado aviso a la otra de una nueva dirección postal o de correo electrónico: 
<p></p>
<h3>I. CLIENTE: <u>{{ $contrato->cliente->nombre }}</u></h3>
Dirección: {{ $contrato->cliente->direccion }}, {{ $contrato->cliente->comuna->nombre }}, {{ $contrato->cliente->comuna->ciudad->nombre }}.
<p></p>
<b>Representante Legal</b>
<table>
    <tbody>
        @foreach ($contrato->contratoreplegals as $replegal)
        <tr>
            <td></td>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
                * Celular<br>
            </td>
            <td>
                : @if($replegal->nombre <> '') {{ $replegal->nombre }} @else n/a @endif <br>
                : @if($replegal->email <> '') {{ $replegal->email }} @else n/a @endif <br>
                : @if($replegal->telefono <> '') {{ $replegal->telefono }} @else n/a @endif <br>
                : @if($replegal->celular <> '') {{ $replegal->celular }} @else n/a @endif <br>
            </td>
        </tr>
        <tr><br></tr>
        @endforeach
    </tbody>
</table>
<b>Encargado Pago Proveedores</b>
<table>
    <tbody>
        @foreach ($contrato->contratopagoproveedors as $pagoproveedor)
        <tr>
            <td></td>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
                * Celular<br>
            </td>
            <td>
                : @if($pagoproveedor->nombre <> '') {{ $pagoproveedor->nombre }} @else n/a @endif <br>
                : @if($pagoproveedor->email <> '') {{ $pagoproveedor->email }} @else n/a @endif <br>
                : @if($pagoproveedor->telefono <> '') {{ $pagoproveedor->telefono }} @else n/a @endif <br>
                : @if($pagoproveedor->celular <> '') {{ $pagoproveedor->celular }} @else n/a @endif <br>
            </td>
        </tr>
        @endforeach
        <tr><br></tr>
    </tbody>
</table>
<b>E-mail para Facturación Electrónica</b>
<table>
    <tbody>
        @foreach ($contrato->contratodtemails as $dtemail)
        <tr>
            <td></td>
            <td>
                * E-Mail
            </td>
            <td>
                : @if($dtemail->email <> '') {{ $dtemail->email }} @else n/a @endif 
            </td>
        </tr>
        @endforeach
        <tr><br></tr>
    </tbody>
</table>
<b>Coordinador</b>
<table>
    <tbody>
        @foreach ($contrato->contratocoordinadors as $coordinador)
        <tr>
            <td></td>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
                * Celular<br>
            </td>
            <td>
                : @if($coordinador->nombre <> '') {{ $coordinador->nombre }} @else n/a @endif <br>
                : @if($coordinador->email <> '') {{ $coordinador->email }} @else n/a @endif <br>
                : @if($coordinador->telefono <> '') {{ $coordinador->telefono }} @else n/a @endif <br>
                : @if($coordinador->celular <> '') {{ $coordinador->celular }} @else n/a @endif <br>
            </td>
        </tr>
        <tr><br></tr>
        @endforeach
    </tbody>
</table>

<h3>II. {{ $contrato->empresa->sigla }}:</h3>
Dirección: {{ $contrato->empresa->direccion }}, {{ $contrato->empresa->comuna->nombre }}, {{ $contrato->empresa->comuna->ciudad->nombre }}.
<p></p>
<b>Jefe de Bodega</b>
<table>
    <tbody>
        <tr>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
            </td>
            <td>
                : Alfonso Yañez<br>
                : llm@storage.cl<br>
                : 2 2636 8850 - 2 2636 8860<br>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
<b>Oficina Bodega</b>
<table>
    <tbody>
        <tr>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
            </td>
            <td>
                : Lucas Medina<br>
                : cvicun@storage.cl<br>
                : 2 2636 8860<br>
            </td>
        </tr>
    </tbody>
    </table>
<p></p>
<b>Pago Facturas (Cobrabzas)</b>
<table>
    <tbody>
        <tr>
            <td>
                * Banco<br>
                * Cuenta Corriente<br>
                * Razón Social<br>
                * Rut<br>
                * E-Mail<br>
                * Teléfono<br>
            </td>
            <td>
                : BCI<br>
                : 10513167<br>
                : STORAGE S.A.<br>
                : 84.180.100-8<br>
                : cobranzas@storage.cl<br>
                : 2 2636 8800<br>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
<b>Sub Gerente de Gestión (Coordinador Contrato)</b>
<table>
    <tbody>
        <tr>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
            </td>
            <td>
                : Manuel Gutiérrez<br>
                : gestion@storage.cl<br>
                : 2 2636 8813<br>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
<b>Gerente Comercial</b>
<table>
    <tbody>
        <tr>
            <td>
                * Nombre<br>
                * E-Mail<br>
                * Teléfono<br>
            </td>
            <td>
                : José Luis Eguiguren<br>
                : jleguiguren@storage.cl<br>
                : 2 2636 8800<br>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
                                                            
<!---  SALTO DE PAGINA --->
<div class="saltoPagina"></div>

<font size="-1">

<p align='center'><b>ANEXO 4: MANDATO PAGO AUTOMÁTICO DE CUENTAS</b></p>
<p>Por el presente instrumento, el cliente, que se individualiza más adelante e indistintamente denominado el “Mandante”, otorga el presente 
    mandato e instruye al Banco que se indica en este instrumento, para que éste proceda a pagar a {{ $contrato->empresa->sigla }}, 
    Rut: {{ $contrato->empresa->rut }} en adelante denominada la “Empresa”, por los cobros de servicios que ésta le presente, mediante cargo 
    en la cuenta bancaria que se señala al final de este instrumento. Este cargo podrá reintentarse en el caso de no encontrar fondos. </p>
<p>El Mandante se obliga a proveer y mantener los fondos disponibles en la cuenta bancaria señalada, incluidos los de su línea de crédito 
    automática y/o línea de sobregiro si la tuviere, para cubrir estos cargos. </p>
<p>El presente mandato comenzará a regir a contar del momento en que la “Empresa” informe al Mandante que los montos de las boletas o facturas 
    se cancelarán a través del sistema de pago electrónico de cuentas. Este aviso se hará por correo electrónico al E-mail que el Mandante 
    defina en este mandato. Este Mandato no revoca y es complementario a otros mandatos conferidos al Banco. </p>
<p>El presente mandato se otorga por un plazo indefinido, sin perjuicio de que el Mandante pueda revocarlo mediante una notificación por 
    escrito al Banco con una anticipación mínima de 30 días corridos. Además, el presente Mandato expirará en el evento que el Mandante 
    cierre la cuenta bancaria individualizada, o que ésta fuera cerrada por cualquier causa, motivo o circunstancia, por revocación del 
    prestador o de él (los) suscriptores o por voluntad unilateral del Banco. </p>
<p>Se deja constancia de que este mandato vincula directamente al Mandante con el Banco, quedando liberada la Empresa de cualquier 
    responsabilidad, salvo en lo referido al suministro oportuno, completo, y correcto de la información al Banco del Mandante para los 
    cobros respectivos, caso en el cual el Banco quedará liberado de toda responsabilidad. </p>
<b><u>Datos del mandante (titular de la Cuenta Bancaria) </u></b><br>
Nombre Empresa Mandante: 	<u>{{ $contrato->cliente->nombre }}</u><br>
RUT Empresa Mandante:	<u>{{ $contrato->cliente->rut }}</u><br>
Teléfono: 	_________________________<br>
E-mail: 	_________________________<br>
Banco:	_________________________<br>
Sucursal:	_________________________<br>
Número de Cuenta:	_______________________<br>
Tipo de Cuenta:	_______________________ (Si es cuenta vista adjuntar fotocopia CI)<br>
<br><b><u>(Uso Storage S.A.)</u></b><br>
Identificación del Servicio (13 caracteres libres + RUT mandante sin puntos ni guiones) <br>
@php
//    // Obtener los primeros 3 caracteres de $contrato->empresa->sigla, rellenar con 'X' si es necesario
//    $sigla = substr($contrato->empresa->sigla, 0, 3);
//    $sigla = str_pad($sigla, 3, 'X');
//    // Obtener los primeros 5 caracteres de $contrato->bodega->codigo, rellenar con 'X' si es necesario
//    $codigoBodega = substr($contrato->ccosto->codigo, 0, 5);
//    $codigoBodega = str_pad($codigoBodega, 5, 'X');
//    // Convertir $contrato->folioContrato a una cadena de 5 caracteres con ceros a la izquierda
//    $folioContrato = str_pad($contrato->folioContrato, 5, '0', STR_PAD_LEFT);
//    // Limpiar $contrato->cliente->rut de los caracteres '.' y '-'
//    $rutCliente = str_replace(['.', '-'], '', $contrato->cliente->rut);
//    // Concatenar todas las partes para obtener el resultado final
//    $numConvenio = $sigla . $codigoBodega . $folioContrato . $rutCliente;
//    // Limitar la longitud a 22 caracteres si es necesario
//    $numConvenio = substr($numConvenio, 0, 22);
//    $characters = str_split($numConvenio);
    $characters = str_split(substr(str_pad(substr($contrato->empresa->sigla, 0, 3), 3, 'X') . str_pad(substr($contrato->ccosto->codigo, 0, 5), 5, 'X') . str_pad($contrato->folioContrato, 5, '0', STR_PAD_LEFT) . str_replace(['.', '-'], '', $contrato->cliente->rut), 0, 22));
@endphp

<table style="border-collapse: collapse;">
    <tr>
        <?php foreach ($characters as $char): ?>
            <td style="border: 1px solid black; padding: 3px; text-align: center;">
                <?= $char ?>
            </td>
        <?php endforeach; ?>
    </tr>
</table>

<br>En Santiago, a ____ de ________ de _________ <br>

<table width="80%">
    <tbody>
        <tr>
            <td>
                <br>________________________<br>
                Firma de “el Mandante” <br>
            </td>
            <td>
                <br>
                <img align="right" src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/LogoBancoBCI.jpg') }}" alt="Logo BCI" width="100px">
            </td>
        </tr>
    </tbody>
</table>
<br>
<b><u>Uso Exclusivo Banco</u></b>
<table>
    <tbody>
        <tr>
            <td>Nro. Mandato ________________________</td>
            <td>Receptor ________________________</td>
        </tr>
        <tr>
            <td>Fecha ________________________</td>
            <td>Firma ________________________</td>
        </tr>
        <tr>
            <td>Cod.Convenio (CCA) ________________________</td>
            <td><b>(Este Nro. es fijo y lo entrega BCI)</b></td>
        </tr>
    </tbody>
</table>
<br>
<b>BANCOS ASOCIADOS AL SISTEMA:</b> BCI; Chile; Scotiabank; Itaú; CorpBanca; BICE; Santander; Estado; Security; Falabella; BBVA 

</font>

<script type="text/php">
    if (isset($pdf))
      {
        $la_fecha_de_hoy = date("d-m-Y"); 
        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $pdf->page_text(520, 760, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        $pdf->page_text(30, 760,  $la_fecha_de_hoy,                    $font, 10, array(0, 0, 0));
      }
  </script>
</body>
</html>
@php 
    //dd($contrato); 
@endphp
<!---
    <b>NUMERO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>TEXTO TEXTO</u></b><br>
    <ol type="a">
        <li>texto</li>
    </ol>
    <p></p>
--->

