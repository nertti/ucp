document.addEventListener('DOMContentLoaded', function () {

    const servicesList = document.getElementById('services-list');

    if (!servicesList) {
        return;
    }


    let selectedSections = [];
    let selectedTag = '';
    let selectedSort = 'random';


    /**
     * Экранирование HTML
     */
    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value || '';

        return div.innerHTML;
    }


    /**
     * Получение названия тега
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
     * Получение ВСЕХ дочерних разделов
     */
    function getSectionGroup(sectionLink) {

        const group = [sectionLink];

        const currentLi = sectionLink.closest('li');

        if (!currentLi) {
            return group;
        }


        /**
         * Ищем контейнер spollers
         */
        const spollers = Array.from(
            currentLi.children
        ).find(function (child) {

            return child.hasAttribute('data-fls-spollers');

        });


        if (!spollers) {
            return group;
        }


        /**
         * Ищем details
         */
        const details = Array.from(
            spollers.children
        ).find(function (child) {

            return child.tagName.toLowerCase() === 'details';

        });


        if (!details) {
            return group;
        }


        /**
         * Ищем тело spoller
         */
        const body = Array.from(
            details.children
        ).find(function (child) {

            return child.classList.contains(
                'spollers__body'
            );

        });


        if (!body) {
            return group;
        }


        /**
         * Ищем список непосредственных детей
         */
        const childUl = Array.from(
            body.children
        ).find(function (child) {

            return child.tagName.toLowerCase() === 'ul';

        });


        if (!childUl) {
            return group;
        }


        /**
         * Рекурсивно собираем дочерние разделы
         */
        function collectFromList(ul) {

            Array.from(
                ul.children
            ).forEach(function (childLi) {

                if (
                    childLi.tagName.toLowerCase() !== 'li'
                ) {
                    return;
                }


                /**
                 * Обычный дочерний раздел
                 */
                const directLink =
                    Array.from(
                        childLi.children
                    ).find(function (child) {

                        return child.classList &&
                            child.classList.contains(
                                'services-filter-section'
                            );

                    });


                if (directLink) {

                    group.push(
                        directLink
                    );

                }


                /**
                 * Вложенный spoller
                 */
                const nestedSpollers =
                    Array.from(
                        childLi.children
                    ).find(function (child) {

                        return child.hasAttribute(
                            'data-fls-spollers'
                        );

                    });


                if (!nestedSpollers) {
                    return;
                }


                /**
                 * Получаем details
                 */
                const nestedDetails =
                    Array.from(
                        nestedSpollers.children
                    ).find(function (child) {

                        return child.tagName.toLowerCase() ===
                            'details';

                    });


                if (!nestedDetails) {
                    return;
                }


                /**
                 * Получаем summary
                 */
                const nestedSummary =
                    Array.from(
                        nestedDetails.children
                    ).find(function (child) {

                        return child.tagName.toLowerCase() ===
                            'summary';

                    });


                if (nestedSummary) {

                    const nestedLink =
                        Array.from(
                            nestedSummary.children
                        ).find(function (child) {

                            return child.classList &&
                                child.classList.contains(
                                    'services-filter-section'
                                );

                        });


                    if (
                        nestedLink &&
                        !group.includes(nestedLink)
                    ) {

                        group.push(
                            nestedLink
                        );

                    }

                }


                /**
                 * Получаем body
                 */
                const nestedBody =
                    Array.from(
                        nestedDetails.children
                    ).find(function (child) {

                        return child.classList.contains(
                            'spollers__body'
                        );

                    });


                if (!nestedBody) {
                    return;
                }


                /**
                 * Получаем UL
                 */
                const nestedUl =
                    Array.from(
                        nestedBody.children
                    ).find(function (child) {

                        return child.tagName.toLowerCase() ===
                            'ul';

                    });


                if (nestedUl) {

                    collectFromList(
                        nestedUl
                    );

                }

            });

        }


        collectFromList(
            childUl
        );


        return group;
    }


    /**
     * Получение названия текущей сортировки
     */
    function getSortName(sort) {

        const sortInput = document.querySelector(
            '.sort__block input[type="radio"][value="' +
            CSS.escape(sort) +
            '"]'
        );

        if (sortInput) {

            const label = sortInput.closest('label');

            if (label) {

                const span = label.querySelector('span');

                if (span) {
                    return span.textContent.trim();
                }

            }

        }

        const names = {
            random: 'В случайном порядке',
            popular: 'По популярности',
            name_asc: 'По названию (А-Я)',
            name_desc: 'По названию (Я-А)',
            new: 'Сначала новые'
        };

        return names[sort] || names.random;
    }


    /**
     * Обновление визуального состояния сортировки
     */
    function renderSort() {

        const sortBlock =
            document.querySelector('.sort__block');


        if (!sortBlock) {
            return;
        }


        /**
         * ВАЖНО:
         *
         * У всех radio должен быть один name.
         *
         * На случай старой HTML-разметки
         * исправляем name через JS.
         */
        const inputs =
            sortBlock.querySelectorAll(
                'input[type="radio"]'
            );


        inputs.forEach(function (input) {

            input.name = 'services_sort';

        });


        /**
         * Снимаем active
         */
        sortBlock
            .querySelectorAll('label')
            .forEach(function (label) {

                label.classList.remove(
                    'active'
                );

            });


        /**
         * Снимаем checked
         */
        inputs.forEach(function (input) {

            input.checked =
                input.value === selectedSort;

        });


        /**
         * Добавляем active выбранному
         */
        const selectedInput =
            sortBlock.querySelector(
                'input[type="radio"][value="' +
                CSS.escape(selectedSort) +
                '"]'
            );


        if (selectedInput) {

            const label =
                selectedInput.closest('label');


            if (label) {

                label.classList.add(
                    'active'
                );

            }

        }


        /**
         * Меняем текст кнопки
         */
        const button =
            sortBlock.querySelector(
                '.button-sort'
            );


        if (button) {

            const text =
                button.querySelector('span');


            if (text) {

                text.textContent =
                    getSortName(
                        selectedSort
                    );

            }

        }

    }


    /**
     * Инициализация фильтров из URL
     */
    function initFiltersFromUrl() {

        const params =
            new URLSearchParams(
                window.location.search
            );


        /**
         * Категории
         */
        selectedSections =
            params.getAll(
                'section[]'
            );


        /**
         * Тег
         */
        selectedTag =
            params.get(
                'tag'
            ) || '';


        /**
         * Сортировка
         */
        selectedSort =
            params.get(
                'sort'
            ) || 'random';


        /**
         * Разрешённые значения сортировки
         */
        const allowedSorts = [
            'random',
            'popular',
            'name_asc',
            'name_desc',
            'new'
        ];


        if (!allowedSorts.includes(selectedSort)) {

            selectedSort =
                'random';

        }


        /**
         * Поиск
         */
        const searchInput =
            document.querySelector(
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
            .querySelectorAll(
                '.services-filter-section'
            )
            .forEach(function (item) {

                item.classList.remove(
                    'checked'
                );

            });


        /**
         * Восстанавливаем выбранные категории
         */
        document
            .querySelectorAll(
                '.services-filter-section'
            )
            .forEach(function (item) {

                const section =
                    item.dataset.section;


                if (
                    section &&
                    selectedSections.includes(section)
                ) {

                    item.classList.add(
                        'checked'
                    );

                }

            });


        /**
         * Восстанавливаем сортировку
         */
        renderSort();

    }


    /**
     * Обновление URL
     */
    function updateUrl(page = 1) {

        const params =
            new URLSearchParams();


        /**
         * Поиск
         */
        const searchInput =
            document.querySelector(
                'input[name="service_search"]'
            );


        const search =
            searchInput
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
        selectedSections.forEach(
            function (section) {

                params.append(
                    'section[]',
                    section
                );

            }
        );


        /**
         * TAG
         */
        if (selectedTag) {

            params.set(
                'tag',
                selectedTag
            );

        }


        /**
         * Сортировка
         *
         * random считаем значением
         * по умолчанию и не обязательно
         * писать его в URL.
         */
        if (
            selectedSort &&
            selectedSort !== 'random'
        ) {

            params.set(
                'sort',
                selectedSort
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


        const queryString =
            params.toString();


        const url =
            queryString
                ? window.location.pathname +
                '?' +
                queryString
                : window.location.pathname;


        window.history.pushState(
            {},
            '',
            url
        );

    }


    /**
     * Отображение выбранных фильтров
     */
    function renderSelectedFilters() {

        const header =
            document.querySelector(
                '.hashtags-header'
            );


        if (!header) {
            return;
        }


        const list =
            header.querySelector('ul');


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

            const tagName =
                getTagName(
                    selectedTag
                );


            const li =
                document.createElement('li');


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


            list.appendChild(
                li
            );

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
     * Применение фильтров
     */
    function applyFilters(page = 1) {

        updateUrl(
            page
        );


        renderSelectedFilters();


        renderSort();


        loadServices(
            page
        );

    }


    /**
     * AJAX-загрузка услуг
     */
    function loadServices(page = 1) {

        const searchInput =
            document.querySelector(
                'input[name="service_search"]'
            );


        const search =
            searchInput
                ? searchInput.value.trim()
                : '';


        const formData =
            new FormData();


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
         * Сортировка
         */
        formData.append(
            'sort',
            selectedSort
        );


        /**
         * Категории
         */
        selectedSections.forEach(
            function (section) {

                formData.append(
                    'section[]',
                    section
                );

            }
        );


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
                    'X-Requested-With':
                        'XMLHttpRequest'
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

                servicesList.innerHTML =
                    html;

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

            const tagLink =
                event.target.closest(
                    '.services-filter-tag'
                );


            if (!tagLink) {
                return;
            }


            event.preventDefault();


            const tag =
                tagLink.dataset.tag;


            if (!tag) {
                return;
            }


            /**
             * Переключение тега
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
     * Удаление выбранного фильтра
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
     * КАТЕГОРИИ
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
             * Получаем текущий раздел
             * и только его поддерево
             */
            const group =
                getSectionGroup(
                    sectionLink
                );


            /**
             * Получаем ID группы
             */
            const sectionIds =
                group
                    .map(function (item) {

                        return item.dataset.section;

                    })
                    .filter(Boolean);


            /**
             * Проверяем,
             * выбрана ли уже вся группа
             */
            const allSelected =
                sectionIds.every(
                    function (id) {

                        return selectedSections.includes(
                            id
                        );

                    }
                );


            if (allSelected) {

                /**
                 * Убираем группу
                 */
                selectedSections =
                    selectedSections.filter(
                        function (id) {

                            return !sectionIds.includes(
                                id
                            );

                        }
                    );


                /**
                 * Убираем checked
                 */
                group.forEach(
                    function (item) {

                        item.classList.remove(
                            'checked'
                        );

                    }
                );

            } else {

                /**
                 * Добавляем группу
                 */
                sectionIds.forEach(
                    function (id) {

                        if (
                            !selectedSections.includes(
                                id
                            )
                        ) {

                            selectedSections.push(
                                id
                            );

                        }

                    }
                );


                /**
                 * Добавляем checked
                 */
                group.forEach(
                    function (item) {

                        item.classList.add(
                            'checked'
                        );

                    }
                );

            }


            applyFilters();

        }
    );


    /**
     * СОРТИРОВКА
     */
    document.addEventListener(
        'change',
        function (event) {

            const sortInput =
                event.target.closest(
                    '.sort__block input[type="radio"]'
                );


            if (!sortInput) {
                return;
            }


            const sort =
                sortInput.value;


            const allowedSorts = [
                'random',
                'popular',
                'name_asc',
                'name_desc',
                'new'
            ];


            if (!allowedSorts.includes(sort)) {
                return;
            }


            /**
             * Запоминаем сортировку
             */
            selectedSort =
                sort;


            /**
             * Сбрасываем на первую страницу
             */
            applyFilters(
                1
            );

        }
    );


    /**
     * ПОИСК
     */
    const searchInput =
        document.querySelector(
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

                if (
                    event.key !== 'Enter'
                ) {
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
             * URL ссылки пагинации
             */
            const url =
                new URL(
                    paginationLink.href,
                    window.location.origin
                );


            /**
             * Номер страницы
             */
            const page =
                parseInt(
                    url.searchParams.get(
                        'PAGEN_1'
                    ) || '1',
                    10
                );


            /**
             * Загружаем страницу
             */
            loadServices(
                page
            );


            /**
             * Обновляем URL
             *
             * Здесь сохраняются:
             * - search
             * - section[]
             * - tag
             * - sort
             */
            updateUrl(
                page
            );


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
     * BACK / FORWARD
     */
    window.addEventListener(
        'popstate',
        function () {

            /**
             * Восстанавливаем фильтры
             */
            initFiltersFromUrl();


            /**
             * Обновляем отображение
             */
            renderSelectedFilters();


            renderSort();


            /**
             * Получаем страницу
             */
            const params =
                new URLSearchParams(
                    window.location.search
                );


            const page =
                parseInt(
                    params.get(
                        'PAGEN_1'
                    ) || '1',
                    10
                );


            /**
             * Загружаем услуги
             */
            loadServices(
                page
            );

        }
    );


    /**
     * ПЕРВОНАЧАЛЬНАЯ ИНИЦИАЛИЗАЦИЯ
     */
    initFiltersFromUrl();

    renderSelectedFilters();

    renderSort();

});