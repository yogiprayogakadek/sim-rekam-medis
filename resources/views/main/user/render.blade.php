{{-- Modal password --}}
<div id="password-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <form id="formUpdate">
                    <div class="form-group password with-validation">
                        <input type="text" id="user-id" name="user_id" class="form-control hidden">
                        <label class="col-sm-3 control-label mt-10" for="password">Password</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password"
                                    placeholder="Masukkan password baru" name="password">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-password"></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group re_password with-validation">
                        <label class="col-sm-3 control-label mt-10" for="re-password">Re Password</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" class="form-control" id="re-password"
                                    placeholder="Masukkan ulang password" name="re_password">
                                <div class="input-group-addon"><i class="icon-lock"></i></div>
                            </div>
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-re_password"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-outline btn-update-password mr-15">Simpan</button>
            </div>
        </div>
    </div>
</div>
{{-- End --}}

<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-tambah"> <span
                        class="btn-label"><i class="fa fa-plus white-icon"></i> </span><span class="btn-text">Tambah
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="table-wrap">
                    <div class="">
                        <table id="table" class="table table-hover display  pb-30">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="change-password"
                                                data-id="{{ $user->id }}" data-username="{{ $user->username }}"
                                                data-toggle="tooltip" title="Double click untuk mengubah password">
                                                {{ $user->username }}
                                        </td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->level }}</td>
                                        <td>{{ $user->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-icon-anim btn-square btn-sm btn-edit"
                                                    data-id="{{ $user->id }}"><i class="fa fa-pencil"></i></button>
                                                <button
                                                    class="btn btn-danger btn-icon-anim btn-square btn-sm btn-delete"
                                                    data-id="{{ $user->id }}"><i class="icon-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('#table').DataTable({
            responsive: true
        });

        $('.change-password').on('dblclick', function() {
            let username = $(this).data('username')
            let id = $(this).data('id')
            $('#password-modal').modal('show');
            $('#password-modal .modal-title').html('Update Password - <strong>' + username +
                '</strong>');

            // set id
            $('#password-modal #user-id').val(id)
        });

        $("body").on("click", ".btn-update-password", function(e) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            let form = $("#formUpdate")[0];
            let data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "/user/update-password",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $(".btn-update-password").html("Loading...").prop('disabled', true);
                },
                done: function() {
                    $(".btn-update-password").html("Simpan").prop('disabled', false);
                },
                success: function(response) {
                    $(".with-validation").removeClass("has-error has-danger");
                    Swal.fire(response.title, response.message, response.status);
                    if (response.status == "success") {
                        $('#password-modal').modal('hide');
                    }
                },
                error: function(error) {
                    let formName = [];
                    let errorName = [];

                    $.each($("#formUpdate").serializeArray(), function(i, field) {
                        formName.push(field.name.replace(/\[|\]/g, ""));
                    });
                    if (error.status == 422) {
                        if (error.responseJSON.errors) {
                            $.each(
                                error.responseJSON.errors,
                                function(key, value) {
                                    errorName.push(key);
                                    if ($("#password-modal ." + key).val() == "") {
                                        $("#password-modal ." + key).addClass(
                                            "has-error has-danger");
                                        $("#password-modal .error-" + key).html(value);
                                    }
                                }
                            );

                            $.each(formName, function(i, field) {
                                if ($.inArray(field, errorName) == -1) {
                                    $("#password-modal ." + field).removeClass(
                                        "has-error has-danger");
                                    console.log(field)
                                    $("#password-modal .error-" + field).html('');
                                } else {
                                    $("#password-modal ." + field).addClass(
                                        "has-error has-danger");
                                }
                            });
                        }
                    }
                    $(".btn-update-password").html("Simpan").prop('disabled', false);
                },
            });
        });
    });
</script>
