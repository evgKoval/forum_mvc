$(document).ready(function() {
    $.ajax({
        method: "POST",
        url: 'get-preferences/' + 1,
        success: function(response) {
            var subCategories = JSON.parse(response);

            $("#sub_category_input").empty();

            for (var i = 0; i < subCategories.length; i++) {
                $("#sub_category_input").append('\
                    <option value="' + subCategories[i].id + '">\
                        ' + subCategories[i].name + '\
                    </option>\
                ');
            }
        }
    });

    $('#category_input').change(function(event) {
        var categoryId = $(this).val();

        getSubCategories(categoryId);
    });

    function getSubCategories(categoryId) {
        $.ajax({
            method: "POST",
            url: 'get-preferences/' + categoryId,
            success: function(response) {
                var subCategories = JSON.parse(response);

                $("#sub_category_input").empty();

                for (var i = 0; i < subCategories.length; i++) {
                    $("#sub_category_input").append('\
                        <option value="' + subCategories[i].id + '">\
                            ' + subCategories[i].name + '\
                        </option>\
                    ');
                }
            }
        });
    }
});