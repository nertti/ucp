<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><?php
/*
$APPLICATION->SetTitle("Title");

if(isset($_POST['name'])&&$_POST['name']!="") {
$name = htmlentities($_POST['name']);
//$date = htmlentities($_POST['date']);
//$discription = htmlentities($_POST['discription']);
//$addres = htmlentities($_POST['addres']);
//$picture =  htmlentities($_POST['picture']);
 

if (CModule::IncludeModule('iblock')){
            $el = new CIBlockElement;

            $arProp["NAME"] = $name;  
      
           
           $arFields = array(
                'NAME' => $fio."-".$mail,               
                'MODIFIED_BY' => $USER->GetID(),             
                'IBLOCK_ID' => 13,
                'ACTIVE' => 'Y',


                'PROPERTY_VALUES' => $arProp
            );

            $intOfferID = $el->Add($arFields);
}

}

*/

$fname = isset($_POST['fname'])?$_POST['fname'] != ""?$_POST['fname']:"Неизвестный":"Неизвестный";
$lname = isset($_POST['lname'])?$_POST['lname'] != ""?$_POST['lname']:"Неизвестный":"Неизвестный";

$result = [];

$result["result_text"] = sprintf("Спасибо за ваше обращение, %s, наши менеджеры свяжутся с вами по указанному вами номеру телефона: %s", $name, $phone);
$result["status"] = True;
$result["POST"] = $_POST;
echo json_encode($result);

?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>