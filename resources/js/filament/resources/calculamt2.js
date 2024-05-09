document.addEventListener('DOMContentLoaded', () => {
    const largoInput = document.getElementById('largo');
    const anchoInput = document.getElementById('ancho');
    const metrosCuadradosInput = document.getElementById('mt2calc');

    function calcularMetrosCuadrados() {
        const largo = parseFloat(largoInput.value);
        const ancho = parseFloat(anchoInput.value);

        if (!isNaN(largo) && !isNaN(ancho)) {
            const metrosCuadrados = largo * ancho;
            metrosCuadradosInput.value = metrosCuadrados.toFixed(2);
        }
    }

    largoInput.addEventListener('input', calcularMetrosCuadrados);
    anchoInput.addEventListener('input', calcularMetrosCuadrados);
});
