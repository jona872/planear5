<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function updateUser(id, val) {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        console.log("id:" + id + " val:" + val);

        $.ajax({
            cache: false,
            type: "GET",
            async: true,
            url: "{{ route('admin-panel.setAdmin') }}?id=" + id+"&val="+val,
            contentType: "application/json; charset=ytf-8",
            dataType: "json",
            processData: true,
            success: function(result) {
                console.log(result.message);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(textStatus + ':' + errorThrown);
            }
        });

    }

    function switched(event) {
        if (event.checked) {
            //console.log("CHECKED");
            console.log(event.id);
            updateUser(event.id, event.checked);
        } else {
            //console.log("NOT CHECKED");
            console.log(event.id);
            updateUser(event.id, event.checked);
        }

    }
    $(document).ready(function() {
        console.log("Admin Panel");
    });
</script>