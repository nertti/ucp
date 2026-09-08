document.addEventListener('DOMContentLoaded', function () {

    const forms = document.querySelectorAll('.popup__form-content form');

    if (!forms.length) {
        return;
    }

    forms.forEach(function (form) {

        const popup = form.closest('.popup');

        const formContent = popup.querySelector(
            '.popup__form-content'
        );

        const successContent = popup.querySelector(
            '.popup__success-content'
        );

        const errorBlock = popup.querySelector(
            '.popup__error'
        );


        /**
         * Удаление ошибок валидации
         */
        function clearErrors() {

            form.querySelectorAll('.error-message').forEach(function (error) {
                error.remove();
            });

            form.querySelectorAll('.input.error').forEach(function (input) {
                input.classList.remove('error');
            });
        }


        /**
         * Ошибка отправки
         */
        function showServerError(message) {

            if (!errorBlock) {
                return;
            }

            errorBlock.textContent = message || 'Не удалось отправить заявку. Попробуйте ещё раз.';
            errorBlock.hidden = false;
        }


        /**
         * Удалить ошибку отправки
         */
        function clearServerError() {

            if (!errorBlock) {
                return;
            }

            errorBlock.textContent = '';
            errorBlock.hidden = true;
        }


        /**
         * Показать успешную отправку
         */
        function showSuccess() {

            formContent.hidden = true;
            successContent.hidden = false;
        }


        /**
         * Вернуть форму
         */
        function showForm() {

            formContent.hidden = false;
            successContent.hidden = true;

            clearServerError();
            clearErrors();
        }


        /**
         * Показ ошибки поля
         */
        function showError(element, message) {

            element.classList.add('error');

            const parent = element.parentNode;

            if (parent.querySelector('.error-message')) {
                return;
            }

            const error = document.createElement('div');

            error.className = 'error-message';
            error.textContent = message || 'Обязательно для заполнения';

            parent.appendChild(error);
        }


        /**
         * Отправка формы
         */
        form.addEventListener('submit', async function (event) {

            event.preventDefault();

            // Удаляем ВСЕ старые ошибки
            clearErrors();

            // Убираем старую серверную ошибку
            clearServerError();

            let isValid = true;


            /**
             * Проверяем input
             */
            form.querySelectorAll('input[data-error]').forEach(function (input) {

                if (input.type === 'radio') {
                    return;
                }

                const value = input.value.trim();


                // Обязательное поле
                if (!value) {

                    showError(
                        input,
                        input.dataset.error || 'Обязательно для заполнения'
                    );

                    isValid = false;

                    return;
                }


                // Email
                if (input.type === 'email') {

                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!emailRegex.test(value)) {

                        showError(
                            input,
                            'Введите корректный E-mail'
                        );

                        isValid = false;
                    }
                }


                // Телефон
                if (input.type === 'tel') {

                    const phone = value.replace(/\D/g, '');

                    if (phone.length < 10) {

                        showError(
                            input,
                            'Введите корректный номер телефона'
                        );

                        isValid = false;
                    }
                }

            });


            /**
             * Проверяем образование
             */
            const educationRadios = form.querySelectorAll(
                'input[name="enterprise"]'
            );

            if (educationRadios.length) {

                const educationChecked = form.querySelector(
                    'input[name="enterprise"]:checked'
                );

                if (!educationChecked) {

                    const radioBlock = educationRadios[0]
                        .closest('.form__line');

                    if (radioBlock) {

                        const error = document.createElement('div');

                        error.className = 'error-message';
                        error.textContent = 'Обязательно для заполнения';

                        radioBlock.appendChild(error);
                    }

                    isValid = false;
                }
            }


            /**
             * Если форма заполнена неправильно
             */
            if (!isValid) {
                return;
            }


            /**
             * Кнопка отправки
             */
            const submitButton = form.querySelector(
                'button[type="submit"]'
            );

            if (submitButton) {

                submitButton.disabled = true;
                submitButton.classList.add('loading');
            }


            /**
             * Данные формы
             */
            const formData = new FormData(form);


            try {

                const response = await fetch(
                    form.action,
                    {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );


                /**
                 * Проверяем HTTP-ошибку
                 */
                if (!response.ok) {
                    throw new Error(
                        'HTTP error: ' + response.status
                    );
                }


                const result = await response.json();


                /**
                 * УСПЕШНАЯ ОТПРАВКА
                 */
                if (result.success) {

                    form.reset();

                    clearErrors();
                    clearServerError();

                    showSuccess();

                    return;
                }


                /**
                 * ОШИБКА ОТ СЕРВЕРА
                 */
                showServerError(
                    result.message ||
                    'Не удалось отправить заявку. Попробуйте ещё раз.'
                );


            } catch (error) {

                console.error(
                    'Ошибка отправки формы:',
                    error
                );

                showServerError(
                    'Произошла ошибка при отправке заявки. ' +
                    'Попробуйте ещё раз.'
                );


            } finally {

                if (submitButton) {

                    submitButton.disabled = false;
                    submitButton.classList.remove('loading');
                }
            }

        });


        /**
         * Удаляем ошибку поля при вводе
         */
        form.addEventListener('input', function (event) {

            const input = event.target;

            if (!input.matches('.input')) {
                return;
            }

            if (input.value.trim()) {

                input.classList.remove('error');

                const error = input.parentNode.querySelector(
                    '.error-message'
                );

                if (error) {
                    error.remove();
                }
            }
        });


        /**
         * Удаляем ошибку radio
         */
        form.addEventListener('change', function (event) {

            if (event.target.name !== 'enterprise') {
                return;
            }

            const formLine = event.target.closest('.form__line');

            if (!formLine) {
                return;
            }

            const error = formLine.querySelector(
                '.error-message'
            );

            if (error) {
                error.remove();
            }
        });


        /**
         * Если popup закрыли после успешной отправки,
         * при следующем открытии снова показываем форму.
         */
        const closeButtons = popup.querySelectorAll('[data-close]');

        closeButtons.forEach(function (button) {

            button.addEventListener('click', function () {

                // Если сейчас открыт success
                if (!successContent.hidden) {

                    // Небольшая задержка нужна,
                    // чтобы не мешать основной логике popup
                    setTimeout(function () {
                        showForm();
                    }, 0);
                }

            });

        });

    });

});
