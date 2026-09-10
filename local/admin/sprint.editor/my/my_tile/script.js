sprint_editor.registerBlock('my_tile', function ($, $el, data) {

    data = $.extend({
        items: []
    }, data);


    var targets = [
        {
            name: 'Открыть страницу',
            value: '',
            selected: false
        },
        {
            name: 'Открыть страницу в новой вкладке',
            value: '_blank',
            selected: false
        }
    ];


    /**
     * Если блок создаётся впервые
     */
    if (!data.items.length) {
        data.items.push({
            title: '',
            url: '',
            icon: {},
            image: {},
            target: ''
        });
    }


    /**
     * Нормализация данных
     */
    $.each(data.items, function (index, item) {

        if (!item.icon || typeof item.icon !== 'object') {
            item.icon = {};
        }

        if (!item.image || typeof item.image !== 'object') {
            item.image = {};
        }

    });


    /**
     * Формирование target
     */
    function getTargets(target) {

        var result = $.extend(true, [], targets);

        $.each(result, function (index, item) {
            item.selected = item.value == target;
        });

        return result;
    }


    /**
     * Данные блока
     */
    this.getData = function () {

        return {
            items: data.items,
            targets: getTargets('')
        };

    };


    /**
     * После отрисовки
     */
    this.afterRender = function () {

        $el.find('.sp-item').each(function (index) {

            var $item = $(this);
            var item = data.items[index];

            if (!item) {
                return;
            }

            initFileField($item, item, 'icon');
            initFileField($item, item, 'image');

        });

    };


    /**
     * Инициализация загрузки файла
     *
     * type:
     * icon
     * image
     */
    function initFileField($item, item, type) {

        var $field = $item.find(
            '.sp-file-field[data-type="' + type + '"]'
        );

        if (!$field.length) {
            return;
        }


        var file = item[type] || {};


        /**
         * Отрисовываем уже загруженный файл
         */
        renderFile($field, file);


        var $btn = $field.find('.sp-x-btn-file');
        var $btninput = $btn.find('input[type=file]');
        var $label = $btn.find('label');


        if (!$btninput.length) {
            return;
        }


        var labeltext = $label.text();


        /**
         * Загрузка файла
         */
        $btninput.fileupload({

            /*
             * Как в штатном image-блоке.
             * Позволяет также перетаскивать файл
             * в область всего блока.
             */
            dropZone: $el,

            url: sprint_editor.getBlockWebPath('image') + '/upload.php',

            dataType: 'json',

            done: function (e, result) {

                /**
                 * Ошибки
                 */
                if (result.result && result.result.errors) {

                    renderErrors(
                        $field,
                        result.result.errors
                    );

                }


                /**
                 * Полученный файл
                 */
                if (
                    result.result &&
                    result.result.file
                ) {

                    $.each(
                        result.result.file,
                        function (index, uploadedFile) {

                            item[type] = uploadedFile;

                        }
                    );


                    /**
                     * Обновляем превью
                     */
                    renderFile(
                        $field,
                        item[type]
                    );


                    /**
                     * Показываем режим редактирования
                     */
                    togglePanel(
                        $field,
                        false
                    );

                }

            },


            /**
             * Прогресс
             */
            progressall: function (e, result) {

                var progress = parseInt(
                    result.loaded / result.total * 100,
                    10
                );


                $label.text(
                    'Загрузка: ' + progress + '%'
                );


                if (progress >= 100) {
                    $label.text(labeltext);
                }

            }

        })
            .prop(
                'disabled',
                !$.support.fileInput
            )
            .parent()
            .addClass(
                $.support.fileInput
                    ? undefined
                    : 'disabled'
            );


        /**
         * Загрузка изображения по URL
         */
        $field.find('.sp-download-url').bindWithDelay(
            'input',
            function () {

                var $urltext = $(this);

                var urlvalue = $.trim(
                    $urltext.val()
                );


                if (!urlvalue.length) {
                    return false;
                }


                $.ajax({

                    url: sprint_editor.getBlockWebPath('image') + '/download.php',

                    type: 'post',

                    data: {
                        url: urlvalue,
                        sessid: BX.bitrix_sessid()
                    },

                    dataType: 'json',

                    success: function (result) {

                        renderErrors(
                            $field,
                            result.errors
                        );


                        if (result.image) {

                            item[type] = result.image;


                            renderFile(
                                $field,
                                item[type]
                            );


                            togglePanel(
                                $field,
                                false
                            );

                        }


                        $urltext.val('');

                    }

                });

            },
            500
        );


        /**
         * Изменение описания
         */
        $field.find('.sp-item-file-description').bindWithDelay(
            'input',
            function () {

                var description = $(this).val();


                if (
                    item[type] &&
                    item[type].ID
                ) {

                    item[type].DESCRIPTION = description;


                    $.ajax({

                        url: sprint_editor.getBlockWebPath('image') + '/desc.php',

                        type: 'post',

                        data: Object.assign(
                            {
                                sessid: BX.bitrix_sessid()
                            },
                            item[type]
                        )

                    });

                }

            },
            500
        );


        /**
         * Удаление файла
         *
         * Удаляем ссылку на файл из данных блока.
         * Сам физический файл в Битрикс при этом
         * не удаляется.
         */
        $field.on(
            'click',
            '.sp-item-file-del',
            function () {

                item[type] = {};


                renderFile(
                    $field,
                    item[type]
                );


                togglePanel(
                    $field,
                    true
                );

            }
        );


        /**
         * Начальное состояние
         */
        if (
            !file ||
            !file.SRC
        ) {

            togglePanel(
                $field,
                true
            );

        } else {

            togglePanel(
                $field,
                false
            );

        }

    }


    /**
     * Отрисовка файла
     */
    function renderFile($field, file) {

        $field.find('.sp-file-result').html(

            sprint_editor.renderTemplate(
                'image-image',
                {
                    file: file || {}
                }
            )

        );

    }


    /**
     * Вывод ошибок
     */
    function renderErrors($field, errors) {

        $field.find('.sp-file-errors').html(
            errors || ''
        );

    }


    /**
     * Показать / скрыть панель
     */
    function togglePanel($field, show) {

        if (show) {
            $field.addClass('sp-show');
        } else {
            $field.removeClass('sp-show');
        }

    }


    /**
     * Сбор данных
     */
    this.collectData = function () {

        var items = [];


        $el.find('.sp-item').each(function (index) {

            var $item = $(this);

            var oldItem = data.items[index] || {};


            items.push({

                title: $item.find('.sp-title').val(),

                url: $item.find('.sp-url').val(),

                icon: oldItem.icon || {},

                image: oldItem.image || {},

                target: $item.find('.sp-target').val()

            });

        });


        data.items = items;


        return data;

    };

});