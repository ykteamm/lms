$(document).ready(function () {

    $('#region_id').on('change', function () {
        var regionId = this.value;
        $('#district_id').html('');
        $.ajax({
            url:'/users-region',
            data: {
                region_id: regionId,
            },
            type: 'GET',
            success: function (data) {
                // console.log('region')
                // console.log(data)
                $('#district_id').html('<option value="">Select District</option>');
                $.each(data, function (key, value) {
                    $('#district_id').append('<option  value="'+value.id +'">'+value.name+'</option>');
                });
                // $('#kvartira').html('<option value="">Select Kvartira</option>');
            },
            error: function (xhr, status, error) {
                console.log(error);
                // console.log(data)
            },
        });
    });

    $('#rol_id').on('change', function () {
        var rol_id = this.value;
        // console.log(rol_id)
        $('#tg_user_id').html('');
        $.ajax({
            url:'/admin/elchi-role',
            data: {
                rol_id: rol_id,
            },
            type: 'GET',
            success: function (data) {
                // console.log('region')
                console.log(data)
                $('#tg_user_id').html('<option value="">Select Users</option>');
                $.each(data, function (key, value) {
                    // console.log(data)
                    $('#tg_user_id').append('<option  value="'+value.user_id +'">'+value.user_first_name + ' ' + value.user_last_name+'</option>');
                });
                // $('#kvartira').html('<option value="">Select Kvartira</option>');
            },
            error: function (xhr, status, error) {
                console.log(error);
                // console.log(data)
            },
        });
    });


    $('#register').on('click', function (event) {
        var regionValue = $('#region_id').val();
        var districtValue = $('#district_id').val();

        if (!regionValue) {
            alert('Iltimos, viloyatni tanlang.');
            event.preventDefault();
        } else if (!districtValue) {
            alert('Iltimos, shaharni tanlang.');
            event.preventDefault();
        }
    });




});

