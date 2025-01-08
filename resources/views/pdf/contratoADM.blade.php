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
        //$el_modulo = 'el_modulo(3)';
    @endphp
    <div id="header">
        <img class="imgHeader" src="{{ storage_path('app/public/'.auth()->user()->empresa->directorio.'/'.$contrato->empresa->logo) }}" alt="Logo de la Empresa" width="100px">
        <div class="infoHeader">
            <p align="right">Contrato {{ $contrato->ccosto->codigo }}/{{ $contrato->folioContrato }}<br>
            {{ $contrato->cliente->nombre }}</p>
        </div>
    </div>

<p align='center'><u><b><font size="+1">CONTRATO DE DEPÓSITO<br>
    <p>**** para direrenciar este seria del tipo ADM ****</p>
    EN {{ $contrato->ccosto->descripcion }}</font></b></u></p>
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
        ciudad de <b>{{ $contrato->empresa->comuna->ciudad->nombre }}</b> en adelante indistintamente también como “<b>{{ $contrato->empresa->sigla }}</b>”
        o el “depositario”, quienes vienen en celebrar el siguiente contrato de arriendo, que se regirá por las disposiciones del Código Civil y del 
        Código de Comercio, así como por las cláusulas y estipulaciones que se expresan en adelante:</p>

        <b>PRIMERO: @for ($i = 0; $i < 25; $i++) &nbsp; @endfor <u>OBJETO</u></b><br>
        <ol type="a">
            <li>{{ $contrato->empresa->sigla }} recibirá en depósito mercadería del cliente que se individualiza en documentos o guías separados y que se denominará 
                el depósito.</li>
            <li>El cliente solo podrá usar el espacio asignado para actividades propias de su giro.</li>
            <li>Las mercaderías serán almacenadas en cualquiera de los depósitos ubicados en</li>
            <ol type="*">
                <li>{{ $contrato->empresa->direccionContrato }} - {{ $contrato->empresa->comuna->nombre }}<br></li>
            </ol>
        </ol>
        <p></p>

        <b>SEGUNDO: @for ($i = 0; $i < 23; $i++) &nbsp; @endfor <u>INICIO, VIGENCIA</u></b><br>
        <ol type="a">
        <li>Las cláusulas establecidas en este Contrato empezarán a regir desde la fecha estipulada en él, por un plazo de 3 meses y hasta que alguna de las partes 
            le dé termino.</li>
        <li>El presente contrato será por mes calendario renovable mes a mes en forma automática e indefinida, por lo que cualquiera de las partes podrá ponerle 
            término y sin expresión de causa dando a la otra un aviso por escrito de a lo menos con 15 días corridos de anticipación al término del mes 
            correspondiente a través de carta certificada enviada al domicilio que consta en la comparecencia de este instrumento.</li>
        <li>Antes de que termine el contrato el cliente deberá retirar el total de la mercadería almacenada. Transcurrida la fecha de término de contrato sin 
            que el cliente, mandatario o representante hubiere retirado las especies o mercaderías que depositó, se entenderá que las ha abandonado 
            y {{ $contrato->empresa->sigla }}, discrecionalmente, tendrá las siguientes facultades:</li>
        <ol type="i">
            <li>Proceder a la venta de todo o parte de las mercaderías almacenadas en el módulo por medio de un martillero público de libre elección 
                de {{ $contrato->empresa->sigla }}. El producto del remate se imputará en la parte que corresponda al pago de las obligaciones adeudadas para 
                con {{ $contrato->empresa->sigla }} y el saldo, si lo hubiere, quedará en cuenta corriente a disposición del cliente por un periodo máximo de 180 
                días al término del cual se entenderá que los fondos quedan en beneficio exclusivo de {{ $contrato->empresa->sigla }}; o,</li>
            <li>Eliminar todo o parte de las especies o mercaderías de que se trate, sin procedimiento, formalidad o solemnidad alguna, encontrándose expresamente 
                eximida de toda responsabilidad respecto de aquellas, cualesquiera sea la naturaleza de la responsabilidad, debiendo el cliente abonar los gastos 
                que produjo el traslado o eliminación de las mismas.</li>
        </ol>
        <li>En situaciones de caso fortuito o fuerza mayor que escapen del control razonable de las partes tales como caídas de energía, huelgas, lock outs, 
            eventos imprevistos de la naturaleza o del hombre, etc., relevarán a la parte afectada del cumplimiento de sus obligaciones hasta que termine el hecho 
            que la motivó. En todo caso, tan pronto ocurra el hecho, deberá ser suficientemente informado a la otra parte a fin de tomarse las medidas de 
            mitigación que el caso requiera.</li>
        <li>Si no se pudiere subsanar el impedimento dentro de plazos y parámetros razonables y que hagan imposible la completa ejecución del presente contrato, 
            se procederá a ponerle término anticipadamente incluso sin esperar el plazo de que da cuenta la Segunda cláusula inciso b), lo que en todo caso 
            deberá verificarse de común acuerdo entre las partes. </li>
        </ol>
        <p></p>

        <b>TERCERO: @for ($i = 0; $i < 25; $i++) &nbsp; @endfor <u>MERMAS</u></b><br>
        <ol type="a">
            <li>Se entiende por mercadería mermadas aquellas no aptas para el despacho o la venta, ya sea por daño en su envase, decoloración, fallas en el 
                embalaje, faltantes, productos vencidos, vicio propio del producto, restricciones legales, entre otros.</li>
            <li>Las diferencias, mermas y mercaderías dañadas serán informados por escrito al cliente al momento de detectarse. </li>
            <li>El cliente aceptará una merma del 0,2% por concepto de almacenamiento, la cual se cuantificará al costo de los productos.</li>
            <li>En caso de existir faltantes y sobrantes, estos se compensarán entre sí, también al costo de cada producto.</li>
            <li>Semestralmente el cliente facturará a {{ $contrato->empresa->sigla }} el total de las mermas que superen las mermas aceptables establecidas en 
                los puntos anteriores. {{ $contrato->empresa->sigla }} responderá por el exceso de los faltantes por sobre la pérdida aceptable al costo.</li>
            <li>{{ $contrato->empresa->sigla }} solo responderá por daños, mermas o pérdidas de los productos siempre y cuando su causal sea mala manipulación 
                o manejo desde el momento de ingreso a la bodega hasta el despacho. </li>
            <li>{{ $contrato->empresa->sigla }} responderá por el costo de los productos, el que deberá ser acreditado con la factura de compra, declaración 
                de importación u otro documento público de respaldo. En todo caso {{ $contrato->empresa->sigla }} responderá hasta por un máximo de 25 UF por 
                pallet de producto. En caso que el daño sea menos de 1 pallet el pago máximo será proporcional.</li>
            <li>Si el cliente tiene productos que tengan un costo superior a 25 UF por pallet, podrá informarlo a {{ $contrato->empresa->sigla }}. En este 
                caso la tarifa de almacenamiento tendrá un alza de UF 0.001 por pallet por UF adicional de costo. Con esto {{ $contrato->empresa->sigla }} 
                responderá por el costo total informado.</li>
        </ol>
                    
        <b>CUARTO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>CONTROL DE CALIDAD</u></b><br>
        <p>El cliente supervisará y controlará la calidad y cumplimientos de todas las especificaciones técnicas en el almacenamiento, preparación de pedidos 
            y despachos. Así podrá entre otras funciones:</p>
        <ol type="*">
            <li>objetar y/o redefinir la ubicación de los productos almacenados, cuando estos no cumplan con las condiciones definidas por el cliente para 
                estos efectos.</li>
            <li>en el caso de existir alguna duda o anomalía en la recepción de un producto, el cliente podrá concurrir en cada situación verificando el 
                correcto cumplimiento de las especificaciones técnicas para cada situación en particular.</li>
        </ol>
        <p></p>
            
        <b>QUINTO: @for ($i = 0; $i < 15; $i++) &nbsp; @endfor <u>RESPONSABILIDADES Y OBLIGACIONES</u></b><br>
        <ol type="a">
            <li>Será responsabilidad del cliente que la mercadería que almacena en {{ $contrato->empresa->sigla }} cuente con todos los permisos y autorizaciones 
                para su traslado, almacenaje, despacho, comercialización, etc., sean éstas de carácter aduaneras, sanitarias, municipales, ambientales, 
                tributarias y/o de cualquier otra autoridad.</li>
            <li>{{ $contrato->empresa->sigla }} deberá tomar las providencias del caso en el tema de la vigilancia de sus instalaciones, siendo su responsabilidad 
                la custodia de todos los productos pertenecientes al cliente. </li>
            <li>{{ $contrato->empresa->sigla }} será responsable de cumplir las normas que regulan el almacenamiento de las mercaderías depositadas. En caso de 
                no poder hacerlo o que cambien las regulaciones deberá informar al cliente en un plazo de 5 días hábiles. Si las nuevas normativas significaran 
                mayores costos {{ $contrato->empresa->sigla }} informará los nuevos precios que comenzarán a regir una vez implementados los nuevos requerimientos.</li>
            <li>Para determinar los requerimientos técnicos, legales y regulatorios de cada producto, el cliente informará a {{ $contrato->empresa->sigla }} las 
                leyes, reglamentos, ordenanzas, decretos, disposiciones administrativas, disposiciones sanitarias u otras restricciones que afecten a cada uno de 
                los productos en relación a la seguridad, manejo y almacenamiento. Dichos aspectos relevantes deberán comunicarse por escrito detalladamente para 
                cada producto, sin que los requerimientos de un producto se puedan hacer extensivos a otros sin que esté así especificado.</li>
            <li>El transporte de la mercadería será de responsabilidad de aquella parte de este contrato que lo realice directamente o contrate o subcontrate dicho 
                servicio, lo cual deberá quedar debidamente acordado y especificado caso a caso al momento de efectuarse.</li>
            <li>Otras prestaciones o servicios diferentes de los tratados expresamente en el presente contrato, serán considerados como servicios extras y/o especiales, 
                cuyas condiciones deberán ser acordadas en su oportunidad caso a caso entre las partes. Estos se facturarán de acuerdo a las tarifas que se convengan.</li>
            <li>El inventario, en cuanto a cajas u otros contenedores cerrados, podrá indicar la presunta Mercadería contenida en los mismos, con el fin de facilitar 
                su contabilización, sin que, por este hecho, {{ $contrato->empresa->sigla }} se obligue o responsabilice respecto de la individualización de ésta, 
                su estado, cantidad o cualquier otra característica relativa a los productos contenidos en dichas cajas o contenedores cerrados.</li>
            <li>En caso que un producto requiera de tratamientos específicos, disposiciones finales u otras tareas que sean necesarias para asegurar la seguridad 
                del producto, de otros productos, de las instalaciones o del personal, el cliente faculta a {{ $contrato->empresa->sigla }} para que realice dichos 
                tratamientos cuando determine necesario realizarlos. Estos tratamientos o tareas, serán de cargo y costo del cliente.</li>
            <li>{{ $contrato->empresa->sigla }} no será responsable del deterioro o daño de las mercaderías cuando sea producto de vicio propio, caducidad, expiración, 
                de la pérdida de peso por pérdida de humedad, de caso fortuito o de la fuerza mayor que pueda afectar a la mercadería. Tampoco será responsable de 
                cambios físicos y/o químicos en los productos que se pudieran evitar tomando resguardos especiales que no hubieran sido solicitadas por escrito con 
                la debida anticipación. En estos casos el cliente será el responsable del retiro y posterior proceso o disposición final que requieran dichos productos.</li>
            <li>En caso de solicitar resguardos especiales, {{ $contrato->empresa->sigla }} informará al cliente si está en condiciones de tomar dichos resguardos. En 
                caso de poder hacerlo informará también el costo adicional producto de ello.</li>
            <li>Será responsabilidad de {{ $contrato->empresa->sigla }} la contratación, alimentación, movilización, remuneraciones, ropa, elementos de seguridad, 
                accidentes del trabajo, enfermedades, cotizaciones previsionales o cualquier otro gasto originado por el personal que labora en forma directa e 
                indirecta en las instalaciones de {{ $contrato->empresa->sigla }}</li>
            <li>Ninguna disposición contenida en este contrato ni ningún acto posterior de las partes, es o puede ser considerado, o interpretado, como un vínculo de 
                dependencia, societario o como la intención de constituir una sociedad, un joint venture, una asociación o una persona jurídica, ni autorizará 
                a {{ $contrato->empresa->sigla }} para representar al cliente o contratar en representación del cliente. {{ $contrato->empresa->sigla }} actuará 
                exclusivamente como un proveedor o prestador de servicios independiente.</li>
            <li>El presente contrato no constituye bajo ningún respecto relación laboral entre las partes ni de los empleados de {{ $contrato->empresa->sigla }} respecto 
                del cliente.</li>
            <li>Se prohíbe a las partes ceder en todo o parte el presente contrato, así como los derechos u obligaciones que de él emanen.</li>
            <li>El cliente libera desde ya a {{ $contrato->empresa->sigla }} de toda responsabilidad por perjuicios, demandas o reclamaciones provenientes de terceros 
                en relación a las mercaderías almacenadas en {{ $contrato->empresa->sigla }}, materia de este contrato. Asimismo, se obliga a asumir la defensa 
                de {{ $contrato->empresa->sigla }} y mantenerla indemne en caso de ser objeto de acciones, demandas, medidas, etc., así como a hacerse cargo de las 
                resultas y gastos de las mismas.</li>
            <li>{{ $contrato->empresa->sigla }} no se responsabiliza de las medidas tanto judiciales como prejudiciales de cualquier índole que recaigan sobre la 
                mercadería que tenga almacenada el cliente y que impliquen retenciones, embargos, precautorias, etc. así como de los perjuicios que de ello se deriven 
                para éste o para terceros, mientras no se disponga legalmente otra cosa.</li>
            <li>En ningún caso {{ $contrato->empresa->sigla }} será responsable del lucro cesante, pérdidas de ingresos, daños consecuenciales y del daño moral.</li>
            <li>El presente contrato es independiente de otros contratos que pueda haber celebrado {{ $contrato->empresa->sigla }} con el cliente o con otros clientes, 
                aunque sean relativos a materias similares a las que regula este contrato.</li>
            <li>El hecho de que cualquiera de las partes no insista en el cumplimiento estricto de cualquier obligación establecida en este contrato o no ejerza las 
                acciones legales que pudiera corresponderle, no deberá afectar, limitar o quitar a dicha parte el derecho posterior a exigir el cumplimiento estricto 
                de la misma obligación.</li>
            <li>La renuncia de cualquiera de las partes a tomar acción contra la otra por cualquier incumplimiento de las obligaciones o condiciones estipuladas en 
                este contrato, no podrá ser interpretada como una renuncia a la acción por cualquier otro incumplimiento posterior de la misma obligación.</li>
        </ol>
        <p></p>
    
        <b>SEXTO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>FACTURACION Y PAGOS</u></b><br>
        <ol type="a">
            <li>{{ $contrato->empresa->sigla }} facturará el arriendo en forma mensual bajo el concepto de mes anticipado de acuerdo a los precios 
                establecidos en el Anexo 1, excepto el mes que se firma el contrato. En la primera factura se cobrará el bodegaje mínimo mensual por 
                3 meses más la fracción del mes en curso, mes a mes se cobrarán los demás servicios y bodegaje que supere lo ya pagado.</li>
            <li>Las mensualidades adelantadas se facturarán basándose en la mayor ocupación del mes anterior. En caso de haber menos mercadería que 
                el mínimo o no haber mercadería se cobrará el mínimo.</li>
            <li>Los demás servicios que {{ $contrato->empresa->sigla }} preste al cliente se facturarán bajo la modalidad de mes vencido, también de 
                acuerdo a las tarifas del <b>Anexo 1</b>.</li>
            <li>{{ $contrato->empresa->sigla }} facturará al cliente el seguro por las mercaderías de acuerdo a lo establecido en el <b>Anexo 2</b>.</li>
            <li>El cliente se obliga al <b>pago de facturas al contado</b>, por concepto de arriendo de módulo y de cualquier otro servicio prestado 
                por {{ $contrato->empresa->sigla }}, <b>dentro de 10 días de recibida cada factura</b>, en las oficinas de {{ $contrato->empresa->sigla }} 
                ubicadas en {{ $contrato->empresa->direccionContrato }} - {{ $contrato->empresa->comuna->nombre }} </li>
            <li>Además, se obliga al pago de los impuestos y demás gastos que pudiere originar la suscripción de este contrato, los que serán pagados, 
                conjuntamente con el precio de los demás servicios facturados.</li>
            <li>Para facilitar el pago de los servicios, {{ $contrato->empresa->sigla }} pone a disposición del cliente la posibilidad de pagar 
                mediante transferencia bancaria o usando Pago Automático de Cuentas. Para usar este modo de pago debe llenar el mandato del <b>Anexo 5</b>.</li>
            <li>Sin perjuicio del derecho de retención sobre las especies almacenadas que el cliente le reconoce en forma expresa 
                a {{ $contrato->empresa->sigla }} para seguridad de lo que aquí pudiere adeudarle con motivo del presente contrato, todo ello 
                en conformidad con lo dispuesto en los artículos 2234 y 2235 del Código Civil, por este acto el cliente confiere 
                a {{ $contrato->empresa->sigla }} mandato especial irrevocable, en los términos del art. 241 del Código de Comercio para que 
                en caso que el cliente incurra en mora o simple retardo en <b>dos o más meses</b> en el pago de una factura u obligación cualquiera para 
                con {{ $contrato->empresa->sigla }}, ésta proceda a pagarse el total de lo  adeudado a través de la venta de todo o parte de las 
                mercaderías almacenadas utilizando el procedimiento de venta descrito en la cláusula Segunda letra e) inciso i., precedente. Si el 
                producto de la venta no alcanzare a cubrir lo adeudado, tal operación podrá efectuarse tantas veces como al efecto sea necesario. 
                Así mismo con el producto del remate se pagarán los gastos y costos propios de éste, así como impuestos y honorarios del martillero. 
                {{ $contrato->empresa->sigla }} deberá dar aviso al cliente de su intención de rematar las mercaderías con el objeto señalado 
                precedentemente, por medio de carta certificada dirigida al domicilio indicado en el presente contrato, con una anticipación mínima 
                de 15 días corridos a la fecha del remate, plazo en el cual este último podrá pagar lo adeudado más los gastos y costos ya incurridos 
                en el proceso de remate incluyendo al menos publicidad y fletes.</li>
            <li>El cliente autoriza irrevocablemente desde ya este procedimiento, estipulándose además que faculta a {{ $contrato->empresa->sigla }} 
                para que cobre el interés máximo convencional que la ley permita estipular, el que se calculará sobre el monto total adeudado, 
                debidamente reajustado de acuerdo a la variación que experimente el Índice de Precios al Consumidor entre la fecha del simple retardo 
                o mora y la fecha de su pago efectivo.</li>
            <li>Asimismo, por este acto el cliente libera expresamente a {{ $contrato->empresa->sigla }} de la obligación de rendir cuenta de su 
                mandato y lo autoriza a que en caso de incumplimiento, simple retardo o mora en el pago de las obligaciones a que se refieran los 
                documentos emitidos a su nombre tales como: contratos, facturas, pagares, letras u otros, los datos personales del cliente y los 
                relacionados con los documentos emitidos sean ingresados en un sistema de información comercial público o en un registro de morosidades 
                públicos pudiendo ser procesados, tratados y comunicados en cualquier forma o medio.</li>
            <li>Sin perjuicio de lo señalado anteriormente, en el evento que las mercaderías no sean susceptibles de ser rematadas dada su naturaleza 
                o el estado en que se encuentren, lo cual será calificado unilateralmente por {{ $contrato->empresa->sigla }}, facultará a esta última 
                para eliminar todo o parte de las especies o mercaderías de que se trate de acuerdo a la Segunda cláusula letra e) inciso ii. </li>
            <li>Si el cliente requiere generar una Orden de Compra previo a la facturación de los servicios, esta deberá ser emitida a más tardar el 
                día 15 del mes en curso, para ser facturada anticipado los primeros días del mes siguiente. En caso de no recibirla dentro del plazo 
                el cliente faculta a {{ $contrato->empresa->sigla }} para proceder a facturar sin la Orden de Compra. La Orden de Compra se hará en UF, 
                en caso de hacerse en pesos se deberá hacer con el valor de la UF del día 1ro del mes siguiente.</li>
            <li>En el caso del pago con cheque, sólo se entenderá que la deuda está pagada cuando el cheque sea liberado en la cuenta corriente 
                de {{ $contrato->empresa->sigla }}.</li>
        </ol>
        <p></p>

        <b>SÉPTIMO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>SEGUROS</u></b><br>
        <ol type="a">
            <li>{{ $contrato->empresa->sigla }} no responderá por los perjuicios o pérdidas que se produzcan en las mercaderías por efecto de caso 
                fortuito o de fuerza mayor, huelgas, guerras, sedición o tumulto popular, vandalismo, actos terroristas, asalto a mano armada, fuego, 
                robo, contaminación, inundación, granizo, nieve, tormenta, terremoto, rayos, etc. </li>
            <li>Por tal razón el Cliente en este acto podrá contratar un seguro por su mercadería que cubra al menos Robo, Incendio y Sismo. </li>
            <li>El seguro se cobrará a las tarifas y con los deducibles indicados en el <b>Anexo 2</b>. </li>
            <li>El cliente, junto con la firma del contrato deberá llenar el <b>Anexo 2</b> informando el costo de los bienes que se mantendrán del inmueble 
                arrendado. En el evento que dicho <b>Anexo 2</b> no sea completado conforme a lo señalado, se entenderá que el Cliente no requiere contratar 
                seguro los que asume todos los riesgos por deterioro o pérdida de la mercadería por cualquier causa.</li>
            <li>Si el cliente asegura con otra compañía aseguradora, renuncia a los derechos de subrogación en contra de {{ $contrato->empresa->sigla }} 
                y la compañía aseguradora que esta última tenga.</li>
            <li>Los perjuicios y/o daños no cubiertos o no asegurados que pudieran producirse por cualquier causa, serán de exclusiva cuenta y cargo del 
                cliente que renuncia a toda indemnización por parte de {{ $contrato->empresa->sigla }}.</li>

        </ol>
        <p></p>

        <b>OCTAVO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>RETIRO</u></b><br>
        <p>Todo retiro total de mercaderías almacenadas deberá ser avisado con al menos un (1) día hábil de anticipación para que esta sea autorizada 
            por {{ $contrato->empresa->sigla }}. Para proceder a dicho retiro el cliente deberá:</p>
        <ol type="a">
            <li>Estar al día en todos los pagos que se hayan generado por los servicios prestados por {{ $contrato->empresa->sigla }}. En el caso del pago 
                con cheque, sólo se entenderá que la deuda está pagada cuando el cheque sea liberado en la cuenta corriente de {{ $contrato->empresa->sigla }}.</li>
            <li>Estar cumplidas todas las obligaciones señaladas en el presente contrato y pagadas todas las facturas por concepto de rentas de 
                arrendamiento, considerándose ésta(s) como de plazo vencido en la fecha efectiva de retiro de las mercaderías para todos los efectos legales.</li>
        </ol>
        <p></p>
    
        <b>NOVENO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>CONTRATACION DE PERSONAL</u></b><br>
        <ol type="a">
            <li>Si el cliente contrata directa o indirectamente, durante la vigencia del presente contrato y hasta 90 días después de su término, a algún 
                trabajador que realice sus labores en las instalaciones administradas por {{ $contrato->empresa->sigla }}, el cliente deberá pagar al empleador 
                un monto equivalente a las últimas 4 remuneraciones del trabajador contratado, directa o indirectamente, por parte del cliente. Este cobro es 
                por <b>servicios de reclutamiento, capacitación y entrenamiento</b> realizados para el trabajador contratado.</li>
            <li>Para los efectos de esta cláusula se entenderá por remuneración: sueldos, bonos imponibles y exentos, premios, gratificaciones, seguros, seguros 
                de cesantía, cotizaciones previsionales y de salud, mutuales, vacaciones, finiquitos y cualquier otro costo imputable al trabajador en que el 
                empleador haya incurrido.</li>
        </ol>
        <p></p>
    
        <b>DÉCIMO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>TARIFAS</u></b><br>
        <ol type="a">
            <li>Las <b>tarifas</b> por los servicios que contempla el presente contrato serán las indicadas en el <b>Anexo 1</b> que es parte integrante de este contrato. 
                Cualquier cambio en las tarifas será avisado por {{ $contrato->empresa->sigla }} por escrito con al menos 60 días corridos de anticipación.</li>
            <li>Los precios del Anexo 1 están expresados en Unidades de Fomento (UF) y son netos más IVA. El valor del bodegaje mensual se facturará por mes 
                anticipado en base a la máxima ocupación del mes anterior o del espacio fijo contratado. </li>
            <li>Las tarifas por servicios no incluidos en este contrato serán informadas al cliente por escrito (e-mail, carta) antes de prestar el servicio. 
                Una vez que {{ $contrato->empresa->sigla }} reciba la aceptación de las tarifas por parte del Cliente también por escrito, pasarán a ser parte 
                integrante de este contrato.</li>
            <li>Si la Unidad de Fomento (UF) dejare de ser un padrón de reajustabilidad diaria o variare su base de cálculo, los valores antes indicados se 
                reajustarán en la misma proporción en que varíe el Índice de Precios al Consumidor (IPC) con un mes de desfase entre la fecha en que ocurriere 
                el hecho descrito y la fecha del pago efectivo de la obligación, calculándose al efecto los reajustes por numerales diarios respecto de la 
                variación que haya experimentado el IPC entre la fecha de dicho hecho y la fecha del pago efectivo de la obligación, de modo que, el reajuste 
                se aplicará en los mismos términos y condiciones que se aplicaría si es que se continuare con el sistema de reajustabilidad de la UF.</li>
        </ol>
        <p></p>
    
        <b>UNDÉCIMO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>SERVICIOS, GASTOS COMUNES, ESTACIONAMIENTOS Y OTROS</u></b><br>
        <ol type="a">
            <li>En caso de contratar servicios de {{ $contrato->empresa->sigla }} adicionales, el cliente deberá pagar el valor de los mismos a los precios 
                establecidas en este contrato. Los servicios de {{ $contrato->empresa->sigla }} deberán ser solicitados con 1 día hábil de anticipación y 
                ser debidamente confirmados por {{ $contrato->empresa->sigla }}.</li>
            <li><b>Estacionamientos</b>: los vehículos particulares y de transporte solamente pueden estacionar dentro de la propiedad durante las labores de carga 
                y descarga, máximo 2 horas al día por vehículo.</li>
            <li>Los vehículos de transporte deberán esperar afuera de las instalaciones hasta el momento de su turno para ser descargados o cargados.</li>
            <li>En caso de requerir un estacionamiento por todo el día o día y noche el cliente deberá informar a {{ $contrato->empresa->sigla }}, quién 
                facturará el servicio de estacionamiento de acuerdo a las tarifas del <b>Anexo 1</b>.</li>
            <li>Los vehículos no informados se cobrarán a la tarifa diaria.</li>
        </ol>
        <p></p>

        <b>DUODÉCIMO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>HORARIOS</u></b><br>
        <ol type="a">
            <li>Ambas partes fijan un horario de recepción o despacho de 8:30 a 18:15 hrs. de Lunes a Viernes.</li>
            <li>De mutuo acuerdo entre las partes, este horario podrá ser ampliado y eventualmente {{ $contrato->empresa->sigla }} podrá prepararse para 
                atender los sábados de 8:30 a 13:00 hrs. Estas ampliaciones de horario deberán avisarse con al menos 24 horas de anticipación y significarán 
                el pago de horas extraordinarias y un recargo de un 50% en las tarifas de ingreso o salida de bodega.</li>
            <li>El cliente avisará con al menos 24 horas de anticipación a {{ $contrato->empresa->sigla }} la llegada de mercadería. 
                Si {{ $contrato->empresa->sigla }} al momento del aviso tuviera algún reparo en el horario o cantidad de camiones se comunicará con el 
                cliente para coordinar un mejor horario.</li>
            <li>La recepción de Packing List se hará hasta las 17:00 horas de lunes a viernes hábiles.</li>
            <li>Para retirar mercadería de la bodega, el cliente enviará a {{ $contrato->empresa->sigla }}, por escrito (fax o mail), una “Orden de Carga”, 
                con al menos 6 horas hábiles de anticipación a la hora de retiro. Se debe considerar una hora no hábil para el almuerzo del personal.</li>
            <li>El horario para recibir último camión es hasta las 16:30 hrs.</li>
        </ol>
        <p></p>

        <b>DECIMOTERCERO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>ALMACENAMIENTO</u></b><br>
        <ol type="a">
            <li>El cliente declara bajo juramento, que en caso de almacenar especies, estas son de su propiedad o que el cliente se encuentra debidamente 
                facultado por el propietario de las mismas para administrarlas libremente y que no se encuentran embargadas ni sujetas a procedimiento 
                judicial. </li>
            <li>A partir de la recepción de la mercadería, {{ $contrato->empresa->sigla }} es responsable de mantener los productos en las mismas condiciones 
                en que se recibieron en: cantidad, composición, y estado, tomando en consideración del paso del tiempo y de su efecto en los productos. </li>
            <li>{{ $contrato->empresa->sigla }} velará por el correcto almacenamiento, entendiendo que el producto en todo momento es de propiedad del 
                cliente.</li>
            <li>{{ $contrato->empresa->sigla }} mantendrá en todo momento los productos contenidos en cajas, latas, tarros, tambores, cuñetes, cajones, 
                bidones, tinetas o sacos sobre pallets de madera. El cliente debe proveer dichos pallets. En caso de no hacerlo {{ $contrato->empresa->sigla }} 
                los proveerá y cobrará la tarifa de arriendo mientras estos estén en uso en las bodegas de {{ $contrato->empresa->sigla }} Si el pallet es 
                despachado se cobrará la tarifa de venta. </li>
            <li>Los pallets pueden tener una altura máxima de 1.33 metros.</li>
            <li>El peso de los pallets puede ser como máximo de 1.2 toneladas.</li>
            <li>{{ $contrato->empresa->sigla }} normalmente utilizará el sistema de manejo de inventario que el cliente solicite pudiendo ser FIFO, LIFO, 
                FEFO u otro que el cliente determine.</li>
            <li>Cualquier otro requisito de almacenamiento requerido por el cliente debe ser solicitado por carta o por mail a {{ $contrato->empresa->sigla }} 
                que contestará respecto a la factibilidad y posible costo del servicio solicitado.</li>
            <li>{{ $contrato->empresa->sigla }} queda facultado para que en cualquier tiempo, bajo su responsabilidad y por motivos justificados, pueda trasladar 
                la mercadería a bodegas o depósitos distintos de los individualizados en el presente contrato, o a aquellos que le indique el cliente, debiendo 
                mantener en todo caso las mismas condiciones de calidad y cumplimiento de sus obligaciones. Para ello, deberá dar un aviso por escrito al cliente 
                con a lo menos 3 días de anticipación al traslado.</li>
            <li>{{ $contrato->empresa->sigla }} no admitirá el almacenamiento en sus instalaciones, de sustancias peligrosas, explosivos, venenos, corrosivos, 
                productos inflamables, comburentes, peróxidos, productos radioactivos, armas, líquidos, caldos, mercaderías, materiales que causen perjuicios a 
                las instalaciones o a las personas o acarreen trastornos en el desenvolvimiento normal de las instalaciones de {{ $contrato->empresa->sigla }} y 
                se reserva el derecho de exigir el retiro inmediato de las mercaderías que estime están causando daños o trastornos. El cliente que no obstante 
                ingrese tal clase de mercaderías, responderá de todos los daños, perjuicios y gastos que puedan sobrevenir por incumplimiento de esta cláusula. 
                La Empresa tampoco admite especies que por vicio propio u otra causa dañen o puedan dañar otros bienes depositados o acarreen trastornos en el 
                desenvolvimiento normal del depósito.</li>
            <li>Sin perjuicio de lo anterior, las especies o mercaderías señaladas en el párrafo anterior deberán ser retiradas por el cliente dentro del plazo 
                máximo de 5 días, contados desde que {{ $contrato->empresa->sigla }} ponga en su conocimiento esta situación al cliente, mandatario o 
                representante. </li>
            <li>Transcurrido dicho plazo sin que el cliente, mandatario o representante hubiere retirado las especies o mercaderías que almacenó en infracción a 
                esta cláusula, se entenderá que las ha abandonado. En este caso {{ $contrato->empresa->sigla }} discrecionalmente tendrá las siguientes facultades 
                descritas en la cláusula Segunda letra e).</li>
            <li>En caso de que el producto a almacenar requiera tratamientos específicos por razones de su naturaleza, como, por ejemplo, fumigaciones para mantener 
                su calidad, el depositante estará obligado a efectuarlos o en su defecto en este acto faculta a {{ $contrato->empresa->sigla }} para que realice 
                dichas fumigaciones cuando determine que es necesario realizarlas. El costo de dichos tratamientos será de cargo del depositante.</li>
        </ol>
        <p></p>

        <b>DECIMOCUARTO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>INVENTARIOS</u></b><br>
        <ol type="a">
            <li>{{ $contrato->empresa->sigla }} deberá mantener los productos inventariados, identificables y a disposición del cliente en todo momento, para que 
                este pueda efectuar una verificación, cuando lo requiera. Los productos deberán ser almacenados identificados, rotulados y ordenados de acuerdo 
                a la normativa vigente.</li>
            <li>El inventario de productos se llevará en unidades.</li>
            <li>El cliente podrá solicitar a {{ $contrato->empresa->sigla }} hacer hasta 2 inventarios conjuntos anuales dentro de la tarifa por almacenamiento. 
                La fecha y hora de estos inventarios debe ser acordada cada vez. Los inventarios adicionales se cobrarán de acuerdo a la tarifa establecida.</li>
            <li>{{ $contrato->empresa->sigla }} remitirá mensualmente por email, un inventario al cliente con los saldos de existencias de mercadería. Este 
                inventario se entenderá aceptado y conforme por el cliente, si dentro de los 10 días corridos desde su envío, el cliente no lo objetara por 
                escrito.</li>
        </ol>
        <p></p>
    
        <b>DECIMOQUINTO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>RECEPCIÓN</u></b><br>
        <ol type="a">
            <li>El cliente enviará los “Packing List” correspondientes a cada recepción al momento de avisar la llegada de un camión o container. </li>
            <li>El cliente sugerirá los códigos y nombres a usar para cada producto nuevo antes de la llegada del mismo. En caso que llegue un producto del que 
                no se tenga código o nombre preasignado {{ $contrato->empresa->sigla }} asignará un código y un nombre que permita identificar el producto.</li>
            <li>Los camiones serán atendidos en orden de llegada. </li>
            <li>{{ $contrato->empresa->sigla }} recibirá del cliente los distintos productos, siendo responsabilidad de {{ $contrato->empresa->sigla }} realizar 
                la descarga correspondiente y la limpieza completa de los contenedores cuando el cliente lo solicite, de acuerdo a las tarifas establecidas.</li>
            <li>La recepción de mercaderías será presenciada personalmente por el cliente, su representante o mandatario, designado para este efecto, a falta de 
                un mandatario expresamente designado, será el transportista que transporte y entregue la mercadería el representante del cliente.</li>
            <li>En cada recepción o despacho se emitirá una guía de entrada o salida del depósito, según sea el caso, que contendrá las especificaciones 
                indispensables para una fácil comprensión e identificación de las especies.</li>
            <li>Se entenderá la carga recepcionada conforme, si no hay ninguna anotación en la Guía de Recepción. </li>
            <li>Si durante la recepción {{ $contrato->empresa->sigla }} detectare daños o mermas, así como diferencias con lo informado en la Guía de Despacho, 
                será informado al cliente y aclarada la situación al más breve plazo. Además, las diferencias y/o cualquier otra anomalía en la recepción serán 
                anotadas en la guía de despacho.</li>
            <li>En caso que la mercadería recibida esté contenida en tambores, IBC (Intermediate Bulk Container):, tinetas, latas u otros envases cerrados, donde 
                no sea posible verificar su contenido, calidad, naturaleza, estado, etc., {{ $contrato->empresa->sigla }} restituirá los mismos envases cerrados, 
                sin que pueda alegarse por el cliente materia alguna respecto a la individualización de la mercadería, su estado, cantidad, etc.</li>
            <li>La mercadería en cajas o envases cerrados no se pesará ni se revisará por parte de {{ $contrato->empresa->sigla }}, siendo de exclusiva 
                responsabilidad del cliente el contenido de las cajas o envases.</li>
            <li>Se deja establecido que {{ $contrato->empresa->sigla }}, previa comunicación escrita al cliente, podrá realizar inspecciones visuales de las 
                mercaderías y abrir contenedores, con el objetivo de verificar que el tipo de producto y la cantidad correspondan con lo indicado por el cliente 
                o la Guía de Despacho de las mercaderías.</li>
            <li>{{ $contrato->empresa->sigla }} se obliga a restituir la mercadería que figura en la guía de recepción, en el estado en que le fue entregada 
                habida consideración del desgaste y deterioro natural producto del tiempo que se encuentra almacenada.</li>
            <li>{{ $contrato->empresa->sigla }} se reserva el derecho de no recibir productos que estén con daños evidentes o que por su estado puedan poner en 
                peligro la seguridad del recinto, de las mercaderías o de los trabajadores.</li>
            <li>En el caso de no disponerse de tiempo necesario al momento del ingreso de las mercaderías, {{ $contrato->empresa->sigla }} avisará al cliente y 
                recibirá la mercadería sin revisar, y sólo se hará responsable por ella desde el momento en que se confeccione por las partes un inventario oficial, 
                cuyo borrador deberá ser propuesto por {{ $contrato->empresa->sigla }} al cliente a más tardar dentro del siguiente día hábil a la recepción material 
                de la mercadería. En caso de no presentar {{ $contrato->empresa->sigla }} un inventario dentro del siguiente día hábil, se tomará como inventario 
                la Guía de Despacho con que llegó la mercadería.</li>
            <li>Dependiendo de la hora de llegada de los camiones, de la cantidad de carga y de las tasas de transferencia de carga, es posible que el cliente deba 
                autorizar horas extra a partir de las 18:30 horas, para terminar la descarga, a las tarifas establecidas.</li>
            <li>La recepción y despacho de las mercaderías se hará y atenderá en el horario indicado por la Empresa siendo la carga, descarga y ubicación del depósito 
                o parte de él, realizada por {{ $contrato->empresa->sigla }} con personal contratado por este y de cargo del Cliente.</li>
        </ol>
        <p></p>
    
        <b>DECIMOSEXTO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>DESPACHO</u></b><br>
        <ol type="a">
            <li>La Orden de Despacho que enviará el cliente para retirar productos deberá incluir la siguiente información:</li>
            <ol type="*">
                <li>“Packing List” o detalle de la carga, que debe incluir: nombre producto, cantidad, tipo de manejo (palletizado o a piso)</li>
                <li>Hora de presentación del camión</li>
                <li>Nombre y Rut del Transportista</li>
                <li>Patente del camión.</li>
                <li>Firma de encargado, con poder para autorizar despachos.</li>
            </ol>
            <li>El cliente definirá las personas que tienen poder para autorizar despachos en el Anexo 2 del presente contrato. En caso de no dar poder a otras 
                personas, la única persona que puede autorizar los despachos es el representante legal.</li>
            <li>Será responsabilidad de {{ $contrato->empresa->sigla }} la verificación de la Orden de Despacho y las firmas autorizadas en todos los casos.</li>
            <li>{{ $contrato->empresa->sigla }} deberá tener la infraestructura necesaria para el carguío de camiones cerrados y/o abiertos, para carga a piso o 
                palletizada.</li>
            <li>El cliente, a través del personal propio que destine al efecto, verificará en las dependencias de {{ $contrato->empresa->sigla }} que cada Orden de 
                Despacho haya sido ejecutada en conformidad a sus requerimientos.</li>
            <li>La entrega de los efectos o mercaderías en depósito será presenciada personalmente por el depositante, su representante o mandatario y una vez recibida 
                y declarada su aceptación la Empresa no responderá por futuros reclamos cualquiera sea la causa que los origine. Si la entrega fuere presenciada y aceptada 
                por persona distinta del depositante, deberá hacerlo con poder suficiente.</li>
            <li>Los documentos de despacho, de porte y otros auxiliares, serán proporcionados por el cliente en la bodega antes de proceder a la carga. El cliente podrá 
                solicitar a {{ $contrato->empresa->sigla }} la emisión de la documentación necesaria, lo que será cobrado según las tarifas establecidas en este contrato 
                o acordado posteriormente. </li>
            <li>{{ $contrato->empresa->sigla }} podrá objetar y detener el despacho de un producto si este no cumple con las condiciones que el cliente establezca en estiba, 
                amarre, incongruencia en la información del carguío, calidad, cantidad, etc. En este caso se avisará inmediatamente al cliente.</li>
            <li>{{ $contrato->empresa->sigla }} podrá objetar y detener el despacho de un producto si estos o sus vehículos de transporte no cumplen con las condiciones 
                establecidas por la legislación vigente. En este caso también se avisará al cliente.</li>
            <li>Una vez cargada la mercadería se entenderá recibida y aceptada por el cliente con la firma de la guía de despacho, cesando toda responsabilidad 
                de {{ $contrato->empresa->sigla }}, no respondiendo en consecuencia {{ $contrato->empresa->sigla }} por reclamos, mermas, daños, pérdidas, estado o calidad 
                de ella, etc., cualquiera sea la causa que lo origine, con posterioridad a la aceptación conforme del cliente estampada a través de su firma en la citada 
                guía de despacho.</li>
            <li>Cualquier retiro parcial de mercadería será hecho bajo la responsabilidad del cliente, no siendo responsable {{ $contrato->empresa->sigla }} de los riesgos 
                de deterioro que dicho retiro origine. En todo caso, queda estrictamente prohibido el retiro de partes, elementos, objetos, kilos, litros o unidades 
                parciales, que estén contenidos en tambores, latas, IBC, Sacos, cajas, cajones, tarros, etc. Debiéndose en consecuencia, proceder al retiro de la unidad 
                completa, integralmente considerada y en las mismas condiciones como fue recibida en bodega.</li>
            <li>El cliente, salvo solicitud por escrito a {{ $contrato->empresa->sigla }}, será el responsable de coordinar y suministrar el transporte para realizar 
                los despachos. </li>
            <li>Los transportistas externos pueden informarse previamente para ser registrados en las oficinas de {{ $contrato->empresa->sigla }} y así evitar tener que 
                incluir el Rut y la patente del camión en cada Orden de Despacho.</li>
            <li>Todo retiro total de mercaderías deberá ser avisado con a lo menos 3 días de anticipación, y para que esta sea autorizada por {{ $contrato->empresa->sigla }}, 
                el cliente deberá estar al día en todos los pagos y gastos que se hayan generado por los servicios prestados por {{ $contrato->empresa->sigla }} Para que el 
                cliente pueda efectuar el retiro deberá necesariamente pagar el total de las obligaciones y facturas correspondiente a dicho depósito, considerándose ésta de 
                plazo vencido a más tardar el día de la fecha de retiro.</li>
            <li>Para la realización de los servicios se debe contar con contrato firmado. </li>
        </ol>
        <p></p>

        <b>DECIMOSÉPTIMO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>ARBITRAJE</u></b><br>
        Cualquier dificultad que se pueda producir con motivo de este contrato, su interpretación, aplicación, validez, nulidad o cualquiera otra, será resuelta en calidad de 
        árbitro mixto y en única instancia por un árbitro designado de común acuerdo entre las partes. En caso de no aceptar o no poder ejercer el cargo, la designación del 
        árbitro será hecha por la Justicia Ordinaria. El arbitraje tendrá lugar en la ciudad de Santiago.
        <p></p>
    
        <b>DECIMOCTAVO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>DOMICILIO</u></b><br>
        Las partes fijan domicilio convencional en la ciudad y comuna de Santiago para todos los efectos legales que pudieren emanar del presente contrato y se someten 
        expresamente a la competencia y jurisdicción del Tribunal Arbitral que se designe conforme lo expresado en la cláusula Sexta precedente.
        <p></p>
    
        <b>DECIMONOVENO: @for ($i = 0; $i < 20; $i++) &nbsp; @endfor <u>FIRMA</u></b><br>
        <ol type="a">
            <li>El presente contrato se firma en dos ejemplares del mismo tenor, quedando uno en poder de cada una de las partes.</li>
            <li>No obstante lo señalado en la comparecencia del presente instrumento, quienes se individualizan como representantes de las partes viene en declarar 
                expresamente que asumen sobre sí todas las responsabilidades a que diere lugar la insuficiencia o inexistencia del mandato en virtud del cual comparecen 
                en representación del cada parte, obligándose cada uno personalmente para con la contraparte a pagarle todas aquellas sumas que se adeuden y/o los perjuicios 
                que se le hubiesen producido. Lo anterior, sin perjuicio de las demás responsabilidades legales que pudieren corresponderle en conformidad a la ley.</li>
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
    </tbody>
