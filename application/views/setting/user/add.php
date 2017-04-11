<!-- css/javascript -->
<style type="text/css">
    .ibox-title{
        background-color: #ee6e73;
        color: white !important;
    }
</style>

<script type="text/javascript">
    winload(function(){
        // disable tombol tambah
        $('#btnTambah').addClass('disabled');
        // alert auto close
        window.setTimeout(function() {
            $(".alert").fadeTo(1500, 0).slideUp(500, function(){
                $(this).remove(); 
                });
        }, 5000);
    });

    function f_org() {
        var hakakses = $("#hakakses").val();
        if (hakakses != "none") {
            _ambil(hakakses);
        } else {
            $("#organisasi").html("");
        }
    }

    function _ambil(hakakses) {
        if (hakakses == "ADMIN") {
            _admin();
        } else if (hakakses == "OPERATORKECAMATAN") {
            _opkecamatan();
        } else if (hakakses == "OPERATORKABUPATEN") {
            _admin();
        } else if (hakakses == "KEPALADESA" || hakakses == "SEKDES" || hakakses == "OPERATORDESA") {
            _kepaladesa();
        }
    }

    function _admin() {
        $("#organisasi").html("");
        var allKecamatan = <?php echo json_encode($admin_org); ?>

        for (var i = 0; i < allKecamatan.length; i++) {
            var obj = allKecamatan[i];
            $("#organisasi").append("<tr><td width=\"30\"><input type=\"checkbox\" value=\"" + obj.KODEURUSAN + "." + obj.KODESUBURUSAN + "." + obj.KODEORGANISASI + "." + obj.KODEDESA + "\" class=\"cheked_all\" name=\"desa[]\" checked></td><td>" + obj.KODEURUSAN + "." + obj.KODESUBURUSAN + "." + obj.KODEORGANISASI + " - " + obj.URAI + "</td></tr>");

            // console.log(obj.URAI);
        }
    }

    function _opkabupaten() {
        $("#organisasi").html("");

        $("#organisasi").append("<tr><td></td><td>Belum ada data nya</td></tr>");
    }

    function _opkecamatan() {
        $("#organisasi").html("");
        var allKecamatan = <?php echo json_encode($admin_org); ?>

        for (var i = 0; i < allKecamatan.length; i++) {
            var obj = allKecamatan[i];
            $("#organisasi").append("<tr><td width=\"30\"><input type=\"checkbox\" value=\"" + obj.KODEURUSAN + "." + obj.KODESUBURUSAN + "." + obj.KODEORGANISASI + "." + obj.KODEDESA + "\" class=\"cheked_all\" name=\"desa[]\" ></td><td>" + obj.KODEURUSAN + "." + obj.KODESUBURUSAN + "." + obj.KODEORGANISASI + " - " + obj.URAI + "</td></tr>");

            // console.log(obj.URAI);
        }
    }

    function _kepaladesa() {
        $("#organisasi").html("");
        var allDesa = <?php echo json_encode($alldesa_org); ?>

        for (var i = 0; i < allDesa.length; i++) {
            var obj = allDesa[i];
            $("#organisasi").append("<tr><td width=\"30\"><input type=\"checkbox\" value=\"" + obj.KODEURUSAN + "." + obj.KODESUBURUSAN + "." + obj.KODEORGANISASI + "." + obj.KODEDESA + "\" class=\"cheked_all\" name=\"desa[]\" ></td><td>" + obj.KODEURUSAN + "." + obj.KODESUBURUSAN + "." + obj.KODEORGANISASI + "." + obj.KODEDESA + " - " + obj.URAI + "</td></tr>");
            // console.log(obj.URAI);
        }       
    }

    function toggle(argument) {
        checkbox = $(".cheked_all");
        for (var i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = argument.checked;
        }
    }

</script>
<!-- form tambah user -->
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title ">
                <h5><span class="fa fa-user-plus"></span> Tambah Pengguna</h5>
            </div>
            <div class="ibox-content border-bottom highlight-bas">
                <div align="right">
                    <div class="btn-group">
                        <a href="<?php echo base_url('setting/user') ?>" class="btn btn-info btn-xs" type="button"><span class="glyphicon glyphicon-th-list"></span> Daftar</a>
                        <a href="<?php echo base_url();?>setting/user/add" class="btn btn-success btn-xs" type="button" id="btnTambah"><span class="fa fa-plus"></span> Tambah</a>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?php echo $this->session->flashdata('exist'); ?>
                <?php echo validation_errors( "<div class='alert alert-danger alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>×</button>", "</div>"); ?>
                <?php echo form_open( 'setting/user/add',array( 'class'=> 'form-horizontal', 'id' => 'validform')) ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-3">
                        <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo set_value('username'); ?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-3">
                        <input type="Password" name="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-3">
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo set_value('nama_lengkap'); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Hak Akses</label>
                    <div class="col-sm-3">
                        <select class="form-control m-b" name="hakakses" id="hakakses" onchange="f_org()">
                            <option value="none">-- PILIH HAK AKSES --</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="OPERATORKABUPATEN">OPERATORKABUPATEN</option>
                            <option value="OPERATORKECAMATAN">OPERATORKECAMATAN</option>
                            <option value="KEPALADESA">KEPALADESA</option>
                            <option value="SEKDES">SEKDES</option>
                            <option value="OPERATORDESA">OPERATORDESA </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp</label>
                    <div class="col-sm-8">
                        <table class="table table-striped table-hover table-bordered mg-y-b-0">
                            <thead>
                                <th width="30">
                                    <input type="checkbox" onClick="toggle(this)">
                                </th>
                                <th>Kecamatan / Desa</th>
                            </thead>
                        </table>
                        <div class="bodycontainer scrollable">
                            <table class="table table-hover table-striped table-condensed table-scrollable">
                                <tbody id="organisasi">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-danger dim" type="button" onclick="history.back()"><span class="fa fa-times"></span> Batal</button>
                        <button class="btn btn-primary dim" type="submit"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

