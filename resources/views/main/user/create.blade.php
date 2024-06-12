<div class="col-sm-12">
    <div class="panel panel-default card-view">
        <div class="panel-heading">
            <div class="pull-right">
                <button class="btn btn-primary btn-rounded btn-lable-wrap left-label btn-data"> <span class="btn-label"><i
                            class="fa fa-arrow-left white-icon"></i> </span><span class="btn-text">List
                        Data</span></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="form-wrap">
                    <form id="formAdd">
                        <div class="form-group mb-0 mb-15 with-validation username" id="username-group">
                            <label class="control-label mb-10 " for="username">Nama Pengguna</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="masukkan nama pengguna">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-username"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group mb-0 mb-15 with-validation nama" id="nama-group">
                            <label class="control-label mb-10 " for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                placeholder="masukkan nama lengkap">
                            <div class="help-block with-errors error-message">
                                <ul class="list-unstyled">
                                    <li class="error-nama"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group mb-0 mb-15 with-validation password" id="password-group">
                            <label class="control-label mb-10 " for="password">Kata Sandi</label> <small>(kata sandi
                                bawaan)</small>
                            <input type="text" id="password" name="password" class="form-control"
                                placeholder="masukkan kata sandi" value="12345678" disabled>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-success btn-anim btn-save" type="button"><i
                                    class="icon-rocket"></i><span class="btn-text">Simpan</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
