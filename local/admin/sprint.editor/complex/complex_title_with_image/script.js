sprint_editor.registerBlock('complex_title_with_image', function ($, $el, data) {
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
