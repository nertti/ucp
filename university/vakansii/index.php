<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?><style>
    /* body { font-family: sans-serif; background-color: #f8f9fa; padding: 20px; color: #212529; }
    h1 { text-align: center; } */

    /* Стили таблицы и границ */
    table {
        max-width: 100% !important;
        border-collapse: collapse !important;
        /*background: white; */
        /* margin-top: 10px !important; */
        border: 2px solid #dee2e6 !important;
        line-height: 0.9em !important;
        font-size: 13px !important;
    }

    th,
    td {
        padding: 2px !important;
        text-align: left;
        /* border: 1px solid #dee2e6;  */
        /* Полные границы */
    }

    th {
        /* background-color: #007bff; */
        /* color: white; */
        text-transform: uppercase;
        /* font-size: 0.85rem; */
    }

    .gsz-link {
        font-size: 0.8rem;
        color: #0056b3;
        font-weight: bold;
    }

    /* Адаптивность: превращаем в блоки */
    @media screen and (max-width: 1280px) {

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block !important;
            border: none !important;
        }

        thead tr {
            position: absolute !important;
            top: -9999px !important;
            left: -9999px !important;
        }

        /* Скрываем заголовки */

        tr {
            border: 1px solid #9c9c9c !important;
            margin-bottom: 5px !important;
            padding-bottom: 15px !important;
            border-radius: 8px !important;
            overflow: hidden !important;
            
        }

        td {
            border: none !important;
            border-bottom: 1px solid #eee !important;
            position: relative !important;
            padding-left: 50% !important;
            /* Место под название колонки */
            white-space: normal !important;
        }

        td:before {
            position: absolute !important;
            top: 12px !important;
            left: 12px !important;
            width: 45% !important;
            padding-right: 10px !important;
            white-space: nowrap !important;
            content: attr(data-label) !important;
            /* Берем имя из атрибута */
            font-weight: bold !important;
            color: #495057 !important;
        }

        td:last-child {
            border-bottom: none !important;
        }
    }
</style>

<table>
    <thead>
        <tr>
            <th>Профессия</th>
            <th>Зарплата</th>
            <th>Образование</th>
            <th>Характер работы</th>
            <th>Ставка</th>
            <th>Режим времени</th>
            <th>Официальная ссылка</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td data-label="Профессия"><strong>Уборщик помещений</strong></td>
            <td data-label="Зарплата">590 – 620 руб.</td>
            <td data-label="Образование">Общее среднее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">0.5</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1783849/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Делопроизводитель</strong></td>
            <td data-label="Зарплата">1400 – 1450 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1783699/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инженер</strong></td>
            <td data-label="Зарплата">1050 – 1150 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">0.75</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1783603/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инженер</strong></td>
            <td data-label="Зарплата">735 – 750 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">0.5</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1783598/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инженер (ведущий)</strong></td>
            <td data-label="Зарплата">1800 – 1900 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1783586/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инспектор по кадрам</strong></td>
            <td data-label="Зарплата">2100 – 2200 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1772783/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инженер-энергетик</strong></td>
            <td data-label="Зарплата">1400 – 1500 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">0.75</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1772757/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Маркетолог</strong></td>
            <td data-label="Зарплата">1200 – 1300 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Временная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1769804/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инспектор</strong></td>
            <td data-label="Зарплата">2100 – 2200 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1769742/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инженер-администратор телекоммуникационных систем</strong></td>
            <td data-label="Зарплата">2100 – 2200 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1769294/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Рабочий по комплексному обслуживанию и ремонту зданий и
                    сооружений</strong></td>
            <td data-label="Зарплата">1200 – 1350 руб.</td>
            <td data-label="Образование">Профессионально-техническое</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740751/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Машинист крана автомобильного</strong></td>
            <td data-label="Зарплата">1100 – 1200 руб.</td>
            <td data-label="Образование">Профессионально-техническое</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">0.75</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740719/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Водитель автомобиля</strong></td>
            <td data-label="Зарплата">1120 – 1200 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Разъездная</td>
            <td data-label="Ставка">0.75</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740703/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Экономист</strong></td>
            <td data-label="Зарплата">1250 – 1670 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740649/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Фельдшер</strong></td>
            <td data-label="Зарплата">1600 – 1800 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740641/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Водитель автомобиля</strong></td>
            <td data-label="Зарплата">1460 – 1500 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Разъездная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740638/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Рабочий по комплексному обслуживанию и ремонту зданий и
                    сооружений</strong></td>
            <td data-label="Зарплата">1200 – 1380 руб.</td>
            <td data-label="Образование">Профессионально-техническое</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740633/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Инспектор</strong></td>
            <td data-label="Зарплата">1250 – 1600 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740623/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Техник</strong></td>
            <td data-label="Зарплата">1200 – 1400 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740615/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

       

        <tr>
            <td data-label="Профессия"><strong>Архивариус</strong></td>
            <td data-label="Зарплата">1200 – 1400 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1740599/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Техник по связи (старший)</strong></td>
            <td data-label="Зарплата">1600 – 1800 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1504172/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Библиотекарь</strong></td>
            <td data-label="Зарплата">1250 – 1300 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1279916/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Электромонтер по ремонту и обслуживанию электрооборудования</strong></td>
            <td data-label="Зарплата">1200 – 1350 руб.</td>
            <td data-label="Образование">Общее среднее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1279874/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Водитель боевых и специальных машин</strong></td>
            <td data-label="Зарплата">1200 – 1300 руб.</td>
            <td data-label="Образование">Общее среднее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1279866/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Мастер производственного обучения управлению механическим транспортным
                    средством</strong></td>
            <td data-label="Зарплата">1800 – 1900 руб.</td>
            <td data-label="Образование">Среднее специальное</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1279865/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Врач-специалист</strong></td>
            <td data-label="Зарплата">1300 – 1400 руб.</td>
            <td data-label="Образование">Высшее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">0.5</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1279632/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

        <tr>
            <td data-label="Профессия"><strong>Слесарь-сантехник</strong></td>
            <td data-label="Зарплата">1200 – 1350 руб.</td>
            <td data-label="Образование">Общее среднее</td>
            <td data-label="Характер работы">Постоянная</td>
            <td data-label="Ставка">1</td>
            <td data-label="Режим времени">Одна смена</td>
            <td data-label="Официальная ссылка">
                <a class="gsz-link" href="https://gsz.gov.by/registration/employer/vacancy/1279631/detail-public/" target="_blank">
                    Вакансия в Общереспубликанском банке вакансий
                </a>
            </td>
        </tr>

    </tbody>
</table><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>