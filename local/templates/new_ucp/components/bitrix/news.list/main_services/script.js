document.addEventListener("DOMContentLoaded", function() {
    const tabsContainer = document.querySelector(".tabs");
    const servicesList = document.querySelector(".services__main-list");
    const wrapper = document.querySelector(".services__wrapper");
    const skeletonList = document.querySelector(".services__skeleton-list");

    if (!tabsContainer || !servicesList || !wrapper || !skeletonList) return;

    function filterServices(category) {
        const items = servicesList.querySelectorAll(".services__main-list-item");

        // Сбрасываем состояния пустых разделов перед новой фильтрацией
        skeletonList.classList.remove("_empty-active");

        // 1. ФИКСИРУЕМ ВЫСОТУ
        const currentHeight = wrapper.offsetHeight;
        wrapper.style.minHeight = `${currentHeight}px`;

        // 2. Плавно гасим текущий список услуг
        servicesList.style.transition = "opacity 0.25s ease";
        servicesList.style.opacity = "0";

        setTimeout(() => {
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
                    let visibleIndex = 0;
                    let matchCount = 0; // Счетчик найденных карточек

                    // Фильтруем элементы
                    items.forEach((item) => {
                        // Проверяем категорию (одиночную или массив)
                        const singleCategory = item.dataset.category || "";
                        let multiCategories = [];
                        try {
                            const rawCats = item.getAttribute('data-categories');
                            if (rawCats) multiCategories = JSON.parse(rawCats);
                        } catch (e) {
                            multiCategories = [];
                        }

                        const isMatch = category === "all" ||
                            singleCategory === category ||
                            multiCategories.includes(category);

                        // ДОБАВЛЕНО ОГРАНИЧЕНИЕ: отображаем элемент, только если МЕНЬШЕ 5 совпадений
                        if (isMatch && matchCount < 5) {
                            item.style.display = ""; // Возвращаем в сетку grid

                            // Ваша каскадная анимация появления
                            setTimeout(() => {
                                item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
                                item.style.opacity = "1";
                                item.style.transform = "translateY(0) scale(1)";
                            }, visibleIndex * 80);

                            visibleIndex++;
                            matchCount++;
                        } else if (isMatch) {
                            // Если карточка подходит под фильтр, но она уже шестая по счету,
                            // мы увеличиваем matchCount, чтобы понять, что раздел не пустой,
                            // но display оставляем "none"
                            matchCount++;
                        }
                    });

                    // Если подходящих карточек вообще нет
                    if (visibleIndex === 0) {
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

                }, 200); // Задержка на исчезновение скелетона
            }, 450); // Время работы скелетона
        }, 250); // Время затухания старого списка
    }

    tabsContainer.addEventListener("click", function(e) {
        const tabItem = e.target.closest(".tabs__item");
        if (!tabItem) return;
        if (tabItem.classList.contains("_active")) return; // Защита от повторного клика по активному табу

        // Проверяем оба варианта дата-атрибутов на всякий случай
        const category = tabItem.dataset.tab || tabItem.dataset.code || "all";

        document.querySelectorAll(".tabs__item").forEach(el => el.classList.remove("_active"));
        tabItem.classList.add("_active");

        filterServices(category);
    });

    // При первой загрузке страницы показываем всё сразу БЕЗ скелетона
    const firstItems = servicesList.querySelectorAll(".services__main-list-item");
    firstItems.forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform = "translateY(20px) scale(0.95)";
        item.style.transition = "none";
        setTimeout(() => {
            item.style.transition = "all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1)";
            item.style.opacity = "1";
            item.style.transform = "translateY(0) scale(1)";
        }, index * 60);
    });
});
