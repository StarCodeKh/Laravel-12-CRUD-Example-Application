<script>
    $(document).ready(function() {
        const table = $('#userListing').DataTable({
            lengthMenu: [
                [10, 25, 50, 100, 150],
                [10, 25, 50, 100, 150]
            ],
            buttons: ['pageLength'],
            pageLength: 10,
            order: [[5, 'desc']],
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get-data-user.listing') }}",
            },
            columns: [
                { data: 'action', orderable: false, searchable: false },
                { data: 'id' },
                { data: 'name' },
                { data: 'user_id' },
                { data: 'email' },
                { data: 'position' },
                { data: 'phone_number' },
                { data: 'join_date' },
                { data: 'last_login' },
                { data: 'role_name' },
                { data: 'department' },
                { data: 'status' },
            ],
            columnDefs: [
                { targets: 0, className: 'th-active-fixed' }
            ]
        });
    });
</script>

<script>
    $(document).on('click', '.userUpdate', function() {
        const _this = $(this).closest('tr');
        // Populate form fields with current user data
        $('#e_user_id').val(_this.find('.user_id').text());
        $('#e_name').val(_this.find('.name').text());
        $('#e_email').val(_this.find('.email').text());
        $('#e_role_name').val(_this.find('.role_name').text()).change();
        $('#e_position').val(_this.find('.position').text()).change();
        $('#e_phone_number').val(_this.find('.phone_number').text());
        $('#e_department').val(_this.find('.department').text());
        $('#e_status').val(_this.find('.status').text()).change();
        $('#e_image-circle').text(_this.find('.image-circle').text());

        const imgName = _this.find('.image-circle').data('image-circle');
        if (imgName) {
            $('#e_image-circle-preview').attr('src', '/assets/images/' + imgName).removeClass('d-none');
            $('#e_image-circle').addClass('d-none');
        } else {
            $('#e_image-circle').removeClass('d-none');
            $('#e_image-circle-preview').addClass('d-none');
        }
        $('#e_hidden_image').val(imgName);
    });
</script>

<script>
    $(document).on('click', '.userView', function() {
        const _this = $(this).closest('tr');
        // Populate form fields with current user data
        $('#v_user_id').val(_this.find('.user_id').text());
        $('#v_name').val(_this.find('.name').text());
        $('#v_email').val(_this.find('.email').text());
        $('#v_role_name').val(_this.find('.role_name').text()).change();
        $('#v_position').val(_this.find('.position').text()).change();
        $('#v_phone_number').val(_this.find('.phone_number').text());
        $('#v_department').val(_this.find('.department').text());
        $('#v_status').val(_this.find('.status').text()).change();
        $('#v_image-circle').text(_this.find('.image-circle').text());

        const imgName = _this.find('.image-circle').data('image-circle');
        if (imgName) {
            $('#v_image-circle-preview').attr('src', '/assets/images/' + imgName).removeClass('d-none');
            $('#v_image-circle').addClass('d-none');
        } else {
            $('#v_image-circle').removeClass('d-none');
            $('#v_image-circle-preview').addClass('d-none');
        }
        $('#v_hidden_image').val(imgName);
    });
</script>

<script>
    $(document).on('click', '.userDelete', function() {
        const _this = $(this).closest('tr');
        
        // Populate the modal with current user data
        $('#d_user_id').val(_this.find('.user_id').text());
        $('#d_name').text(_this.find('.name').text());
        $('#d_image-circle').val(_this.find('.image-circle').data('image-circle'));
    });
</script>

<script>
    $(function () {
        $('#e_image_upload_trigger').click(() => $('#e_image_upload').click());
        $('#e_image_upload').change(function () {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => $('#e_image-circle-preview').attr('src', e.target.result).removeClass('d-none');
                reader.readAsDataURL(file);
                $('#e_image-circle').addClass('d-none');
            } else {
                alert('Please upload a valid image file.');
            }
        });
    });
</script>