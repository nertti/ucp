
<script src="spin.js"></script>

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
	font-size: 16px;
	font-weight: bold;
	color: #0000FF;
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



<SCRIPT type="text/javascript" id="script">

function validate_form ( )
{
	
	
	valid = true;
	if ( document.contact_form.name.value == "" )
        {
                alert ( "Пожалуйста заполните поле 'Фамилия Имя Отчество'." );
                valid = false;
        }
else
        { 


        }

		return valid;                    
       

        
}

//-->

</SCRIPT>



<p align="center" class="стиль1">Информация по успеваемости</p>
<p>
 <form name="contact_form" action="uspev2.php" method="post" enctype="multipart/form-data" onsubmit="return validate_form ( );">
	Фамилия Имя Отчество: <input type="text" name="name" />
	<input type="submit" value="Получить данные" /> 
</form>
