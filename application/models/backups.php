<?php

class Backups extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function generarBackUp() {
        // Carga la clase de utilidades de base de datos
        $this->load->dbutil();

        // Crea una copia de seguridad de toda la base de datos y la asigna a una variable
        $copia_de_seguridad = & $this->dbutil->backup();

        // Carga el asistente de archivos y escribe el archivo en su servidor
        //$this->load->helper('file');
        //write_file('/ruta/a/copia_de_seguridad.gz', $copia_de_seguridad); 
        // Carga el asistente de descarga y envía el archivo a su escritorio
        $this->load->helper('download');
        force_download('copia_de_seguridad.gz', $copia_de_seguridad);
    }

    function restoreDataBase() {
        ob_start();
        readgzfile($path_al_archivo);
        $data = ob_get_clean();
        ob_end_clean();

        $this->db->trans_start();
        $this->db->query('set foreign_key_checks=0;');


        $data = nl2br($data);
        $data_arr = explode('<br />', $data);
        foreach ($data_arr as $query) {
            //esta truchada era para asegurarme de estar ejecutando los inserts
            $pos = stripos($query, 'INSERT');

            if ($pos !== false && $pos < 5) {
                $this->db->query($query);
            }
        }

        $this->db->query('SET foreign_key_checks=1;');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            
            } else {

        }
    }

}

?>