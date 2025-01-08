<x-filament::page>
    {{ $this->form }}

    <div class="mt-4 text-left">
        <a href="{{ route('filament.admin.resources.guia-ingresos.index') }}"
        class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-black hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
            Cerrar
        </a>
    </div>
</x-filament::page>