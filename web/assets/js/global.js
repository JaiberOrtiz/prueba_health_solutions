$(document).ready(function () {
    let table = new DataTable('.tablaGeneral', {
        searching: false,
        lengthChange: false,
        ordering: false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        }
    });

    $(document).on('keyup','.buscador',function(){
        let valor = $(this).val();
        let url = $(this).attr('data-url')
        $.ajax({
            type: 'POST',
            url: url,
            dataType: "json",
            data:{valor : valor},
            success: function (response) {
                let tbody = $('#cuerpoTablaCotizacion');
                tbody.empty();
                if (response.length > 0) {
                    response.forEach(function (value) {
                        tbody.append(`
                            <tr>
                                <td>${value.id}</td>
                                <td>${value.identificacionpaciente}</td>
                                <td>${value.nombrepaciente} ${value.apellidopaciente}</td>
                                <td>${value.nombreprofesional} ${value.apellidoprofesional}</td>
                                <td>${value.horainiciocita.substring(0, value.horainiciocita.length - 3)} ${"a"} ${value.horafincita.substring(0, value.horafincita.length - 3)}</td>
                                <td>${value.fechacita}</td>
                                <td>${new Intl.NumberFormat("es-CO").format(value.preciocotizacion)}</td>
                            </tr>
                        `);
                    });
                } else {
                    tbody.append(`
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron resultados</td>
                        </tr>
                    `);
                }
            }
        })
    })
})
