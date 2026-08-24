<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Предварительный просмотр");
?>
ID = <input id="el_id" value="<?=htmlspecialchars($_GET["PID"], ENT_QUOTES, 'UTF-8')?>"/><button id="get2_btn">OK</button>  
			
<script type="text/javascript">			
	$('#get2_btn').click(function() {
		window.location.replace("http://ucp.by/preview/?PID="+$("#el_id").val()); 
		return false; 
	});		
</script>
<?

$res = CIBlockElement::GetByID(htmlspecialchars($_GET["PID"], ENT_QUOTES, 'UTF-8'));
if($ar_res = $res->GetNext()){
	echo "<h1>".$ar_res["NAME"]."</h1>";     
	echo '<div  class="news-detail blog-item">';     
		if($ar_res["DETAIL_PICTURE"]){ 
			$det_pic = CFile::GetPath($ar_res["DETAIL_PICTURE"]);	
			echo '<img class="detail_picture" src="'.$det_pic.'"/>';
		};   
		
		$parsStep1 = explode("#FILETREE_", $ar_res["DETAIL_TEXT"]);
		$parsStep2 = explode("#", $parsStep1[1]); 
		ob_start();
		$APPLICATION->IncludeComponent(
			"r:filetree",
			"",
			Array(
				"ALLOWED_EXTENSIONS" => "jpg,png,gif,mp3,pdf,djvu,doc,docx,xls,xlsx,rar,zip",
				"ROOT_FOLDER" => $parsStep2[0]
			),false  
		);
		$outFileTree = ob_get_contents();
		ob_end_clean();   
		$ar_res["DETAIL_TEXT"] = preg_replace("/#FILETREE_(.+)#/",$outFileTree,$ar_res["DETAIL_TEXT"]);  
		
		$parsStep1 = explode("#FORM_", $ar_res["DETAIL_TEXT"]);
		$parsStep2 = explode("#", $parsStep1[1]);
		ob_start();
		$APPLICATION->IncludeComponent(
			"bitrix:form", 
			"conf", 
			array(
				"SEF_MODE" => "Y",
				"WEB_FORM_ID" => $parsStep2[0],
				"RESULT_ID" => "",
				"START_PAGE" => "new",
				"SHOW_LIST_PAGE" => "N",
				"SHOW_EDIT_PAGE" => "N",
				"SHOW_VIEW_PAGE" => "N",
				"SUCCESS_URL" => $_SERVER['REQUEST_URI'].$url,
				"SHOW_ANSWER_VALUE" => "Y",
				"SHOW_ADDITIONAL" => "Y",
				"SHOW_STATUS" => "Y",
				"EDIT_ADDITIONAL" => "Y",
				"EDIT_STATUS" => "Y",
				"NOT_SHOW_FILTER" => array(
					0 => "",
					1 => "",
				),
				"NOT_SHOW_TABLE" => array(
					0 => "",
					1 => "",
				),
				"CHAIN_ITEM_TEXT" => "",
				"CHAIN_ITEM_LINK" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "Y",
				"USE_EXTENDED_ERRORS" => "Y",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "3600",
				"AJAX_OPTION_JUMP" => "Y",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"SEF_FOLDER" => "",
				"COMPONENT_TEMPLATE" => "custom",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SEF_URL_TEMPLATES" => array(
					"new" => "",
					"list" => "",
					"edit" => "",
					"view" => "",
				)
			),false
		);
		$out = ob_get_contents();
		ob_end_clean(); 
		$ar_res["DETAIL_TEXT"] = preg_replace("/#FORM_([A-Za-z-0-9]+)#/",$out,$ar_res["DETAIL_TEXT"]);
		
		echo $ar_res["DETAIL_TEXT"];    

		$photo_prop = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "MORE_PHOTO")); 
		if($photo_prop->result->num_rows>0){
			if($ar_res["LANG_DIR"]=="/") echo "<h2>Галерея</h2>";
			if($ar_res["LANG_DIR"]=="/en/")  echo "<h2>Gallery</h2>";
			if($ar_res["LANG_DIR"]=="/by/")  echo "<h2>Галярэя</h2>";
			$photo_prop_in_row = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "ELEMENTS_IN_ROW")); 
			$photo_prop_in_row_val = $photo_prop_in_row->GetNext();	
			if(empty($photo_prop_in_row_val["VALUE_ENUM"]))$photo_prop_in_row_val["VALUE_ENUM"] = 3; 
			$photo_prop_distace = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "DISTACE"));
			$photo_prop_distace_val = $photo_prop_distace->GetNext();
			if(empty($photo_prop_distace_val["VALUE"]))$photo_prop_distace_val["VALUE"] = 15;  
			echo '<div class="photo-items-list photo-photo-list col-'.$photo_prop_in_row_val["VALUE_ENUM"].'">'; 
			while($PHOTOS = $photo_prop->GetNext()){  	
				$file = CFile::ResizeImageGet($PHOTOS["VALUE"], array('width'=>(894 - $photo_prop_distace_val["VALUE"]*$photo_prop_in_row_val["VALUE_ENUM"])/$photo_prop_in_row_val["VALUE_ENUM"], 'height'=>((894-$photo_prop_distace_val["VALUE"]*$photo_prop_in_row_val["VALUE_ENUM"])/$photo_prop_in_row_val["VALUE_ENUM"])/1.5), BX_RESIZE_IMAGE_EXACT, true);
				$orig_water = CFile::GetPath($PHOTOS["VALUE"]);		
				echo '<div  class="photo-item-cont  photo-item-cont-moder" style="width:calc((100% - '.($photo_prop_distace_val["VALUE"]*($photo_prop_in_row_val["VALUE_ENUM"]-1)).'px)/'.$photo_prop_in_row_val["VALUE_ENUM"].');margin-bottom: '.$photo_prop_distace_val["VALUE"].'px; margin-right: '.$photo_prop_distace_val["VALUE"].'px;">
						<a href="'.$orig_water.'" name="more_photo" class="fancybox-gal" rel="gal-news"> 
							<img border="0" src="'.$file["src"].'" alt="'.$arResult["NAME"].'" title="'.$arResult["NAME"].'" />
						</a>
					</div>';
				  

			}
			echo '</div>'; 
			
			$photo_prop_sliding = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "SLIDING_ANIMATION")); 
			$photo_prop_sliding_val = $photo_prop_sliding->GetNext();	
			if(empty($photo_prop_sliding_val["VALUE_ENUM"]))$photo_prop_sliding_val["VALUE_ENUM"] = "none";
			$photo_prop_open = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "OPEN_ANIMATION")); 
			$photo_prop_open_val = $photo_prop_open->GetNext();
			if(empty($photo_prop_open_val["VALUE_ENUM"]))$photo_prop_open_val["VALUE_ENUM"] = "none";
			$photo_prop_speed = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "SPEED_ANIMATION")); 
			$photo_prop_speed_val = $photo_prop_speed->GetNext();
			if(empty($photo_prop_speed_val["VALUE_ENUM"]))$photo_prop_speed_val["VALUE_ENUM"] = "normal";
			?>
			
			<script type="text/javascript"> 
				$(".fancybox-gal").fancybox({
					openEffect	: '<?=$photo_prop_open_val["VALUE_ENUM"];?>',
					closeEffect	: '<?=$photo_prop_open_val["VALUE_ENUM"];?>', 
					nextEffect	: '<?=$photo_prop_sliding_val["VALUE_ENUM"];?>',
					prevEffect	: '<?=$photo_prop_sliding_val["VALUE_ENUM"];?>',  
					openSpeed   : '<?=$photo_prop_speed_val["VALUE_ENUM"];?>',  
					closeSpeed  : '<?=$photo_prop_speed_val["VALUE_ENUM"];?>',  
					nextSpeed   : '<?=$photo_prop_speed_val["VALUE_ENUM"];?>',  
					prevSpeed	: '<?=$photo_prop_speed_val["VALUE_ENUM"];?>',   
					helpers : { 

					}, 
					beforeShow: function () {
						var imgAlt = $(this.element).find("img").attr("alt");
						var dataAlt = $(this.element).data("alt");
						if (imgAlt) {
							$(".fancybox-image").attr("alt", imgAlt);
						} else if (dataAlt) {
							$(".fancybox-image").attr("alt", dataAlt);
						}
						/**************************************/
						var imgTitle = $(this.element).find("img").attr("title");
						var dataTitle = $(this.element).data("title");
						if (imgTitle) {
							$(".fancybox-image").attr("title", imgTitle);
						} else if (dataTitle) {
							$(".fancybox-image").attr("title", dataTitle); 
						}
						<?	if($ar_res["LANG_DIR"]=="/") $of="из";
							if($ar_res["LANG_DIR"]=="/en/") $of="of";
							if($ar_res["LANG_DIR"]=="/by/") $of="з";?>
						this.title = (this.title ? "" + this.title + "<span class='fancybox-counter'>" : "") + (this.index + 1) + " <?=$of;?> " + this.group.length + "</span>";
						this.title += '<span class="fancybox-download"></span>';
					}
				}); 
			</script>
	<?	}
	echo '</div>';
	
	$audio_prop = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "AUDIO"));
	$audio_prop_copy = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"),array("CODE" => "AUDIO"));
	while($AUDIOS = $audio_prop_copy->GetNext()){
		if(empty($AUDIOS["VALUE"])) continue;
		if($ar_res["LANG_DIR"]=="/") echo "<h2>Аудио</h2>";
		if($ar_res["LANG_DIR"]=="/en/")  echo "<h2>Audio</h2>";
		if($ar_res["LANG_DIR"]=="/by/")  echo "<h2>Аудia</h2>";	
		break; 
	}
	if($audio_prop->result->num_rows>0){
		echo '<div class="audio-items-list">'; 
		while($AUDIOS = $audio_prop->GetNext()){  	
			if(empty($AUDIOS["VALUE"])) continue;   
			$orig_audio = CFile::GetPath($AUDIOS["VALUE"]);	?>	
			<audio controls>
					<source src="<?=$orig_audio;?>" type="audio/ogg; codecs=vorbis">
					<source src="<?=$orig_audio;?>" type="audio/mpeg">
					<?	if($ar_res["LANG_DIR"]=="/") echo "Audio не поддерживается вашим браузером";
						if($ar_res["LANG_DIR"]=="/en/") echo "Audio is not supported by your browser";
						if($ar_res["LANG_DIR"]=="/by/") echo "Audio не падтрымліваецца вашым браўзэрам";?>
					<a href="<?=$orig_audio;?>">
					<?	if($ar_res["LANG_DIR"]=="/") echo "Скачать";
						if($ar_res["LANG_DIR"]=="/en/") echo "Download";
						if($ar_res["LANG_DIR"]=="/by/") echo "Спампаваць";?>
					</a>
			</audio>
	<?	}
		echo '</div>';
	}	
} else if(!empty($_GET["PID"])) echo "<br/><br/>Элемент с ID  <b>".htmlspecialchars($_GET["PID"], ENT_QUOTES, 'UTF-8')."</b>  ненайден!"; 
?>			
					
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>