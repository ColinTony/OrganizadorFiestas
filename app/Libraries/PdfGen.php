<?php namespace App\Libraries;
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
// Al requerir el autoload, cargamos todo lo necesario para trabajar
require_once APPPATH."ThirdParty/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
// Introducimos HTML de prueba
class PdfGen{
	
	// por defecto, usaremos papel A4 en vertical, salvo que digamos otra cosa al momento de generar un PDF
	public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  	{
	    $dompdf = new DOMPDF();
	    $dompdf->loadHtml($html);
	    $dompdf->setPaper($paper, $orientation);
	    $dompdf->render();
		if ($stream)
			$dompdf->stream($filename.".pdf", array("Attachment" => 0));
		else 
			return $dompdf->output();
	}
}
?>