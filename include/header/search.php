<div class="header__search">
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
        const search = document.querySelector('.header__search');
        const input = search.querySelector('input[name="search"]');
        const list = search.querySelector('.header__search-list');
        const content = search.querySelector('.header__search-content');
        const clearButton = search.querySelector('.header__search-btn--clear');

        let searchTimeout = null;
        let controller = null;

        /**
         * Открыть блок результатов
         */
        function showContent() {
            content.classList.add('active');
        }

        /**
         * Скрыть блок результатов
         */
        function hideContent() {
            content.classList.remove('active');
            list.innerHTML = '';
        }

        /**
         * Показать сообщение
         */
        function showMessage(message) {
            list.innerHTML = `
            <li class="header__search-item">
                <p class="text-caption">${message}</p>
            </li>
        `;

            showContent();
        }

        /**
         * Вывести результаты
         */
        function renderResults(items) {
            list.innerHTML = '';

            if (!items || !items.length) {
                showMessage('Нет результатов');
                return;
            }

            items.forEach(function (item) {
                const li = document.createElement('li');
                li.className = 'header__search-item';

                const link = document.createElement('a');
                link.className = 'text-caption';
                link.href = item.url;
                link.textContent = item.name;

                li.appendChild(link);
                list.appendChild(li);
            });

            showContent();
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

            showMessage('Происходит поиск...');

            try {
                const response = await fetch(
                    `/ajax/search.php?q=${encodeURIComponent(query)}`,
                    {
                        method: 'GET',
                        signal: controller.signal
                    }
                );

                if (!response.ok) {
                    throw new Error('Ошибка HTTP: ' + response.status);
                }

                const data = await response.json();

                if (!data.success) {
                    showMessage('Нет результатов');
                    return;
                }

                renderResults(data.items);

            } catch (error) {
                // AbortError возникает при отмене предыдущего запроса.
                // Это не ошибка поиска.
                if (error.name === 'AbortError') {
                    return;
                }

                console.error('Ошибка поиска:', error);

                showMessage('Нет результатов');
            }
        }

        /**
         * Ввод в поле поиска
         */
        input.addEventListener('input', function () {
            const query = input.value.trim();

            clearTimeout(searchTimeout);

            // Отменяем предыдущий запрос
            if (controller) {
                controller.abort();
                controller = null;
            }

            // Пустое поле
            if (!query) {
                hideContent();
                return;
            }

            // Меньше 2 символов
            if (query.length < 2) {
                showMessage('Введите минимум 2 символа');
                return;
            }

            // Сразу показываем блок
            showMessage('Происходит поиск...');

            // Небольшая задержка перед запросом
            searchTimeout = setTimeout(function () {
                searchRequest(query);
            }, 300);
        });

        /**
         * Очистить поиск
         */
        clearButton.addEventListener('click', function () {
            clearTimeout(searchTimeout);

            if (controller) {
                controller.abort();
                controller = null;
            }

            input.value = '';
            hideContent();
            input.focus();
        });
    });
</script>