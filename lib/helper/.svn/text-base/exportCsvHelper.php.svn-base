<?php

function exportArrayToCSV($values, $nbColumns)
{
  $objPHPExcel = new sfPhpExcel();
  
  $objPHPExcel->setActiveSheetIndex(0);
  $nbLigne = count($values)/$nbColumns;
  $occurence = 0;
  
  for($i = 0;$i<$nbLigne;$i++)
  {
    for($indice = 0;$indice<$nbColumns; $indice++)
    {
      $objPHPExcel->getActiveSheet()->setCellValueExplicitByColumnAndRow($indice,$i+1, $values[$occurence]);
      $occurence++;
    }
  }


  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
  $objWriter->setDelimiter(',');
  $objWriter->setEnclosure('');
  $objWriter->setLineEnding("\r\n");
  $objWriter->setSheetIndex(0);
  $objWriter->save(str_replace('.php', '.csv', __FILE__));

  return $objWriter;
  
}