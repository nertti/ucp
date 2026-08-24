<?
AddEventHandler("fileman", "OnBeforeHTMLEditorScriptRuns", Array("MyClass", "onIncludeHTMLEditorScript"));
class MyClass
{
    function onIncludeHTMLEditorScript(){
        $path = '/bitrix/modules/ab.tools/asset';
        \CJSCore::RegisterExt('ab_html_edit', [
            'js' => [
                $path.'/js/script.js',
            ],
            'css' => [

            ]
        ]);
        \CJSCore::Init(array('jquery','ab_html_edit'));
    }
}

AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    if(
    !defined('ADMIN_SECTION') &&
    defined("ERROR_404")
) {
        //LocalRedirect("/404.php", "404 Not Found");
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
        include($_SERVER["DOCUMENT_ROOT"]."/404.php");
        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
    }
}
{
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/agents.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/agents.php");
    }
	
// Очистка папки /upload/iblock от ненужных изображений
function CleanUpUpload() {

    global $DB;

    define("NO_KEEP_STATISTIC", true);
    define("NOT_CHECK_PERMISSIONS", true);
    $deleteFiles = 'no'; //Удалять ли найденые файлы yes/no
    $saveBackup = 'yes'; //Создаст бэкап файла yes/no
    //Папка для бэкапа
    $patchBackup = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock_backup/";
    //Целевая папка для поиска файлов
    $rootDirPath = $_SERVER['DOCUMENT_ROOT'] . "/upload/iblock";

    $time_start = microtime(true);

    //Создание папки для бэкапа
    if (!file_exists($patchBackup)) {
        CheckDirPath($patchBackup);
    }

    // Получаем записи из таблицы b_file
    $arFilesCache = array();
    $result = $DB->Query('SELECT FILE_NAME, SUBDIR FROM b_file WHERE MODULE_ID = "iblock"');
    while ($row = $result->Fetch()) {
        $arFilesCache[$row['FILE_NAME']] = $row['SUBDIR'];
    }
    $hRootDir = opendir($rootDirPath);
    $count = 0;
    $contDir = 0;
    $countFile = 0;
    $i = 1;
    $removeFile=0;
    $h = fopen('iblock.log', 'w');
    while (false !== ($subDirName = readdir($hRootDir))) {
        if ($subDirName == '.' || $subDirName == '..') {
            continue;
        }
        //Счётчик пройденых файлов
        $filesCount = 0;
        $subDirPath = "$rootDirPath/$subDirName"; //Путь до подкатегорий с файлами
        $hSubDir = opendir($subDirPath);
        while (false !== ($fileName = readdir($hSubDir))) {
            if ($fileName == '.' || $fileName == '..') {
                continue;
            }
            $countFile++;
            if (array_key_exists($fileName, $arFilesCache)) { //Файл с диска есть в списке файлов базы - пропуск
                $filesCount++;
                continue;
            }
            $fullPath = "$subDirPath/$fileName"; // полный путь до файла
            fwrite($h, $fullPath . "\n");
            $backTrue = false; //для создание бэкапа
            if ($deleteFiles === 'yes') {
                if (!file_exists($patchBackup . $subDirName)) {
                    if (CheckDirPath($patchBackup . $subDirName . '/')) { //создал поддиректорию
                        $backTrue = true;
                    }
                } else {
                    $backTrue = true;
                }
                if ($backTrue) {
                    if ($saveBackup === 'yes') {
                        CopyDirFiles($fullPath, $patchBackup . $subDirName . '/' . $fileName); //копия в бэкап
                    }
                }
                //Удаление файла
                if (unlink($fullPath)) {
                    $removeFile++;
                }
            } else {
                $filesCount++;
            }
            $i++;
            $count++;
            unset($fileName, $backTrue);
        }
        closedir($hSubDir);
        //Удалить поддиректорию, если удаление активно и счётчик файлов пустой - т.е каталог пуст
        /* if ($deleteFiles && !$filesCount) {
            rmdir($subDirPath);
        } */
        $contDir++;
    }
    fclose($h);
    closedir($hRootDir);
    return "CleanUpUpload();";
}
// Конец очистки




/* function formEvent($WEB_FORM_ID, $RESULT_ID)
{
  if ($WEB_FORM_ID == 1){
    $fields = array();
    $arAnswers = CFormResult::GetDataByID($RESULT_ID, $fields);

    // запишем в дополнительное поле 'user_ip' IP-адрес пользователя
    CFormResult::SetField($RESULT_ID, 'user_ip', $_SERVER["REMOTE_ADDR"]);

    $fileHandler = fopen(__DIR__ . DIRECTORY_SEPARATOR . "formResult", "a");
    fwrite($fileHandler, print_r($arAnswers, true));
    fclose($fileHandler);          
  }
} */


/* 
function my_onBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
  global $APPLICATION;
  
  
  // действие обработчика распространяется только на форму с ID=6
  if ($WEB_FORM_ID == 1){

    // запишем в дополнительное поле 'user_ip' IP-адрес пользователя
    CFormResult::SetField($RESULT_ID, 'user_ip', $_SERVER["REMOTE_ADDR"]);


    $fileHandler = fopen(__DIR__ . DIRECTORY_SEPARATOR . "formResult", "a");
    fwrite($fileHandler, print_r($arFields, true));
    fwrite($fileHandler, print_r($arrVALUES, true));
    fclose($fileHandler);      



    
  }
}






//AddEventHandler('form', 'onAfterResultAdd', 'formEvent');
//AddEventHandler('form', 'onAfterResultUpdate', 'formEvent');

AddEventHandler('form', 'onBeforeResultAdd', 'my_onBeforeResultAdd');





function my_onAfterResultAddUpdate($WEB_FORM_ID, $RESULT_ID)
{
  // действие обработчика распространяется только на форму с ID=6
  if ($WEB_FORM_ID == 1) 
  {

    $fields = array();
    $arAnswer = CFormResult::GetDataByID(
        $RESULT_ID, 
        array(), 
        $arResult, 
        $arAnswer2);


    // запишем в дополнительное поле 'user_ip' IP-адрес пользователя
    CFormResult::SetField($RESULT_ID, 'user_ip', $_SERVER["REMOTE_ADDR"]);
    
    
    $fileHandler = fopen(__DIR__ . DIRECTORY_SEPARATOR . "formResult", "a");
    fwrite($fileHandler, print_r($arResult, true));
    fwrite($fileHandler, print_r($arAnswer2, true));
    fclose($fileHandler);      
  }
}

// зарегистрируем функцию как обработчик двух событий
AddEventHandler('form', 'onAfterResultAdd', 'my_onAfterResultAddUpdate');
AddEventHandler('form', 'onAfterResultUpdate', 'my_onAfterResultAddUpdate');

 */


?>