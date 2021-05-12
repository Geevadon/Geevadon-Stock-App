{{-- Show User Delete Confirm Modal --}}
<script type="text/javascript">

    $(document).ready (function () {

        $('#delete_user').click (function () {

            $('#deleteUserModal').modal ('show');
            return false;
        })

        $('#ok_button_user_delete').click (function () {
            $('#delete-user-form').submit ();
        });
    })
</script>

{{-- Show Delete Confirm Modal --}}
<script type="text/javascript">

    $(document).ready (function () {
        var table = $('#dataTable');
        var did;

        table.on ('click', '.delete', function () {
            did = $(this).attr ('did');

            $('#deleteModal').modal ('show');
            return false;
        })

        $('#ok_button_delete').click (function () {
            $('#delete-form-'+did).submit ();
        });
    })
</script>

{{-- Show Pay Confirm Modal --}}
<script type="text/javascript">

    $(document).ready (function () {
        var table = $('#dataTable');
        var pid;

        table.on ('click', '.pay', function () {
            pid = $(this).attr ('pid');

            $('#payModal').modal ('show');
            return false;
        })

        $('#ok_button_pay').click (function () {
            $('#pay-form-'+pid).submit ();
        });
    })
</script>

{{-- Show Trash Confirm Modal --}}
<script type="text/javascript">

    $(document).ready (function () {
        var table = $('#dataTable');
        var tid;

        table.on ('click', '.trash', function () {
            tid = $(this).attr ('tid');

            $('#trashModal').modal ('show');
            return false;
        })

        $('#ok_button_trash').click (function () {
            $('#trash-form-'+tid).submit ();
        });
    })

</script>

{{-- Show Clear Checkout Confirm Modal --}}
<script type="text/javascript">

    // $(document).ready (function () {

    //     $('body').on ('click', '.clear', function () {

    //         $('#clearModal').modal ('show');
    //         return false;

    //     })

    //     $('#ok_button_clear').click (function () {
    //         $('#clear-form').submit ();
    //     });
    // })
</script>
