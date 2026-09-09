<?php

namespace Sprint\Migration;


class iblok_services_sect20260907212423 extends Version
{
    protected $author = "New-admin";

    protected $description = "";

    protected $moduleVersion = "5.13.0";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'services',
            'services'
        );

        $helper->Iblock()->saveSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'ЕРИП',
    'CODE' => 'erip',
    'SORT' => '100',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127564',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="mynaui:lightning" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
  ),
  1 => 
  array (
    'NAME' => 'Образовательные и просветительские услуги',
    'CODE' => 'obrazovatelnye-i-prosvetitelskie-uslugi',
    'SORT' => '200',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127558',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="streamline-plump:graduation-cap" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Общее высшее образование (бакалавриат)',
        'CODE' => '',
        'SORT' => '100',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      1 => 
      array (
        'NAME' => 'Углубленное высшее образование (магистратура)',
        'CODE' => '',
        'SORT' => '200',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      2 => 
      array (
        'NAME' => 'Научно-ориентированное образование',
        'CODE' => '',
        'SORT' => '300',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      3 => 
      array (
        'NAME' => 'Дополнительное образование взрослых',
        'CODE' => '',
        'SORT' => '400',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
        'CHILDS' => 
        array (
          0 => 
          array (
            'NAME' => 'Переподготовка',
            'CODE' => '',
            'SORT' => '100',
            'ACTIVE' => 'Y',
            'XML_ID' => NULL,
            'PICTURE' => NULL,
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'DETAIL_PICTURE' => NULL,
            'UF_ICON' => NULL,
            'UF_ICON_MAIN_1' => NULL,
            'UF_ICON_MAIN_2' => NULL,
          ),
          1 => 
          array (
            'NAME' => 'Повышение квалификации',
            'CODE' => '',
            'SORT' => '200',
            'ACTIVE' => 'Y',
            'XML_ID' => NULL,
            'PICTURE' => NULL,
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'DETAIL_PICTURE' => NULL,
            'UF_ICON' => NULL,
            'UF_ICON_MAIN_1' => NULL,
            'UF_ICON_MAIN_2' => NULL,
          ),
          2 => 
          array (
            'NAME' => 'Обучающие курсы',
            'CODE' => '',
            'SORT' => '300',
            'ACTIVE' => 'Y',
            'XML_ID' => NULL,
            'PICTURE' => NULL,
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'DETAIL_PICTURE' => NULL,
            'UF_ICON' => NULL,
            'UF_ICON_MAIN_1' => NULL,
            'UF_ICON_MAIN_2' => NULL,
          ),
          3 => 
          array (
            'NAME' => 'Обучение по направлению «Защита от ЧС»',
            'CODE' => 'obuchenie-po-napravleniyu-zashchita-ot-chs',
            'SORT' => '400',
            'ACTIVE' => 'Y',
            'XML_ID' => NULL,
            'PICTURE' => NULL,
            'DESCRIPTION' => '',
            'DESCRIPTION_TYPE' => 'text',
            'DETAIL_PICTURE' => NULL,
            'UF_ICON' => NULL,
            'UF_ICON_MAIN_1' => NULL,
            'UF_ICON_MAIN_2' => NULL,
          ),
        ),
      ),
      4 => 
      array (
        'NAME' => 'Подготовка к проверке знаний',
        'CODE' => '',
        'SORT' => '500',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      5 => 
      array (
        'NAME' => 'Центр безопасности',
        'CODE' => '',
        'SORT' => '600',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      6 => 
      array (
        'NAME' => 'Музей МЧС',
        'CODE' => '',
        'SORT' => '700',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
    ),
  ),
  2 => 
  array (
    'NAME' => 'Наука и инновационная продукция',
    'CODE' => 'nauka-i-innovatsionnaya-produktsiya',
    'SORT' => '300',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127559',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="lucide:atom" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Молния',
        'CODE' => 'molniya',
        'SORT' => '100',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      1 => 
      array (
        'NAME' => 'НИР',
        'CODE' => 'nir',
        'SORT' => '200',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
    ),
  ),
  3 => 
  array (
    'NAME' => 'Испытательная деятельность',
    'CODE' => 'ispytatelnaya-deyatelnost',
    'SORT' => '400',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127560',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="famicons:flask-outline" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
  ),
  4 => 
  array (
    'NAME' => 'Экспертная деятельность',
    'CODE' => 'ekspertnaya-deyatelnost',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127561',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="solar:clipboard-check-linear" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
    'CHILDS' => 
    array (
      0 => 
      array (
        'NAME' => 'Экспертная деятельность в области ГЗ',
        'CODE' => 'ekspertnaya-deyatelnost-v-oblasti-gz',
        'SORT' => '100',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
      1 => 
      array (
        'NAME' => 'Деятельность в области Обеспечения пожарной безопасности',
        'CODE' => 'deyatelnost-v-oblasti-obespecheniya-pozharnoy-bezopasnosti',
        'SORT' => '200',
        'ACTIVE' => 'Y',
        'XML_ID' => NULL,
        'PICTURE' => NULL,
        'DESCRIPTION' => '',
        'DESCRIPTION_TYPE' => 'text',
        'DETAIL_PICTURE' => NULL,
        'UF_ICON' => NULL,
        'UF_ICON_MAIN_1' => NULL,
        'UF_ICON_MAIN_2' => NULL,
      ),
    ),
  ),
  5 => 
  array (
    'NAME' => 'Орган по сертификации продукции',
    'CODE' => 'organ-po-sertifikatsii-produktsii',
    'SORT' => '600',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127562',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="lucide:file-badge" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
  ),
  6 => 
  array (
    'NAME' => 'Полиграфические и сервисные услуги',
    'CODE' => 'poligraficheskie-i-servisnye-uslugi',
    'SORT' => '700',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'PICTURE' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
    'DETAIL_PICTURE' => NULL,
    'UF_ICON' => '127563',
    'UF_ICON_MAIN_1' => '<iconify-icon icon="lucide:briefcase-business" width="24" height="24" noobserver></iconify-icon>',
    'UF_ICON_MAIN_2' => NULL,
  ),
)        );
    }
}
