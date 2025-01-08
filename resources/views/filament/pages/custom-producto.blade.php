<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <br>

        <!-- Botón para Ingresar Productos -->
        <x-filament::button type="submit" 
                            :disabled="!$ccosto_id || !$cliente_id || !$bodega_id">
            Ingresar Productos
        </x-filament::button>

        <!-- Botón para Guía de Entrada -->
        <x-filament::button type="button" wire:click="goToGuiaIngreso"
                            :disabled="!$ccosto_id || !$cliente_id || !$bodega_id">
            Guía de Ingreso
        </x-filament::button>

        <!-- Botón para Guía de Salida -->
        <x-filament::button type="button" wire:click="goToGuiaSalida"
                            :disabled="!$ccosto_id || !$cliente_id || !$bodega_id">
            Guía de Salida
        </x-filament::button>
    </form>
</x-filament::page>
