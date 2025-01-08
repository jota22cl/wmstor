@if(auth()->check() && auth()->user()->empresa)
    <img src="{{ asset('storage/' . auth()->user()->empresa->directorio . '/' . auth()->user()->empresa->logo) }}" 
        alt="{{ auth()->user()->empresa->sigla }}"
        class="h-16">
@else
    <img src="{{ asset('images/WMStor-logo2.png') }}" 
        alt="WMStor"
        class="h-16">
@endif
