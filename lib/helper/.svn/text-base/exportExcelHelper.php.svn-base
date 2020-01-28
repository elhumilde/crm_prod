<?php
/**
 * Convertir le text BBCode en HTML Code.
 *
 * @param string $bbcodeText
 * @return string html code
 */
function exportArrayToExcel($values, $nbColumns)
{
  $objPHPExcel = new sfPhpExcel();

  // Set properties
  $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
  $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
  $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
  $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
  $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
  $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");
  $objPHPExcel->getProperties()->setCategory("Test result file");


  // Add some data
  $objPHPExcel->setActiveSheetIndex(0);
  $nbLigne = count($values)/$nbColumns;
  //var_dump($values);die;
  $occurence = 0;
  for($i = 0;$i<$nbLigne;$i++)
  {
    for($indice = 0;$indice<$nbColumns; $indice++)
    {
      $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($indice,$i+1, $values[$occurence]);
      $occurence++;
    }
  }
  // Rename sheet
  $objPHPExcel->getActiveSheet()->setTitle('Simple');


  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);

  $filename = "centrelec_data_" . date('Ymd') . ".xls";
  //header("Content-Disposition: attachment; filename=\"$filename\"");
  //header("Content-Type: application/vnd.ms-excel");
  // Save Excel 2007 file
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  //var_dump($objWriter);
  $objWriter->save(str_replace('.php', '.xls', __FILE__));
  return $objWriter;
  // Echo memory peak usage
  //echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";
}