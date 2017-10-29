<?php
    $name = $_GET['document'];
    //print_r($_GET);exit;
    $name="download-documents/".$name.".pdf";
    //echo $name;exit;
    if ($name && preg_match("/\.pdf$/i", $name) && file_exists($name))
    {
            header('Content-Description: File Transfer');
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($name));
            header("Content-Disposition: attachment; filename=" . basename($name));
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            ob_clean();
            flush();
            readfile($name);
            exit;
    }