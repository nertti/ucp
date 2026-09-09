sprint_editor.registerBlock('my_button_icons_link', function ($, $el, data) {

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
     * Если блок создаётся впервые —
     * добавляем один пустой элемент
     */
    if (!data.items.length) {
        data.items.push({
            title: '',
            url: '',
            icon: '',
            target: ''
        });
    }


    /**
     * Формируем список target
     */
    function getTargets(target) {

        var result = $.extend(true, [], targets);

        $.each(result, function (index, item) {
            item.selected = item.value == target;
        });

        return result;
    }


    /**
     * Данные для шаблона редактора
     */
    this.getData = function () {

        return {
            items: data.items,
            targets: getTargets('')
        };

    };


    /**
     * Собираем данные из редактора
     */
    this.collectData = function () {

        var items = [];

        $el.find('.sp-item').each(function () {

            var $item = $(this);

            items.push({
                title: $item.find('.sp-title').val(),
                url: $item.find('.sp-url').val(),
                icon: $item.find('.sp-icon').val(),
                target: $item.find('.sp-target').val()
            });

        });

        data.items = items;

        return data;

    };


});