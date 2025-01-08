<!-- resources/views/components/valorservicio-grid.blade.php -->
@php
$ccostos = \App\Models\Ccosto::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->get();
$servicios = \App\Models\Servicio::where('empresa_id',auth()->user()->empresa_id)->where('vigente',true)->get();
@endphp

@if($operation == 'edit')


@php
        $valores = \App\Models\Valorservicio::where('empresa_id',auth()->user()->empresa_id)->where('fecha',$getRecord()->fecha)->get();
    @endphp

    <div>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 p-2">Servicio\Costo</th>
                    @foreach($ccostos as $ccosto)
                        <th class="border border-gray-300 p-2">{{ $ccosto->codigo }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $servicio->descripcion }}</td>
                        @foreach($ccostos as $ccosto)
                            @php
                                $valor = $valores->where('ccosto_id', $ccosto->id)->where('servicio_id', $servicio->id)->first();
                                $monto = $valor ? $valor->valor : '';
                            @endphp
                            <td class="border border-gray-300 p-2">
                                <input type="number" name="valores[{{ $servicio->id }}][{{ $ccosto->id }}]" value="{{ $monto }}" class="w-full border-gray-300 p-1">
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
