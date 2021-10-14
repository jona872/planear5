<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $('#pList').change(function() {

            $.ajax({
                cache: false,
                type: "GET",
                async: true,
                url: "{{ route('relevamientos.getTools') }}?id=" + $(this).val(),
                contentType: "application/json; charset=ytf-8",
                dataType: "json",
                processData: true,
                success: function(result) {
                    console.log(result.value);
                    var model = $('#tList');
                    $.each(result.value, function(index, element) {
                        model.append("<option value='" + element.id + "'>" + element.tool_name + "</option>");
                        model.append("<input hidden name='tName' value='" + element.tool_name + "'/>");
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert(textStatus + ':' + errorThrown);
                }
            });
        });


        $('#pList2').change(function() {

            $.ajax({
                cache: false,
                type: "GET",
                async: true,
                url: "{{ route('relevamientos.getTools') }}?id=" + $(this).val(),
                contentType: "application/json; charset=ytf-8",
                dataType: "json",
                processData: true,
                success: function(result) {
                    console.log(result.value);
                    var model = $('#tList2');
                    $.each(result.value, function(index, element) {
                        model.append("<option value='" + element.id + "'>" + element.tool_name + "</option>");
                        model.append("<input hidden name='tName2' value='" + element.tool_name + "'/>");
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert(textStatus + ':' + errorThrown);
                }
            });
        });




    });
</script>