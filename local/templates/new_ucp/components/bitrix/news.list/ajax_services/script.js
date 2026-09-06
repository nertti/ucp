document.addEventListener('DOMContentLoaded', function () {

    const servicesList = document.getElementById('services-list');

    if (!servicesList) {
        return;
    }

    let selectedSections = [];
    let selectedTag = '';


    /**
     * Экранирование HTML
     */
    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value || '';

        return div.innerHTML;
    }


    /**
     * Получение названия выбранного тега
     */
    function getTagName(tag) {

        const element = document.querySelector(
            '.services-filter-tag[data-tag="' + CSS.escape(tag) + '"]'
        );

        return element
            ? element.dataset.name
            : tag;
    }


    /**
     * Инициализация фильтров из URL
     */
    function initFiltersFromUrl() {

        const params = new URLSearchParams(
            window.location.search
        );


        /**
         * Категории / разделы
         */
        selectedSections = params.getAll('section[]');


        /**
         * Тег
         */
        selectedTag = params.get('tag') || '';


        /**
         * Поиск
         */
        const searchInput = document.querySelector(
            'input[name="service_search"]'
        );

        if (searchInput) {

            searchInput.value =
                params.get('search') || '';

        }


        /**
         * Сбрасываем визуальное состояние категорий
         */
        document
            .querySelectorAll('.services-filter-section')
            .forEach(function (item) {

                item.classList.remove('checked');

                const section = item.dataset.section;

                if (
                    section &&
                    selectedSections.includes(section)
                ) {
                    item.classList.add('checked');
                }

            });

    }


    /**
     * Обновление URL
     */
    function updateUrl(page = 1) {

        const params = new URLSearchParams();


        /**
         * Поиск
         */
        const searchInput = document.querySelector(
            'input[name="service_search"]'
        );

        const search = searchInput
            ? searchInput.value.trim()
            : '';


        if (search) {

            params.set(
                'search',
                search
            );

        }


        /**
         * Категории
         */
        selectedSections.forEach(function (section) {

            params.append(
                'section[]',
                section
            );

        });


        /**
         * Тег
         */
        if (selectedTag) {

            params.set(
                'tag',
                selectedTag
            );

        }


        /**
         * Пагинация
         */
        if (page > 1) {

            params.set(
                'PAGEN_1',
                page
            );

        }


        const queryString = params.toString();

        const url = queryString
            ? window.location.pathname + '?' + queryString
            : window.location.pathname;


        window.history.pushState(
            {},
            '',
            url
        );

    }


    /**
     * Отображение выбранного TAG
     */
    function renderSelectedFilters() {

        const header = document.querySelector(
            '.hashtags-header'
        );

        if (!header) {
            return;
        }


        const list = header.querySelector('ul');

        if (!list) {
            return;
        }


        /**
         * Очищаем список
         */
        list.innerHTML = '';


        /**
         * TAG
         */
        if (selectedTag) {

            const tagName = getTagName(
                selectedTag
            );

            const li = document.createElement('li');

            li.innerHTML = `
                <a
                    href="#"
                    class="selected-filter"
                    data-filter-type="tag"
                >
                    <span>#${escapeHtml(tagName)}</span>

                    <button type="button">
                        <iconify-icon
                            icon="lucide:x"
                            width="16"
                            height="16"
                            noobserver=""
                        ></iconify-icon>
                    </button>
                </a>
            `;

            list.appendChild(li);

        }


        /**
         * Показываем / скрываем блок
         */
        if (selectedTag) {

            header.style.display = '';

        } else {

            header.style.display = 'none';

        }

    }


    /**
     * Переключение значения в массиве
     */
    function toggleValue(array, value) {

        const index = array.indexOf(value);

        if (index === -1) {

            array.push(value);

        } else {

            array.splice(index, 1);

        }

        return array;

    }


    /**
     * Применение фильтров
     */
    function applyFilters(page = 1) {

        updateUrl(page);

        renderSelectedFilters();

        loadServices(page);

    }


    /**
     * AJAX-загрузка услуг
     */
    function loadServices(page = 1) {

        const searchInput = document.querySelector(
            'input[name="service_search"]'
        );

        const search = searchInput
            ? searchInput.value.trim()
            : '';


        const formData = new FormData();


        /**
         * AJAX
         */
        formData.append(
            'ajax_services',
            'Y'
        );


        /**
         * Номер страницы
         */
        formData.append(
            'PAGEN_1',
            page
        );


        /**
         * Поиск
         */
        formData.append(
            'search',
            search
        );


        /**
         * TAG
         */
        formData.append(
            'tag',
            selectedTag
        );


        /**
         * Категории
         */
        selectedSections.forEach(function (section) {

            formData.append(
                'section[]',
                section
            );

        });


        /**
         * Состояние загрузки
         */
        servicesList.classList.add(
            'is-loading'
        );


        fetch(
            '/ajax/services.php',
            {
                method: 'POST',

                body: formData,

                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }
        )

            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'Ошибка AJAX: ' +
                        response.status
                    );

                }

                return response.text();

            })

            .then(function (html) {

                servicesList.innerHTML = html;

            })

            .catch(function (error) {

                console.error(
                    'Ошибка загрузки услуг:',
                    error
                );

            })

            .finally(function () {

                servicesList.classList.remove(
                    'is-loading'
                );

            });

    }


    /**
     * TAG
     */
    document.addEventListener(
        'click',
        function (event) {

            const tagLink = event.target.closest(
                '.services-filter-tag'
            );

            if (!tagLink) {
                return;
            }


            event.preventDefault();


            const tag = tagLink.dataset.tag;

            if (!tag) {
                return;
            }


            /**
             * Если тег уже выбран —
             * снимаем его
             */
            if (selectedTag === tag) {

                selectedTag = '';

            } else {

                selectedTag = tag;

            }


            applyFilters();

        }
    );


    /**
     * Удаление выбранного TAG
     */
    document.addEventListener(
        'click',
        function (event) {

            const selectedFilter =
                event.target.closest(
                    '.selected-filter'
                );

            if (!selectedFilter) {
                return;
            }


            event.preventDefault();


            const type =
                selectedFilter.dataset.filterType;


            if (type === 'tag') {

                selectedTag = '';

            }


            applyFilters();

        }
    );


    /**
     * КАТЕГОРИИ / РАЗДЕЛЫ
     */
    document.addEventListener(
        'click',
        function (event) {

            const sectionLink =
                event.target.closest(
                    '.services-filter-section'
                );

            if (!sectionLink) {
                return;
            }


            event.preventDefault();


            const section =
                sectionLink.dataset.section;


            if (!section) {
                return;
            }


            /**
             * Добавляем / удаляем категорию
             */
            toggleValue(
                selectedSections,
                section
            );


            /**
             * Визуальное состояние
             */
            sectionLink.classList.toggle(
                'checked'
            );


            applyFilters();

        }
    );


    /**
     * ПОИСК
     */
    const searchInput = document.querySelector(
        'input[name="service_search"]'
    );


    if (searchInput) {

        /**
         * Кнопка поиска
         */
        const searchButton =
            document.querySelector(
                '.page__sidebar-search-btn--search'
            );


        /**
         * Кнопка очистки
         */
        const clearButton =
            document.querySelector(
                '.page__sidebar-search-btn--clear'
            );


        /**
         * Поиск
         */
        if (searchButton) {

            searchButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    applyFilters();

                }
            );

        }


        /**
         * Очистка поиска
         */
        if (clearButton) {

            clearButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    searchInput.value = '';

                    applyFilters();

                }
            );

        }


        /**
         * Enter
         */
        searchInput.addEventListener(
            'keydown',
            function (event) {

                if (event.key !== 'Enter') {
                    return;
                }


                event.preventDefault();

                applyFilters();

            }
        );

    }


    /**
     * ПАГИНАЦИЯ
     */
    document.addEventListener(
        'click',
        function (event) {

            const paginationLink =
                event.target.closest(
                    '.pagination a'
                );

            if (!paginationLink) {
                return;
            }


            event.preventDefault();


            /**
             * Получаем URL ссылки
             */
            const url = new URL(
                paginationLink.href,
                window.location.origin
            );


            /**
             * Получаем номер страницы
             */
            const page =
                parseInt(
                    url.searchParams.get(
                        'PAGEN_1'
                    ) || '1',
                    10
                );


            /**
             * Загружаем услуги
             */
            loadServices(page);


            /**
             * Обновляем URL
             */
            updateUrl(page);


            /**
             * Прокрутка к списку
             */
            servicesList.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        }
    );


    /**
     * Back / Forward
     */
    window.addEventListener(
        'popstate',
        function () {

            initFiltersFromUrl();

            renderSelectedFilters();

            const params = new URLSearchParams(
                window.location.search
            );

            const page =
                parseInt(
                    params.get('PAGEN_1') || '1',
                    10
                );


            loadServices(page);

        }
    );


    /**
     * Первоначальная инициализация
     */
    initFiltersFromUrl();

    renderSelectedFilters();

});