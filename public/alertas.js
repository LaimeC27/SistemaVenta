

document.addEventListener('DOMContentLoaded', () => {
    Livewire.on('CreacionCorrecta', (mensaje) => {
        Swal.fire({
            position: "center",
            icon: "success",
            title: mensaje,
            showConfirmButton: false,
            timer: 1500
        });
    });

    Livewire.on('ActualizacionCorrecta', (mensaje) => {
        Swal.fire({
            position: "center",
            icon: "success",
            title: mensaje,
            showConfirmButton: false,
            timer: 1500
        });
    });

    Livewire.on('MensajeError', (mensaje) => {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: mensaje,
          
          });
    });


});






