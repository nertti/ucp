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

        return [
            ...shuffle(groups[1]),
            ...shuffle(groups[2]),
            ...shuffle(groups[3]),
            ...shuffle(groups[4])
        ];
    }

    /**
     * Фильтрация услуг
     */
    function filterServices(category) {
        const items = Array.from(
            servicesList.querySelectorAll(".services__list-item")
        );

        skeletonList.classList.remove("_empty-active");

        /**
         * Фиксируем текущую высоту блока.
         */
        const currentHeight = wrapper.offsetHeight;
        wrapper.style.minHeight = `${currentHeight}px`;

        /**
         * Плавно скрываем текущий список.
         */
        servicesList.style.transition = "opacity 0.25s ease";
        servicesList.style.opacity = "0";

        setTimeout(() => {

            /**
             * Сначала полностью скрываем ВСЕ карточки.
             */
            items.forEach(item => {
                item.style.display = "none";
                item.style.opacity = "0";
                item.style.transform =
                    "translateY(20px) scale(0.95)";
                item.style.transition = "none";
            });

            /**
             * Показываем скелетон.
             */
            skeletonList.classList.add("_active");

            setTimeout(() => {

                skeletonList.classList.remove("_active");

                setTimeout(() => {

                    /**
                     * Определяем подходящие карточки.
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
                     * Сортируем только подходящие карточки.
                     */
                    matchedItems = sortItemsByTag(matchedItems);

                    const matchCount = matchedItems.length;

                    /**
                     * Создаём Set подходящих карточек.
                     * Это позволит гарантированно определить,
                     * какие карточки нужно скрыть.
                     */
                    const matchedSet = new Set(matchedItems);

                    /**
                     * ------------------------------------------------
                     * ВАЖНО:
                     * Сначала возвращаем все карточки в DOM.
                     * ------------------------------------------------
                     */
                    items.forEach(item => {
                        servicesList.appendChild(item);
                    });

                    /**
                     * ------------------------------------------------
                     * Затем поднимаем подходящие карточки наверх.
                     * ------------------------------------------------
                     *
                     * reverse нужен для сохранения порядка:
                     *
                     * [1, 2, 3]
                     *
                     * prepend(3)
                     * prepend(2)
                     * prepend(1)
                     *
                     * результат:
                     *
                     * [1, 2, 3]
                     */
                    [...matchedItems].reverse().forEach(item => {
                        servicesList.prepend(item);
                    });

                    /**
                     * ------------------------------------------------
                     * ЯВНО скрываем все неподходящие карточки.
                     * ------------------------------------------------
                     */
                    items.forEach(item => {
                        if (matchedSet.has(item)) {
                            item.style.display = "";
                        } else {
                            item.style.display = "none";
                            item.style.opacity = "0";
                            item.style.transform =
                                "translateY(20px) scale(0.95)";
                        }
                    });

                    /**
                     * Анимируем только первые 6 подходящих карточек.
                     *
                     * Это не ограничивает количество.
                     * Количество отображаемых карточек определяет CSS.
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

                        /**
                         * Показываем список.
                         */
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
     * Переключение вкладок.
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

        /**
         * Убираем active со всех вкладок.
         */
        document
            .querySelectorAll(".tabs__item")
            .forEach(el => {
                el.classList.remove("_active");
            });

        /**
         * Добавляем active текущей.
         */
        tabItem.classList.add("_active");

        /**
         * Фильтруем.
         */
        filterServices(category);
    });

    /**
     * ------------------------------------------------
     * Первоначальная загрузка.
     * ------------------------------------------------
     */

    const firstItems = Array.from(
        servicesList.querySelectorAll(".services__list-item")
    );

    /**
     * Сортируем все карточки.
     */
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
     * Фактическое количество видимых карточек
     * определяет CSS через nth-child().
     */
    sortedFirstItems.forEach(item => {
        item.style.display = "";
    });

    /**
     * Анимируем первые 6.
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