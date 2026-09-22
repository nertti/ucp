document.addEventListener("DOMContentLoaded", function () {
    const tabsContainer = document.querySelector(".tabs");
    const servicesList = document.querySelector(".services__main-list");
    const wrapper = document.querySelector(".services__wrapper");
    const skeletonList = document.querySelector(".services__skeleton-list");

    if (!tabsContainer || !servicesList || !wrapper || !skeletonList) {
        return;
    }

    /**
     * Сортировка услуг по тегу:
     *
     * 1 — Популярная услуга
     * 2 — Рекомендуем
     * 3 — любой другой тег
     * 4 — без тега
     */
    function sortItemsByTag(itemsArray) {
        function getWeight(item) {
            const tagSpan = item.querySelector(
                ".services__list-item-badge .label span"
            );

            if (!tagSpan) {
                return 4;
            }

            const tagText = tagSpan.textContent.trim().toLowerCase();

            if (tagText === "популярная услуга") {
                return 1;
            }

            if (tagText === "рекомендуем") {
                return 2;
            }

            return 3;
        }

        const groups = {
            1: [],
            2: [],
            3: [],
            4: []
        };

        itemsArray.forEach(item => {
            const weight = getWeight(item);
            groups[weight].push(item);
        });

        /**
         * Перемешивание внутри группы
         */
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));

                [array[i], array[j]] = [array[j], array[i]];
            }

            return array;
        }

        /**
         * Итоговый порядок:
         *
         * Популярная услуга
         * ↓
         * Рекомендуем
         * ↓
         * Другие теги
         * ↓
         * Без тега
         */
        return [
            ...shuffle(groups[1]),
            ...shuffle(groups[2]),
            ...shuffle(groups[3]),
            ...shuffle(groups[4])
        ];
    }

    /**
     * Поднимает найденные карточки в начало списка.
     *
     * CSS при этом продолжает самостоятельно
     * ограничивать количество отображаемых карточек
     * через nth-child().
     */
    function moveItemsToTop(items) {
        [...items].reverse().forEach(item => {
            servicesList.prepend(item);
        });
    }

    /**
     * Фильтрация услуг
     */
    function filterServices(category) {
        const items = Array.from(
            servicesList.querySelectorAll(".services__list-item")
        );

        // Сбрасываем состояние пустого раздела
        skeletonList.classList.remove("_empty-active");

        // Фиксируем текущую высоту блока
        const currentHeight = wrapper.offsetHeight;
        wrapper.style.minHeight = `${currentHeight}px`;

        // Плавно скрываем текущий список
        servicesList.style.transition = "opacity 0.25s ease";
        servicesList.style.opacity = "0";

        setTimeout(() => {

            /**
             * Сначала скрываем все карточки.
             */
            items.forEach(item => {
                item.style.display = "none";
                item.style.opacity = "0";
                item.style.transform =
                    "translateY(20px) scale(0.95)";
                item.style.transition = "none";
            });

            // Показываем скелетон
            skeletonList.classList.add("_active");

            setTimeout(() => {

                // Отключаем анимацию скелетона
                skeletonList.classList.remove("_active");

                setTimeout(() => {

                    /**
                     * Фильтруем карточки.
                     */
                    let matchedItems = items.filter(item => {
                        const singleCategory =
                            item.dataset.category || "";

                        let multiCategories = [];

                        try {
                            const rawCats =
                                item.getAttribute("data-categories");

                            if (rawCats) {
                                multiCategories = JSON.parse(rawCats);
                            }
                        } catch (e) {
                            multiCategories = [];
                        }

                        return (
                            category === "all" ||
                            singleCategory === category ||
                            multiCategories.includes(category)
                        );
                    });

                    /**
                     * Сортируем найденные карточки.
                     */
                    matchedItems = sortItemsByTag(matchedItems);

                    const matchCount = matchedItems.length;

                    /**
                     * Сначала скрываем ВСЕ карточки.
                     *
                     * Это важно, поскольку CSS использует nth-child().
                     */
                    items.forEach(item => {
                        item.style.display = "none";
                    });

                    /**
                     * Поднимаем найденные карточки в начало.
                     *
                     * Благодаря этому CSS:
                     *
                     * > 1500px  → первые 5
                     * 1025-1500 → первые 4
                     * <=1024px  → первые 6
                     *
                     * будет работать именно с отфильтрованными
                     * карточками.
                     */
                    moveItemsToTop(matchedItems);

                    /**
                     * Показываем найденные карточки.
                     */
                    matchedItems.forEach(item => {
                        item.style.display = "";
                    });

                    /**
                     * Анимируем только первые 6 карточек.
                     *
                     * Это НЕ ограничение количества.
                     * Количество отображаемых карточек
                     * по-прежнему определяет CSS.
                     */
                    matchedItems.slice(0, 6).forEach((item, index) => {
                        item.style.opacity = "0";
                        item.style.transform =
                            "translateY(20px) scale(0.95)";
                        item.style.transition = "none";

                        setTimeout(() => {
                            item.style.transition =
                                "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";

                            item.style.opacity = "1";
                            item.style.transform =
                                "translateY(0) scale(1)";
                        }, index * 80);
                    });

                    /**
                     * Если подходящих карточек нет.
                     */
                    if (matchCount === 0) {
                        skeletonList.classList.add("_empty-active");

                        setTimeout(() => {
                            const emptyCard =
                                skeletonList.querySelector("._empty-state");

                            if (emptyCard) {
                                wrapper.style.minHeight =
                                    `${emptyCard.offsetHeight}px`;
                            } else {
                                wrapper.style.minHeight = "350px";
                            }
                        }, 100);

                    } else {

                        // Показываем список
                        servicesList.style.opacity = "1";

                        /**
                         * Высота блока после завершения анимации.
                         */
                        const animationCount =
                            Math.min(matchCount, 6);

                        setTimeout(() => {
                            wrapper.style.minHeight = "0px";
                        }, (animationCount * 80) + 200);
                    }

                }, 200);

            }, 450);

        }, 250);
    }

    /**
     * Переключение вкладок
     */
    tabsContainer.addEventListener("click", function (e) {
        const tabItem = e.target.closest(".tabs__item");

        if (!tabItem) {
            return;
        }

        if (tabItem.classList.contains("_active")) {
            return;
        }

        const category =
            tabItem.dataset.tab ||
            tabItem.dataset.code ||
            "all";

        // Убираем active со всех вкладок
        document
            .querySelectorAll(".tabs__item")
            .forEach(el => {
                el.classList.remove("_active");
            });

        // Добавляем active текущей
        tabItem.classList.add("_active");

        // Фильтруем
        filterServices(category);
    });

    /**
     * Первоначальная загрузка.
     *
     * Сортируем все карточки.
     */
    const firstItems = Array.from(
        servicesList.querySelectorAll(".services__list-item")
    );

    const sortedFirstItems = sortItemsByTag(firstItems);

    /**
     * Перестраиваем DOM согласно сортировке.
     */
    sortedFirstItems.forEach(item => {
        servicesList.appendChild(item);
    });

    /**
     * Показываем все карточки.
     *
     * Какие именно будут видны —
     * решает CSS через nth-child().
     */
    sortedFirstItems.forEach(item => {
        item.style.display = "";
    });

    /**
     * Анимируем первые 6 карточек.
     */
    sortedFirstItems.slice(0, 6).forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform =
            "translateY(20px) scale(0.95)";
        item.style.transition = "none";

        setTimeout(() => {
            item.style.transition =
                "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";

            item.style.opacity = "1";
            item.style.transform =
                "translateY(0) scale(1)";
        }, index * 60);
    });
});