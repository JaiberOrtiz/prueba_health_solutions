
<div class="row divPrincipal">
    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input type="text" class="form-control buscador" id="floatingInput" data-url="<?php echo getUrl('Cotizacion','Cotizacion','obtenerResultadosBusqueda', FALSE, 'ajax') ;?>">
            <label for="floatingInput">Digite el n&uacute;mero cotizaci&oacute;n</label>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-striped tablaGeneral">
        <thead>
            <tr>
                <th>Id Cotizacion</th>
                <th>Identificaci&oacute;n del paciente</th>
                <th>Nombre paciente</th>
                <th>Nombre del profesional</th>
                <th>Hora de cita</th>
                <th>Fecha de cita</th>
                <th>Precio Cotizacion</th>
            </tr>
        </thead>
        <tbody id="cuerpoTablaCotizacion">
            <?php 
            if(isset($data)){
            foreach($data as $key => $value) { //dd($value)?>
            <tr>
                <td><?php echo $value['id'] ?></td>
                <td><?php echo $value['identificacionpaciente'] ?></td>
                <td><?php echo $value['nombrepaciente'] . " " . $value['apellidopaciente'] ?></td>
                <td><?php echo $value['nombreprofesional'] . " " . $value['apellidoprofesional'] ?></td>
                <td><?php echo substr($value['horainiciocita'],0,-3) . " a " . substr($value['horafincita'], 0, -3) ?></td>
                <td><?php echo $value['fechacita'] ?></td>
                <td><?php echo number_format($value['preciocotizacion'],0,',','.') ?></td>
            </tr>
            <?php }
            } ?>

        </tbody>
        </table>
    </div>
</div>
