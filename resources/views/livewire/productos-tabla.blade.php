<div>
    ESTA ES LA TABLA <br>
    NO FUNCIONA O MAS BIEN NO SE UTILIZA
    @php
        dd("aqui estoy en la tabla");
    @endphp
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                dd($productos);
            @endphp
            @if (!empty($productos) && count($productos) > 0)
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>{{ $producto['descripcion'] }}</td>
                        <td>
                            <!-- Aquí puedes incluir acciones de CRUD -->
                            <button>Editar</button>
                            <button>Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No hay productos disponibles.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