</table>
<br>
<table>
    <tbody>
        <tr>
            <td><b>SERVICIO</b></td>
            <td><b>UNIDAD</b></td>
            <td align="right"><b>PRECIO UF</b></td>
        </tr>
        @foreach ($valores as $valor)
        <tr>
            <td>{{ $valor->servicio->descripcion }}</td>
            <td>{{ $valor->servicio->uni_cobro->descripcion }}</td>
            <td align="right">{{ $valor->valor }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
Nota: Los ingresos y salidas (carga y descarga) de productos se cobran juntos cada vez que llega mercadería a nuestras bodegas, 
por lo tanto, cuando se retiran los productos ambos servicios ya están cobrados.<p></p>
El cliente tendrá hasta 1m3 / Tonelada de retiro basura al mes.<br>
Exceso de retiro de escombros 0,9 UF. m3 / Ton.<p></p>
Previo acuerdo en situaciones en las que sea necesario contratar el servicio de maquinaria especial destinada para los movimientos de 
carga y/o descarga, se traspasará el valor de este servicio al depositante de la mercadería, como así también se traspasará el valor 
de UF 0.75 por cada hora extraordinaria de trabajo previamente acordado.<p></p>

(1): Las horas extra incluyen 1 persona. Los días sábado se cobra un mínimo de 2 horas extra.<br>
(2): Las horas extra incluidas en esta tarifa son las realizadas los días hábiles de 7:00 a 8:30 y/o de 18:30 a 19:30 y los 
sábados de 8:30 a 13:00 hrs.<br>
<p></p>
Los precios están expresados en Unidades de Fomento (UF) y son netos más IVA. El valor del bodegaje mensual y el costo de administración 
se facturarán por mes anticipado. El valor correspondiente a servicios adicionales se facturará mensualmente, basándose en la liquidación 
de lo realizado en el mes.

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

<p align='center'><u><b><font size="+1">ANEXO 3: AUTORIZACIÓN PARA RETIRO DE MERCADERÍA</font></b></u></p>
<p>Doy Poder a las siguientes personas para retirar y/o autorizar retiros de mercaderías de nuestra propiedad de acuerdo al contrato de bodegaje 
o deposito firmado con {{ $contrato->empresa->sigla }}</p>
<p>Las órdenes de entrega deberán especificar al menos:</p>
<ol type="-">
    <li>texto</li>
    <li>Nombre y Rut de quien retira,</li>
    <li>Nombre y cantidad de producto,</li>
    <li>Patente del camión que retira,</li>
    <li>Nombre y firma de la persona que autoriza el retiro.</li>
</ol>

<b>Autorizado(s) a retirar.</b>
<table>
    <tbody>
        @foreach ($contrato->contratoautretiros as $autretiro)
        <tr>
            <td></td>
            <td>
                * Nombre<br>
                * Rut<br>
                * E-Mail<br>
                * Teléfono<br>
                * Celular<br>
            </td>
            <td>
                : @if($autretiro->nombre <> '') {{ $autretiro->nombre }} @else n/a @endif <br>
                : @if($autretiro->rut <> '') {{ $autretiro->rut }} @else n/a @endif <br>
                : @if($autretiro->email <> '') {{ $autretiro->email }} @else n/a @endif <br>
                : @if($autretiro->telefono <> '') {{ $autretiro->telefono }} @else n/a @endif <br>
                : @if($autretiro->celular <> '') {{ $autretiro->celular }} @else n/a @endif <br>
            </td>
            <td align="center">
                <br><br>_________________________<br>
                @for ($i = 0; $i < 10; $i++) &nbsp; @endfor FIRMA
            </td>
        </tr>
        <tr><br></tr>
        @endforeach
    </tbody>
</table>
<br><br><br><br>
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

<p align='center'><u><b><font size="+1">ANEXO 4: AVISOS Y COMUNICACIONES</font></b></u></p>

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
                * Celular<br>
            </td>
            <td>
                : Gerald Portus<br>
                : llm@storage.cl<br>
                : (+56)2 2636 8860<br>
                : (+56)9 9228 4690<br>
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
                : (+56)2 2636 8860<br>
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
                : (+56)2 2636 8800<br>
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
                : (+56)2 2636 8813<br>
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
                : (+56)2 2636 8800<br>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
                                                            
<!---  SALTO DE PAGINA --->
<div class="saltoPagina"></div>

<font size="-1">

<p align='center'><b>ANEXO 5: MANDATO PAGO AUTOMÁTICO DE CUENTAS</b></p>
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

storage ====> {{ $contrato->empresa->sigla }}
--->