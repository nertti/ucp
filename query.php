<?php

function close_tags($content)
{
	$position = 0;
	$open_tags = array();
	//теги для игнорирования
	$ignored_tags = array('br', 'hr', 'img');

	while (($position = strpos($content, '<', $position)) !== FALSE)
	{
		//забираем все теги из контента
		if (preg_match("|^<(/?)([a-z\d]+)\b[^>]*>|i", substr($content, $position), $match))
		{
			$tag = strtolower($match[2]);
			//игнорируем все одиночные теги
			if (in_array($tag, $ignored_tags) == FALSE)
			{
				//тег открыт
				if (isset($match[1]) AND $match[1] == '')
				{
					if (isset($open_tags[$tag]))
						$open_tags[$tag]++;
					else
						$open_tags[$tag] = 1;
				}
				//тег закрыт
				if (isset($match[1]) AND $match[1] == '/')
				{
					if (isset($open_tags[$tag]))
						$open_tags[$tag]--;
				}
			}
			$position += strlen($match[0]);
		}
		else
			$position++;
	}
	//закрываем все теги
	foreach ($open_tags as $tag => $count_not_closed)
	{
		$content .= str_repeat("</{$tag}>", $count_not_closed);
	}

	return $content;
}
/*--------------------------------------------------------------------------------------------------------*/

$mysqli = new mysqli("localhost", "kii_main", "jkasdjWKdj212l21", "ucp_main");

if ($mysqli->connect_errno) {
    echo "Ошибка: Не удалсь создать соединение с базой MySQL и вот почему: \n";
    echo "Номер_ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$result = $mysqli->query('SELECT `ID`,`DETAIL_TEXT` FROM `b_iblock_element` WHERE ID="14986"');

//$result = $mysqli->query("SELECT `ID`,`PREVIEW_TEXT` FROM `b_iblock_element` WHERE `IBLOCK_ID`=8 ");
//$mysqli->query("UPDATE `b_iblock_element` SET `PREVIEW_TEXT`= DETAIL_TEXT WHERE `IBLOCK_ID`=2 AND `IBLOCK_SECTION_ID`='3'");


while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
		if(stristr($row[1], "../wp-content/uploads") === FALSE){
   			continue;
		}else{
			$row[1] = str_replace("../wp-content/uploads", "/images", $row[1]);
			$mysqli->query("UPDATE `b_iblock_element` SET `DETAIL_TEXT`='".close_tags($row[1])."' WHERE `ID`='".$row[0]."'");
		}

		//$new_post_content = array();
		/*$new_post_content = explode('<!--more-->',$row[1]);  
		$new_post_content[0] = preg_replace('~style=".*?\"~','',$new_post_content[0]); 
		$new_post_content[0] = preg_replace('~align=".*?\"~','',$new_post_content[0]); 
		$new_post_content[0] = preg_replace('~<a.*?\>~','',$new_post_content[0]); 
		$new_post_content[0] = preg_replace('~<a.*?\>~','',$new_post_content[0]); 
		$new_post_content[0] = preg_replace('~</a.*?\>~','',$new_post_content[0]); 
		$new_post_content[0] = preg_replace('~<img.*?\>~','',$new_post_content[0]); 
		$new_post_content[0] = preg_replace('~<br />~','',$new_post_content[0]); */
		
			//$row[1] = str_replace("../wp-content/uploads", "/images", $row[1]);
		
		//$row[1] = str_replace("http://ucp.by/file", "/images/file", $row[1]);	
		//$row[1] = str_replace("http://kii.gov.by/file", "/images/file", $row[1]); 

		/*$row[1] = str_replace("<!--:en-->", "", $row[1]);
		$row[1] = str_replace("<!--:-->", "", $row[1]);*/
		
		//$mysqli->query("UPDATE `b_iblock_element` SET `PREVIEW_TEXT_TYPE`='html' and `PREVIEW_TEXT`='".close_tags($row[1])."' WHERE `ID`='".$row[0]."'");
			//$mysqli->query("UPDATE `b_iblock_element` SET `DETAIL_TEXT`='".close_tags($row[1])."' WHERE `ID`='".$row[0]."'");
} 
$result->close();

$mysqli->close();
print_r("QUERY COMPLETE");
?>