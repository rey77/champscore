$(function () {
    var url = "php/json_comp.php";

    $.getJSON(url, function (result) {
        var comp = [];
        $.each(result, function (i, field) {
            comp.push(field.comp_name);
        });

        $('#autocomplete').autocomplete({
            lookup: comp,
            onSelect: function (suggestion) {
                $.each(result, function (i, field) {
                    if(field.comp_name === suggestion.value) {
                        window.location.href = 'php/competitionView.php?comp_id=' + field.comp_id;
                    }
                });
            }
        });
    });
});

$(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});