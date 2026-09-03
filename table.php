<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Адаптивная таблица");
?> <table id="card-table" class="table">
    <thead>
    <tr>
       <th >Имя</th>
       <th >Телефон</th>
       <th >Инфо</th>
    </tr>
   </thead> 
   <tbody>
    <tr>
      <td>
        Test
      </td>
      <td>
        555-555-5555
      </td>
      <td>
        I am a test
      </td>
      
    </tr>
    <tr>
      <td>
        Greg
      </td>
      <td>
        555-555-5555
      </td>
      <td>
        This is an example
      </td>
    
    </tr>
    <tr>
      <td>
        John
      </td>
      <td>
        444-444-4444
      </td>
      <td>
        Tables are cool
      </td>
     
    </tr>
   </tbody>

  </table> 

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

?>