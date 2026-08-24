<style type="text/css">
<!--
.стиль1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 24px;
}
.style2 {
	color: #FF0000;
	font-size: large;
}
.style3 {color: #0000FF}
.style5 {
	font-size: 18px;
	color: #FF0099;
}
.style7 {
	font-size: 24px;
	color: #FF0000;
}
.стиль8 {
	font-size: 20px;
	color: #006633;
}
.стиль9 {color: #FF0000}
.стиль17 {color: #0000FF; font-weight: bold; }
.стиль23 {
	font-size: 36px;
	font-weight: bold;
}
.стиль29 {color: #FF00FF; font-weight: bold; font-size: 24px; }
.стиль31 {color: #FF00FF}
.стиль32 {color: #0000FF; font-weight: bold; font-size: 24px; }
.стиль33 {font-size: 24px; color: #000000; }
.стиль34 {color: #FF0000; font-weight: bold; font-size: 36px; }
.стиль38 {font-size: 20px; color: #006633; font-weight: bold; }
.стиль39 {color: #FF00FF; font-weight: bold; font-size: 16px; }
.стиль40 {
	font-size: 18px;
	font-weight: bold;
	color: #009933;
}
.стиль41 {font-size: 16px; font-weight: bold; color: #0000FF; font-style: italic; }
.стиль42 {color: #FF0000; font-weight: bold; font-size: 32px; }
.стиль44 {color: #FF0000; font-size: 20px; }
.стиль46 {
	font-size: 24px;
	color: #990099;
	font-weight: bold;
}
.стиль48 {color: #006600}
-->
</style>


<hr />
<p align="center" class="стиль1">Информация по успеваемости</p>


<?php

$name=htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
//echo $name.' ';
echo "<div align='center' class='стиль32'>".$name.' '."</div>";
echo "<div align='left' class='стиль40'> Текущая успеваемость</div>";
$inputName = $name;


require_once "var.php";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/Minsk');

if (!file_exists($inputFileName)) {
	exit("Нет данных или они обновляются. Попробуйте позже." . EOL);
}

//echo date('H:i:s') , " Загрузка данных" , EOL;
$callStartTime = microtime(true);

require __DIR__ . '/vendor/autoload.php';

#set_include_path('PhpOffice/PhpSpreadsheet/');
#include_once 'PhpOffice/PhpSpreadsheet/IOFactory.php'; 
$objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName); 

//print_r($objPHPExcel);

$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
// Set active filters
$autoFilter = $objPHPExcel->getActiveSheet()->getAutoFilter();
//echo date('H:i:s').' Set active filters'.EOL;
// Filter the Country column on a filter value of countries beginning with the letter U (or Japan)
//     We use * as a wildcard, so specify as U* and using a wildcard requires customFilter


//$inputName = iconv('cp1251', 'utf-8','Чиникайло Андрей Игоревич');


$autoFilter->getColumn('B')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';


		 //   echo "<td>".iconv('utf-8', 'cp1251',($objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue())), ' '."</td>";

	    echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
            'A'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

         echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
            'C'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'D'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'E'.$row->getRowIndex()
        )->getValue(), ' '."</div></td>";

//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';

echo '<br><hr />';




//$name=$_POST['name'];
//echo $name.' ';
//echo "<div align='center' class='стиль32'>".$name.' '."</div>";
echo "<br><div align='left' class='стиль40'> 1-й семестр</div>";
//$inputName = iconv('cp1251', 'utf-8',$name);


require_once "var.php";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/Minsk');

if (!file_exists($inputFileName2)) {
	exit("Нет данных по сессии или они обновляются. Попробуйте позже." . EOL);
}

//echo date('H:i:s') , " Загрузка данных" , EOL;
$callStartTime = microtime(true);

#set_include_path(get_include_path() . 
#PATH_SEPARATOR . '\PhpOffice\PhpSpreadsheet'); 
#include_once 'PhpOffice/PhpSpreadsheet/IOFactory.php'; 
$objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName2); 

//print_r($objPHPExcel);

$objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());
// Set active filters
$autoFilter = $objPHPExcel->getActiveSheet()->getAutoFilter();
//echo date('H:i:s').' Set active filters'.EOL;
// Filter the Country column on a filter value of countries beginning with the letter U (or Japan)
//     We use * as a wildcard, so specify as U* and using a wildcard requires customFilter


//$inputName = iconv('cp1251', 'utf-8','Чиникайло Андрей Игоревич');


$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".iconv('utf-8', 'cp1251',($objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue())), ' '."</td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'F'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'G'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'H'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'I'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

	
	
	
	
	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'J'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'K'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'L'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'M'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'N'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'O'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'P'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'Q'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'R'.$row->getRowIndex()
        )->getValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'S'.$row->getRowIndex()
        )->getValue(), ' '."</div></td>";

//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table><br>';




echo "<br><div align='left' class='стиль40'> 2-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";
     
	   echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'U'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'V'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'W'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'X'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	 }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {


echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'Y'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'Z'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AA'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AB'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {



echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AC'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AD'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AE'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AF'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';


 echo "<br><br><div align='left' class='стиль40'> 3-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";

	 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AH'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AI'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AJ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AK'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AL'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AM'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AN'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AO'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AP'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AQ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AR'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';
 




 echo "<br><br><div align='left' class='стиль40'> 4-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";


	 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AT'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AU'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AV'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AW'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AX'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		
		 
		 }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {



		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AY'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'AZ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BA'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BB'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {



	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BC'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BD'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BE'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BF'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BG'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";





//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';








 echo "<br><br><div align='left' class='стиль40'> 5-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BI'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BJ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BK'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BL'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	
}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BM'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BN'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BO'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BP'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BQ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {


echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BR'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BS'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BT'.$row->getRowIndex()
        )->getValue(), ' '."</div></td>";


echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BU'.$row->getRowIndex()
        )->getValue(), ' '."</div></td>";

//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';






 echo "<br><br><div align='left' class='стиль40'> 6-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BW'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BX'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BY'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'BZ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CA'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CB'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CC'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CD'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CE'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CF'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CG'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CH'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CI'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';






 echo "<br><br><div align='left' class='стиль40'> 7-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CK'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CL'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CM'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CN'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

	echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CO'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {



echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CP'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CQ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CR'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CS'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CT'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


}
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CU'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CV'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CW'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

//        echo EOL;
    }
	echo "</tr>"; 
}
echo '</table>';


echo "<br><br><div align='left' class='стиль40'> 8-й семестр</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CY'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'CZ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
			   'DA'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DB'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		  echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DC'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


		  }
	echo "</tr>"; 
}
echo '</table><br>';
 echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {

		   echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DD'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DE'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

 echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DF'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

  echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DG'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";


		
    }
	echo "</tr>"; 
}
echo '</table>';




echo "<br><br><div align='left' class='стиль40'> ЭКЗАМЕНЫ</div>";
$autoFilter->getColumn('C')
    ->setFilterType(\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column::AUTOFILTER_FILTERTYPE_FILTER)
    ->createRule()
		->setRule(
			\PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::AUTOFILTER_COLUMN_RULE_EQUAL,
			$inputName
		);
// Execute filtering
//echo date('H:i:s').' Execute filtering'.EOL;
$autoFilter->showHideRows();

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Display Results of filtering
//echo date('H:i:s').' Отфильтрованные строки'.EOL;
  echo '<table border="1" cellpadding="2" cellspacing="0">'; 
foreach ($objPHPExcel->getActiveSheet()->getRowIterator() as $row) {
    echo "<tr>";
	if ($objPHPExcel->getActiveSheet()->getRowDimension($row->getRowIndex())->getVisible()) {
    //    echo '    Row number - ' , iconv('utf-8', 'cp1251',$row->getRowIndex()) , ' ';
      
	  
		 //   echo "<td>".$objPHPExcel->getActiveSheet()->getCell(
     //      'B'.$row->getRowIndex()
     //   )->getValue(), ' '."</td>";
     
	    echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DI'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

         echo "<td><div align='center'>".$objPHPExcel->getActiveSheet()->getCell(
            'DJ'.$row->getRowIndex()
        )->getFormattedValue(), ' '."</div></td>";

		
    }
	echo "</tr>"; 
}
echo '</table>';
























?>

</p>
<hr />

