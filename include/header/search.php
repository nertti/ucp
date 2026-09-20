<div class="header__search" data-fls-dynamic=".header__search-mobile,1200, 1">
    <div class="header__search-input">
        <button
            type="button"
            class="header__search-btn header__search-btn--search"
        >
            <div class="header__search-btn-icon">
                <iconify-icon
                    icon="lucide:search"
                    width="100%"
                    height="100%"
                    noobserver
                ></iconify-icon>
            </div>
        </button>

        <input
            type="text"
            name="search"
            placeholder="Поиск"
            autocomplete="off"
        />

        <button
            type="button"
            class="header__search-btn header__search-btn--clear"
        >
            <div class="header__search-btn-icon">
                <iconify-icon
                    icon="lucide:x"
                    width="100%"
                    height="100%"
                    noobserver
                ></iconify-icon>
            </div>
        </button>
    </div>

    <div class="header__search-content">
        <ul class="header__search-list"></ul>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchBlocks = [
            {
                selector: '.header__search',
                input: 'input[name="search"]',
                list: '.header__search-list',
                content: '.header__search-content',
                clearButton: '.header__search-btn--clear',
                itemClass: 'header__search-item'
            },
            {
                selector: '.mobile-search',
                input: '.mobile-search__input',
                list: '.mobile-search__list',
                content: '.mobile-search__content',
                clearButton: '.mobile-search__btn--clear',
                itemClass: 'mobile-search__item'
            }
        ];

        let searchTimeout = null;
        let controller = null;

        /**
         * Найти элементы поиска
         */
        function getSearchElements(config) {
            const search = document.querySelector(config.selector);

            if (!search) {
                return null;
            }

            const input = search.querySelector(config.input);
            const list = search.querySelector(config.list);
            const content = search.querySelector(config.content);
            const clearButton = search.querySelector(config.clearButton);

            if (!input || !list || !content || !clearButton) {
                return null;
            }

            return {
                search,
                input,
                list,
                content,
                clearButton
            };
        }

        /**
         * Открыть блок результатов
         */
        function showContent(elements) {
            elements.content.classList.add('active');
        }

        /**
         * Скрыть блок результатов
         */
        function hideContent(elements) {
            elements.content.classList.remove('active');
            elements.list.innerHTML = '';
        }

        /**
         * Показать сообщение
         */
        function showMessage(elements, message, itemClass) {
            elements.list.innerHTML = '';

            const li = document.createElement('li');
            li.className = itemClass;

            const p = document.createElement('p');
            p.className = 'text-caption';
            p.textContent = message;

            li.appendChild(p);
            elements.list.appendChild(li);

            showContent(elements);
        }

        /**
         * Очистить результаты во всех поисках
         */
        function clearAllResults() {
            searchBlocks.forEach(function (config) {
                const elements = getSearchElements(config);

                if (!elements) {
                    return;
                }

                elements.input.value = '';
                hideContent(elements);
            });
        }

        /**
         * Синхронизировать значение между desktop/mobile
         */
        function syncInputs(value, currentInput) {
            searchBlocks.forEach(function (config) {
                const elements = getSearchElements(config);

                if (!elements) {
                    return;
                }

                if (elements.input !== currentInput) {
                    elements.input.value = value;
                }
            });
        }

        /**
         * Вывести результаты
         */
        function renderResults(items, elements, itemClass) {
            elements.list.innerHTML = '';

            if (!items || !items.length) {
                showMessage(elements, 'Нет результатов', itemClass);
                return;
            }

            items.forEach(function (item) {
                const li = document.createElement('li');
                li.className = itemClass;

                const link = document.createElement('a');

                link.className = 'text-caption';
                link.href = item.url;
                link.textContent = item.name;

                li.appendChild(link);
                elements.list.appendChild(li);
            });

            showContent(elements);
        }

        /**
         * Вывести результаты во все поисковые блоки
         */
        function renderResultsAll(items) {
            searchBlocks.forEach(function (config) {
                const elements = getSearchElements(config);

                if (!elements) {
                    return;
                }

                renderResults(
                    items,
                    elements,
                    config.itemClass
                );
            });
        }

        /**
         * Показать сообщение во всех поисковых блоках
         */
        function showMessageAll(message) {
            searchBlocks.forEach(function (config) {
                const elements = getSearchElements(config);

                if (!elements) {
                    return;
                }

                showMessage(
                    elements,
                    message,
                    config.itemClass
                );
            });
        }

        /**
         * Выполнить поиск
         */
        async function searchRequest(query) {
            // Отменяем предыдущий запрос
            if (controller) {
                controller.abort();
            }

            controller = new AbortController();

            showMessageAll('Происходит поиск...');

            try {
                const response = await fetch(
                    `/ajax/search.php?q=${encodeURIComponent(query)}`,
                    {
                        method: 'GET',
                        signal: controller.signal
                    }
                );

                if (!response.ok) {
                    throw new Error(
                        'Ошибка HTTP: ' + response.status
                    );
                }

                const data = await response.json();

                if (!data.success) {
                    showMessageAll('Нет результатов');
                    return;
                }

                renderResultsAll(data.items);

            } catch (error) {
                // Отмена предыдущего запроса — это не ошибка
                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Ошибка поиска:', error);

                showMessageAll('Нет результатов');

            } finally {
                controller = null;
            }
        }

        /**
         * Обработать ввод
         */
        function handleInput(input) {
            const query = input.value.trim();

            clearTimeout(searchTimeout);

            // Синхронизируем desktop/mobile
            syncInputs(input.value, input);

            // Отменяем предыдущий запрос
            if (controller) {
                controller.abort();
                controller = null;
            }

            // Пустое поле
            if (!query) {
                searchBlocks.forEach(function (config) {
                    const elements = getSearchElements(config);

                    if (elements) {
                        hideContent(elements);
                    }
                });

                return;
            }

            // Меньше 2 символов
            if (query.length < 2) {
                showMessageAll(
                    'Введите минимум 2 символа'
                );

                return;
            }

            // Сразу показываем состояние поиска
            showMessageAll('Происходит поиск...');

            // Debounce
            searchTimeout = setTimeout(function () {
                searchRequest(query);
            }, 300);
        }

        /**
         * Обработать очистку
         */
        function handleClear(input) {
            clearTimeout(searchTimeout);

            if (controller) {
                controller.abort();
                controller = null;
            }

            clearAllResults();

            // Фокус возвращаем именно текущему полю
            input.focus();
        }

        /**
         * Инициализация поисковых блоков
         */
        searchBlocks.forEach(function (config) {
            const elements = getSearchElements(config);

            if (!elements) {
                return;
            }

            elements.input.addEventListener(
                'input',
                function () {
                    handleInput(elements.input);
                }
            );

            elements.clearButton.addEventListener(
                'click',
                function () {
                    handleClear(elements.input);
                }
            );
        });
    });
</script>