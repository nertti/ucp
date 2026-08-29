<?php
/*
  ////////////////////////////////////////////////////////// 
  // Рекурсивная функция - спускаемся вниз по каталогу 
  ////////////////////////////////////////////////////////// 
  // Объявляем переменные замены глобальными 
  GLOBAL $text, $retext;
  
  function scan_dir($dirname) 
  { 
    $text = "http://docs.google.com/viewer"; 
	//echo  $text;
    // Открываем текущую директорию 
    $dir = opendir($dirname); 
    // Читаем в цикле директорию 
    while (($file = readdir($dir)) !== false) 
    { 
      // Если файл обрабатываем его содержимое 
      if($file != "." && $file != "..") 
      { 
        // Если имеем дело с файлом - производим в нём замену 
        if(is_file($dirname."/".$file)) 
        { 
          // Читаем содержимое файла 
          $content = file_get_contents($dirname."/".$file); 
          // Осуществляем замену 
		  if(stristr($content, $text)) { 
			  echo $dirname."/".$file.'<br/>'; 
		  }
          //******* $content = str_replace($text, $retext, $content); 
          // Перезаписываем файл 
         //****** file_put_contents($dirname."/".$file,$content); 
        } 
        // Если перед нами директория, вызываем рекурсивно 
        // функцию scan_dir 
        if(is_dir($dirname."/".$file)) 
        { 
          //echo $dirname."/".$file."<br>"; 
          scan_dir($dirname."/".$file); 
        } 
      } 
    } 
    // Закрываем директорию 
    closedir($dir); 
  }
  
 
  //$retext = '$retext'; // Строка замены
  $dirname = $_SERVER["DOCUMENT_ROOT"].'';     
  scan_dir($dirname);  // Вызов рекурсивной функции
  */
?>

<? 
function utf_to_win($str){
$str=strtr($str,array("Р°"=>"а","Р±"=>"б","РІ"=>"в","Рі"=>"г","Рґ"=>"д","Рµ"=>"е","С‘"=>"ё",
"Р¶"=>"ж","Р·"=>"з",
"Рё"=>"и","Р№"=>"й","Рє"=>"к","Р»"=>"л","Рј"=>"м","РЅ"=>"н","Рѕ"=>"о","Рї"=>"п",
"СЂ"=>"р","СЃ"=>"с","С‚"=>"т","Сѓ"=>"у","С„"=>"ф","С…"=>"х","С†"=>"ц",
"С‡"=>"ч","С?"=>"ш","С‰"=>"щ","СЉ"=>"ъ","С‹"=>"ы","СЊ"=>"ь",
"СЌ"=>"э","СЋ"=>"ю","СЏ"=>"я",
"Рђ"=>"А","Р‘"=>"Б","Р’"=>"В","Р“"=>"Г","Р”"=>"Д",
"Р•"=>"Е","РЃ"=>"Ё","Р–"=>"Ж","Р—"=>"З","Р˜"=>"И","Р™"=>"Й","Рљ"=>"К","Р›"=>"Л",
"Рњ"=>"М","Рќ"=>"Н","Рћ"=>"О","Рџ"=>"П","Р "=>"Р",
"РЎ"=>"С","Рў"=>"Т","РЈ"=>"У","Р¤"=>"Ф","РҐ"=>"Х",
"Р¦"=>"Ц","Р§"=>"Ч","РЁ"=>"Ш","Р©"=>"Щ","РЄ"=>"Ъ","Р«"=>"Ы",
"Р¬"=>"Ь","Р­"=>"Э","Р®"=>"Ю","РЇ"=>"Я"));
 return $str; 
}

function convert_files($start_dir='.') {	
    $files = array(); 
    if (is_dir ($start_dir)) {	 
        $fh = opendir ($start_dir);
        while (($file = readdir ($fh)) !== false) {
            if ($file == '.' || $file == '..') continue;
            $filepath = $start_dir.'/'.$file;
            if (is_dir($filepath)) /*$files = array_merge($files,*/ convert_files($filepath)/*)*/;
            $new_filepath = iconv('utf-8', 'cp1251', $filepath);   
			
            if ($filepath !== $new_filepath){ 
				//echo mb_detect_encoding($filepath);
				//echo mb_convert_encoding($filepath,"UTF-8","Windows-1251").'<br/>';  
				//echo utf_to_win($filepath).'<br/>';  
				//echo $filepath.' --- '.$new_filepath.'<br/>';   			 
				rename($filepath, $start_dir.'/'.utf_to_win($file));      
			}
        }   
		closedir($fh);
    } else {
        $files = false;
    }
	echo "Ok "; 
    return $files; 
}
 
//$files = convert_files($_SERVER["DOCUMENT_ROOT"].'/images');         
?>