document.addEventListener('DOMContentLoaded', function () {

    const newsList = document.getElementById('news-list');

    if (!newsList) {
        return;
    }

    let selectedCategories = [];
    let selectedSections = [];
    let selectedTag = '';
    let selectedProject = '';


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
            '.news-filter-tag[data-tag="' + CSS.escape(tag) + '"]'
        );

        return element
            ? element.dataset.name
            : tag;
    }


    /**
     * Получение названия проекта
     */
    function getProjectName(project) {

        const element = document.querySelector(
            '.news-filter-project[data-project="' + CSS.escape(project) + '"]'
        );

        return element
            ? element.dataset.name
            : project;
    }


    /**
     * Инициализация фильтров из URL
     */
    function initFiltersFromUrl() {

        const params = new URLSearchParams(window.location.search);

        selectedCategories = params.getAll('category[]');
        selectedSections = params.getAll('section[]');

        selectedTag = params.get('tag') || '';
        selectedProject = params.get('project') || '';


        /**
         * Поиск
         */
        const searchInput = document.querySelector(
            'input[name="news_search"]'
        );

        if (searchInput) {
            searchInput.value = params.get('search') || '';
        }


        /**
         * Категории
         */
        document
            .querySelectorAll('.news-filter-category')
            .forEach(function (item) {

                item.classList.remove('checked');

                const category = item.dataset.category;

                if (
                    category &&
                    selectedCategories.includes(category)
                ) {
                    item.classList.add('checked');
                }
            });


        /**
         * Если категории не выбраны —
         * отмечаем "Все категории"
         */
        if (selectedCategories.length === 0) {

            document
                .querySelector('.news-filter-category[data-category=""]')
                ?.classList.add('checked');
        }


        /**
         * Институты / филиалы
         */
        document
            .querySelectorAll('.news-filter-section')
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


        /**
         * Если институты не выбраны —
         * отмечаем "Все институты"
         */
        if (selectedSections.length === 0) {

            document
                .querySelector('.news-filter-section[data-section=""]')
                ?.classList.add('checked');
        }
    }


    /**
     * Обновление URL
     */
    function updateUrl() {

        const params = new URLSearchParams();


        /**
         * Поиск
         */
        const searchInput = document.querySelector(
            'input[name="news_search"]'
        );

        const search = searchInput
            ? searchInput.value.trim()
            : '';


        if (search) {
            params.set('search', search);
        }


        /**
         * Категории
         */
        selectedCategories.forEach(function (category) {
            params.append('category[]', category);
        });


        /**
         * Институты
         */
        selectedSections.forEach(function (section) {
            params.append('section[]', section);
        });


        /**
         * Тег
         */
        if (selectedTag) {
            params.set('tag', selectedTag);
        }


        /**
         * Проект
         */
        if (selectedProject) {
            params.set('project', selectedProject);
        }


        const queryString = params.toString();

        const url = queryString
            ? window.location.pathname + '?' + queryString
            : window.location.pathname;


        window.history.pushState({}, '', url);
    }


    /**
     * Отображение выбранных TAG / PROJECT
     */
    function renderSelectedFilters() {

        const header = document.querySelector('.hashtags-header');

        if (!header) {
            return;
        }

        const list = header.querySelector('ul');

        if (!list) {
            return;
        }

        // Очищаем список
        list.innerHTML = '';

        /**
         * TAG
         */
        if (selectedTag) {

            const tagName = getTagName(selectedTag);

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
         * PROJECT
         */
        if (selectedProject) {

            const projectName = getProjectName(selectedProject);

            const li = document.createElement('li');

            li.innerHTML = `
            <a
                href="#"
                class="selected-filter"
                data-filter-type="project"
            >
                <span>#${escapeHtml(projectName)}</span>

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
        if (selectedTag || selectedProject) {
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
     * Применение всех фильтров
     */
    function applyFilters() {

        updateUrl();

        renderSelectedFilters();

        loadNews();
    }


    /**
     * AJAX-загрузка новостей
     */
    function loadNews() {

        const searchInput = document.querySelector(
            'input[name="news_search"]'
        );

        const search = searchInput
            ? searchInput.value.trim()
            : '';


        const formData = new FormData();

        formData.append('ajax_news', 'Y');

        formData.append('search', search);

        formData.append('tag', selectedTag);

        formData.append('project', selectedProject);


        /**
         * Категории
         */
        selectedCategories.forEach(function (category) {

            formData.append(
                'category[]',
                category
            );

        });


        /**
         * Институты / филиалы
         */
        selectedSections.forEach(function (section) {

            formData.append(
                'section[]',
                section
            );

        });


        newsList.classList.add('is-loading');


        fetch('/ajax/news.php', {

            method: 'POST',

            body: formData,

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }

        })

            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'Ошибка AJAX: ' + response.status
                    );

                }

                return response.text();

            })

            .then(function (html) {

                newsList.innerHTML = html;

            })

            .catch(function (error) {

                console.error(
                    'Ошибка загрузки новостей:',
                    error
                );

            })

            .finally(function () {

                newsList.classList.remove('is-loading');

            });
    }


    /**
     * TAG
     */
    document.addEventListener('click', function (event) {

        const tagLink = event.target.closest('.news-filter-tag');

        if (!tagLink) {
            return;
        }

        event.preventDefault();

        const tag = tagLink.dataset.tag;

        if (!tag) {
            return;
        }

        if (selectedTag === tag) {
            selectedTag = '';
        } else {
            selectedTag = tag;
        }

        applyFilters();
    });


    /**
     * PROJECT
     */
    document.addEventListener('click', function (event) {

        const projectLink = event.target.closest(
            '.news-filter-project'
        );

        if (!projectLink) {
            return;
        }


        event.preventDefault();


        const project = projectLink.dataset.project;


        if (!project) {
            return;
        }


        /**
         * Если уже выбран — снимаем
         * Если другой — заменяем
         */
        if (selectedProject === project) {
            selectedProject = '';
        } else {
            selectedProject = project;
        }


        applyFilters();

    });


    /**
     * Удаление выбранного TAG / PROJECT
     */
    document.addEventListener('click', function (event) {

        const selectedFilter = event.target.closest('.selected-filter');

        if (!selectedFilter) {
            return;
        }

        event.preventDefault();

        const type = selectedFilter.dataset.filterType;

        if (type === 'tag') {
            selectedTag = '';
        }

        if (type === 'project') {
            selectedProject = '';
        }

        applyFilters();
    });

    /**
     * КАТЕГОРИИ
     */
    document.addEventListener('click', function (event) {

        const categoryLink = event.target.closest(
            '.news-filter-category'
        );

        if (!categoryLink) {
            return;
        }


        event.preventDefault();


        const category = categoryLink.dataset.category;


        /**
         * "Все категории"
         */
        if (!category) {

            selectedCategories = [];


            document
                .querySelectorAll('.news-filter-category')
                .forEach(function (item) {

                    item.classList.remove('checked');

                });


            categoryLink.classList.add('checked');


            applyFilters();

            return;
        }


        /**
         * Добавляем / удаляем категорию
         */
        toggleValue(
            selectedCategories,
            category
        );


        /**
         * Визуальное состояние
         */
        categoryLink.classList.toggle(
            'checked'
        );


        /**
         * Убираем "Все категории"
         */
        document
            .querySelector(
                '.news-filter-category[data-category=""]'
            )
            ?.classList.remove('checked');


        /**
         * Если ничего не выбрано —
         * возвращаем "Все категории"
         */
        if (selectedCategories.length === 0) {

            document
                .querySelector(
                    '.news-filter-category[data-category=""]'
                )
                ?.classList.add('checked');

        }


        applyFilters();

    });


    /**
     * ИНСТИТУТЫ / ФИЛИАЛЫ
     */
    document.addEventListener('click', function (event) {

        const sectionLink = event.target.closest(
            '.news-filter-section'
        );

        if (!sectionLink) {
            return;
        }


        event.preventDefault();


        const section = sectionLink.dataset.section;


        /**
         * "Все институты"
         */
        if (!section) {

            selectedSections = [];


            document
                .querySelectorAll('.news-filter-section')
                .forEach(function (item) {

                    item.classList.remove('checked');

                });


            sectionLink.classList.add('checked');


            applyFilters();

            return;
        }


        /**
         * Добавляем / удаляем раздел
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


        /**
         * Убираем "Все институты"
         */
        document
            .querySelector(
                '.news-filter-section[data-section=""]'
            )
            ?.classList.remove('checked');


        /**
         * Если ничего не выбрано —
         * возвращаем "Все институты"
         */
        if (selectedSections.length === 0) {

            document
                .querySelector(
                    '.news-filter-section[data-section=""]'
                )
                ?.classList.add('checked');

        }


        applyFilters();

    });


    /**
     * ПОИСК
     */
    const searchInput = document.querySelector(
        'input[name="news_search"]'
    );


    if (searchInput) {

        /**
         * Кнопка поиска
         */
        const searchButton = document.querySelector(
            '.page__sidebar-search-btn--search'
        );


        /**
         * Кнопка очистки
         */
        const clearButton = document.querySelector(
            '.page__sidebar-search-btn--clear'
        );


        if (searchButton) {

            searchButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();

                    applyFilters();

                }
            );

        }


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
     * Работа браузерных Back / Forward
     */
    window.addEventListener(
        'popstate',
        function () {

            initFiltersFromUrl();

            renderSelectedFilters();

            loadNews();

        }
    );


    /**
     * Первоначальная инициализация
     */
    initFiltersFromUrl();

    renderSelectedFilters();

});