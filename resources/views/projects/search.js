var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    $("#city_search").autocomplete({
        source: function (request, response) {
            // Fetch data
            $.ajax({
                url: "{{route('projects.getCities')}}",
                type: 'post',
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#city_search').val(ui.item.label); // display the selected text
            $('#cityid').val(ui.item.value); // save selected id to input
            return false;
        }
    });

});