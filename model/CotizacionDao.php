<?php
include_once "../libs/conf/Connection.php";
class CotizacionDao extends Connection{

    public function select($where = false){
        $sql = "Select 
            com_quotation.com_quotation_id AS id,
            patient.gbl_entity_name AS nombrePaciente,
            patient.gbl_entity_last_name AS apellidoPaciente,
            patient.gbl_entity_identification_number AS identificacionPaciente,
            professional.gbl_entity_name AS nombreProfesional,
            professional.gbl_entity_last_name AS apellidoProfesional,
            sch_event.init_date AS fechaCita,
            sch_slot.init_time AS horaInicioCita,
            sch_slot.end_time AS horaFinCita,
            com_quotation.com_quotation_date AS fechaCotizacion,
            com_quotation_line.com_quotation_price AS precioCotizacion
            from com_quotation
            JOIN com_quotation_line ON com_quotation_line.com_quotation_id = com_quotation.com_quotation_id
            JOIN cnt_medical_order_medicament_quotation ON cnt_medical_order_medicament_quotation.line_id = com_quotation_line.line_id
            JOIN cnt_medical_order_medicament ON cnt_medical_order_medicament.cnt_medical_order_medicament_id = cnt_medical_order_medicament_quotation.cnt_medical_order_medicament_id
            JOIN cnt_medical_order ON cnt_medical_order.cnt_medical_order_id = cnt_medical_order_medicament.cnt_medical_order_id
            JOIN adm_admission_flow ON adm_admission_flow.adm_admission_flow_id = cnt_medical_order.adm_admission_flow_id
            JOIN adm_admission ON adm_admission.adm_admission_id = adm_admission_flow.adm_admission_id
            JOIN adm_admission_appointment ON adm_admission_appointment.adm_admission_id = adm_admission.adm_admission_id
            JOIN sch_workflow_slot_assigned ON sch_workflow_slot_assigned.flow_id = adm_admission_appointment.flow_id
            JOIN sch_slot_assigned ON sch_slot_assigned.sch_slot_assigned_id = sch_workflow_slot_assigned.sch_slot_assigned_id
            JOIN gbl_entity patient ON patient.gbl_entity_id = sch_slot_assigned.gbl_entity_id and patient.gbl_entity_type = 1
            JOIN sch_slot ON sch_slot.sch_slot_id = sch_slot_assigned.sch_slot_id
            JOIN sch_event ON sch_event.sch_event_id = sch_slot.sch_event_id
            JOIN sch_calendar ON sch_calendar.sch_calendar_id = sch_event.sch_calendar_id 
            JOIN gbl_entity professional ON professional.gbl_entity_id = sch_calendar.gbl_entity_id and professional.gbl_entity_type = 2" . $where;
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // clave: devuelve un array asociativo
            return $rows;
        } catch (PDOException $exc) {
            die('Error select() CotizacionDao:<br/>' . $exc->getMessage());
        }
    }
}