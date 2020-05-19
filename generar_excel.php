<?php
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once ('PHPExcel-1.8/Classes/PHPExcel.php');


$xlsnombre = "Detalle.xlsx";


$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("")
							 ->setLastModifiedBy("")
							 ->setTitle("")
							 ->setSubject("")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");





$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nombre:')
            ->setCellValue('B1', 'PRUEBA')
            ->setCellValue('A2', 'Producto:')
            ->setCellValue('B2', 'PRODUCTO')
            ->setCellValue('A3', 'Mensaje:')
            ->setCellValue('B3', 'AQUI EL MENSAJE')
            ->setCellValue('A4', 'Fecha:')
            ->setCellValue('B4', '12 de diciembre de 1985');
			

	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A10', 'Nombre')
	->setCellValue('B10', 'Apellido')
	->setCellValue('C10', 'Telefono')
	->setCellValue('D10', 'Fecha de nacimiento');

	$headerStyle = array(
		'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb'=>'4F81BD'),
	),
		'font' => array(
		'bold' => true,
		'color' => array('rgb'=>'FFFFFF')
	)
	);


	#esta linea aplica un estilo al fondo, yo la utilizo para los titulos de las columnas.
	$objPHPExcel->getActiveSheet()->getStyle('A10:D10')->applyFromArray($headerStyle);


for($x=11; $x < 20; $x++)
{


	#ESTO ES LO QUE TENES QUE METER EN UN WHILE QUE RECORRA LOS DATOS DE TU TABLA.
	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.$x, 'Prueba '.$x.' nombre')
	->setCellValue('B'.$x, 'Prueba '.$x.'  apellido')
	->setCellValue('C'.$x, 'prueba '.$x.'  telefono ')
	->setCellValue('D'.$x, 'prueba '.$x.'  fecha de nacimiento');
 
}

	#Estas lineas te permite autodimencionar las columnas para que se vean completas.
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);



#ACA PODES DEFINIR EL NOMBRE DEL LIBRO
$objPHPExcel->getActiveSheet()->setTitle('Detalle');

$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="NOMBREDELARCHIVO.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

#Esto es para que se genere el excel al ingresar al script, podes definir una ruta y directamente te genera el excel y lo guarda en la ruta que definas, siempre y cuando tenga los permisos para escribir en el servidor.
$objWriter->save('php://output');
exit;
?>