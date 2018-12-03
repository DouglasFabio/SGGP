<?php

    $exibe = $_POST['exibe'];

    require_once("../Uteis/dompdf/dompdf_config.inc.php");

        $dompdf = new DOMPDF();

        $dompdf->load_html($exibe);

        $dompdf->render();

        $dompdf->stream(
            "Relatório.pdf",
            array(
                "Attachment" => false
            )
        );

?>

