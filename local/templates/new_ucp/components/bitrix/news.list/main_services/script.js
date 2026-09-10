document.addEventListener("DOMContentLoaded", function() {
    const tabsContainer = document.querySelector(".tabs");
    const servicesList = document.querySelector(".services__list");
    const wrapper = document.querySelector(".services__wrapper");
    const skeletonList = document.querySelector(".services__skeleton-list");

    if (!tabsContainer || !servicesList || !wrapper || !skeletonList) return;

    // Функция сортировки: элементы с заполненным тегом .label поднимаются наверх
    function sortItemsByTag(itemsArray) {

        function getWeight(item) {
            const tagSpan = item.querySelector(
                ".services__list-item-badge .label span"
            );

            if (!tagSpan) {
                return 4; // Без тега
            }

            const tagText = tagSpan.textContent.trim().toLowerCase();

            if (tagText === "популярная услуга") {
                return 1;
            }

            if (tagText === "рекомендуем") {
                return 2;
            }

            return 3; // Любой другой тег
        }

        // Сначала разбиваем карточки по группам
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

        // Перемешивание внутри каждой группы
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));

                [array[i], array[j]] = [array[j], array[i]];
            }

            return array;
        }

        // Собираем обратно:
        // Популярная → Рекомендуем → другие теги → без тега
        return [
            ...shuffle(groups[1]),
            ...shuffle(groups[2]),
            ...shuffle(groups[3]),
            ...shuffle(groups[4])
        ];
    }

    function filterServices(category) {
        const items = Array.from(servicesList.querySelectorAll(".services__list-item"));

        // Сбрасываем состояния пустых разделов перед новой фильтрацией
        skeletonList.classList.remove("_empty-active");

        // 1. ФИКСИРУЕМ ВЫСОТУ
        const currentHeight = wrapper.offsetHeight;
        wrapper.style.minHeight = `${currentHeight}px`;

        // 2. Плавно гасим текущий список услуг
        servicesList.style.transition = "opacity 0.25s ease";
        servicesList.style.opacity = "0";

        setTimeout(() => {
            // Мгновенно скрываем все старые элементы
            items.forEach(item => {
                item.style.display = "none";
                item.style.opacity = "0";
                item.style.transform = "translateY(20px) scale(0.95)";
                item.style.transition = "none";
            });

            // 3. Включаем бегущий скелетон на время "поиска"
            skeletonList.classList.add("_active");

            setTimeout(() => {
                // Выключаем анимацию бегущего скелетона
                skeletonList.classList.remove("_active");

                setTimeout(() => {
                    // Фильтруем элементы по категории
                    let matchedItems = items.filter(item => {
                        const singleCategory = item.dataset.category || "";
                        let multiCategories = [];
                        try {
                            const rawCats = item.getAttribute('data-categories');
                            if (rawCats) multiCategories = JSON.parse(rawCats);
                        } catch (e) {
                            multiCategories = [];
                        }

                        return category === "all" ||
                            singleCategory === category ||
                            multiCategories.includes(category);
                    });

                    // Сортируем: карточки с TAG выводятся в приоритете
                    matchedItems = sortItemsByTag(matchedItems);

                    let visibleIndex = 0;
                    const matchCount = matchedItems.length;

                    // Отображаем первые 5 отсортированных карточек
                    matchedItems.forEach((item) => {
                        if (visibleIndex < 5) {
                            item.style.display = "";

                            // Каскадная анимация появления
                            setTimeout(() => {
                                item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
                                item.style.opacity = "1";
                                item.style.transform = "translateY(0) scale(1)";
                            }, visibleIndex * 80);

                            visibleIndex++;
                        }
                    });

                    // Физически перестраиваем порядок элементов в DOM, чтобы Grid/Flex сетка отображала их корректно
                    matchedItems.forEach(item => servicesList.appendChild(item));

                    // Если подходящих карточек вообще нет
                    if (matchCount === 0) {
                        skeletonList.classList.add("_empty-active");

                        setTimeout(() => {
                            const emptyCard = skeletonList.querySelector("._empty-state");
                            if (emptyCard) {
                                wrapper.style.minHeight = `${emptyCard.offsetHeight}px`;
                            } else {
                                wrapper.style.minHeight = "350px";
                            }
                        }, 100);
                    } else {
                        // Если карточки найдены — плавно показываем их
                        servicesList.style.opacity = "1";

                        // Отпускаем фиксацию высоты после завершения анимации лесенки
                        setTimeout(() => {
                            wrapper.style.minHeight = "0px";
                        }, (visibleIndex * 80) + 200);
                    }

                }, 200);
            }, 450);
        }, 250);
    }

    tabsContainer.addEventListener("click", function(e) {
        const tabItem = e.target.closest(".tabs__item");
        if (!tabItem) return;
        if (tabItem.classList.contains("_active")) return;

        const category = tabItem.dataset.tab || tabItem.dataset.code || "all";

        document.querySelectorAll(".tabs__item").forEach(el => el.classList.remove("_active"));
        tabItem.classList.add("_active");

        filterServices(category);
    });

    // При первой загрузке страницы плавно показываем отсортированные топ-5 элементов (для "Все услуги")
    const firstItems = Array.from(servicesList.querySelectorAll(".services__list-item"));
    const sortedFirstItems = sortItemsByTag(firstItems);
    let initialCount = 0;

    sortedFirstItems.forEach((item) => {
        if (initialCount < 5) {
            item.style.opacity = "0";
            item.style.transform = "translateY(20px) scale(0.95)";
            item.style.transition = "none";

            setTimeout(() => {
                item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
                item.style.opacity = "1";
                item.style.transform = "translateY(0) scale(1)";
            }, initialCount * 60);

            initialCount++;
        } else {
            item.style.display = "none";
        }
    });

    // Фиксируем физический порядок элементов в DOM при старте
    sortedFirstItems.forEach(item => servicesList.appendChild(item));
});
