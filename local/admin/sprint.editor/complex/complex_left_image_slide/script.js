sprint_editor.registerBlock('complex_left_image_slide', function ($, $el, data) {
    var areas = [
    {
        "blockName": "htag",
        "dataKey": "htag",
        "container": ".sp-area-1"
    },
    {
        "blockName": "image",
        "dataKey": "image",
        "container": ".sp-area-2"
    },
    {
        "blockName": "my_container",
        "dataKey": "my_container",
        "container": ".sp-area-3"
    }
];

    this.getData = function () {
        return data;
    };

    this.collectData = function () {
        return data;
    };

    this.getAreas = function () {
        return areas;
    };
});
