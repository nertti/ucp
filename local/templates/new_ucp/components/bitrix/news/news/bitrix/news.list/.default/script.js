document.addEventListener('DOMContentLoaded', function () {

    const newsList = document.getElementById('news-list');

    if (!newsList) {
        return;
    }

    let selectedCategories = [];
    let selectedSections = [];


    /**
     * Выполнение AJAX-фильтра
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

        // Категории
        selectedCategories.forEach(function (category) {
            formData.append('category[]', category);
        });

        // Разделы
        selectedSections.forEach(function (section) {
            formData.append('section[]', section);
        });

        newsList.classList.add('is-loading');

        fetch('/ajax/news.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка AJAX: ' + response.status);
                }

                return response.text();
            })
            .then(html => {
                newsList.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
            })
            .finally(() => {
                newsList.classList.remove('is-loading');
            });
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
     * Категории
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

        // "Все категории"
        if (!category) {

            selectedCategories = [];

            document
                .querySelectorAll('.news-filter-category')
                .forEach(function (item) {
                    item.classList.remove('checked');
                });

            categoryLink.classList.add('checked');

            loadNews();

            return;
        }

        // Добавляем / удаляем категорию
        toggleValue(selectedCategories, category);

        // Обновляем визуальное состояние
        categoryLink.classList.toggle('checked');

        // Убираем "Все категории"
        document
            .querySelector('.news-filter-category[data-category=""]')
            ?.classList.remove('checked');

        // Если ничего не выбрано — возвращаем "Все категории"
        if (selectedCategories.length === 0) {

            document
                .querySelector('.news-filter-category[data-category=""]')
                ?.classList.add('checked');
        }

        loadNews();
    });


    /**
     * Институты / филиалы
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

        // "Все институты"
        if (!section) {

            selectedSections = [];

            document
                .querySelectorAll('.news-filter-section')
                .forEach(function (item) {
                    item.classList.remove('checked');
                });

            sectionLink.classList.add('checked');

            loadNews();

            return;
        }

        // Добавляем / удаляем раздел
        toggleValue(selectedSections, section);

        // Обновляем визуальное состояние
        sectionLink.classList.toggle('checked');

        // Убираем "Все институты"
        document
            .querySelector('.news-filter-section[data-section=""]')
            ?.classList.remove('checked');

        // Если ничего не выбрано — возвращаем "Все институты"
        if (selectedSections.length === 0) {

            document
                .querySelector('.news-filter-section[data-section=""]')
                ?.classList.add('checked');
        }

        loadNews();
    });


    /**
     * Поиск
     */
    const searchInput = document.querySelector(
        'input[name="news_search"]'
    );

    if (searchInput) {

        const searchButton = document.querySelector(
            '.page__sidebar-search-btn--search'
        );

        const clearButton = document.querySelector(
            '.page__sidebar-search-btn--clear'
        );


        if (searchButton) {
            searchButton.addEventListener('click', function () {
                loadNews();
            });
        }


        if (clearButton) {
            clearButton.addEventListener('click', function () {

                searchInput.value = '';

                loadNews();
            });
        }


        searchInput.addEventListener('keydown', function (event) {

            if (event.key === 'Enter') {
                event.preventDefault();

                loadNews();
            }

        });

    }

});