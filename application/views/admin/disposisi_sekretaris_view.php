<div class="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Data Disposisi Surat</h1>
		</div>
	</div>
    <?php 
        $notif = $this->session->flashdata('notif');
        if ($notif != NULL) {
            echo '
                <div class="alert alert-info">'.$notif.'</div>
            ';
        }
    ?>
	<div class="row">
		<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add"><span class="fa fa-plus"></span> Tambah Disposisi</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PENGIRIM</th>
                                    <th>TUJUAN</th>
                                    <th>TGL.DISPOSISI</th>
                                    <th>KETERANGAN</th>
                                    <th>AKSI</th>
                                    <!-- <th>TUJUAN</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    foreach ($data_disposisi as $disposisi) {
                                        echo '
                                            <tr>
                                                <td>'.++$no.'</td>
                                                <td>'.$disposisi->nama_jabatan.'</td>
                                                <td>'.$disposisi->nama_pegawai.'</td>
                                                <td>'.$disposisi->tgl_disposisi.'</td>
                                                <td>'.$disposisi->keterangan.'</td>
                                                <td>
                                                    <a href="'.base_url('uploads/'.$disposisi->file_surat).'" class="btn btn-info btn-sm" target="_blank">Lihat</a>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                    /*foreach ($data_penerima as $penerima) {
                                        echo '
                                                <td>'.$penerima->nama.'</td>
                                            </tr>
                                        ';
                                    }*/
                                ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
	</div>
</div>
<!--  MODAL tambah surat -->
    <div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modal_addLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('index.php/surat/tambah_disposisi/'.$this->uri->segment(3)) ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_addLabel">Tambah Surat Masuk</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tujuan Unit</label>
                            <select class="form-control" name="tujuan_unit" onchange="get_pegawai_by_jabatan(this.value)">
                                <option value="">-- Pilih Tujuan Unit --</option>
                                <?php
                                    foreach ($jabatan as $jabatannya) {
                                        if($jabatannya->id_jabatan != $this->session->userdata('id_jabatan') && $jabatannya->id_jabatan > $this->session->userdata('id_jabatan')){
                                            echo '
                                                <option value="'.$jabatannya->id_jabatan.'">'.$jabatannya->nama_jabatan.'</option>
                                            ';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tujuan Pegawai</label>
                            <select class="form-control" name="tujuan_pegawai" id="tujuan_pegawai">
                                <option value="">-- Pilih Nama Pegawai --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<script type="text/javascript">
    function get_pegawai_by_jabatan(id_jabatan) {
        $('#tujuan_pegawai').empty();
        $.getJSON('<?php echo base_url(); ?>index.php/surat/get_pegawai_by_jabatan/'+id_jabatan,function(data){
            $.each(data, function(index, value){
                $('#tujuan_pegawai').append('<option value="'+value.id_pegawai+'">'+value.nama_pegawai+'</option>');
            })
        });
    }
</script>