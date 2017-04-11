<input type="hidden" name="NO_SPP"/>
<input type="hidden" name="TAHUN"/>
<!-- organisasi -->
<input type="hidden" name="KODEURUSAN" class="spp-org"/>
<input type="hidden" name="KODESUBURUSAN" class="spp-org"/>
<input type="hidden" name="KODEORGANISASI" class="spp-org"/>
<input type="hidden" name="KODEDESA" class="spp-org"/>
<!-- kegiatan -->
<input type="hidden" name="KODEBIDANG" class="spp-prog"/>
<input type="hidden" name="KODEPROGRAM" class="spp-prog"/>
<input type="hidden" name="KODEKEGIATAN" class="spp-prog"/>

<div class="row">
	<div class="col-md-6"><?php $this->load->view('spp/spp/ubah/form1-kanan') ?></div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama perusahaan:</label>
			<input name="NAMA_PERUSAHAAN" class="form-control"/>
		</div>
		<div class="form-group">
			<label>Alamat perusahaan:</label>
			<input name="ALAMAT_PERUSAHAAN" class="form-control"/>
		</div>
		<div class="form-group">
			<label>No. rekening perusahaan:</label>
			<input name="NOREK_PERUSAHAAN" class="form-control"/>
		</div>

		<div class="hr-line-dashed"></div>

		<p class="text-right"><button type="button" onclick="spp_btn_next1()" class="btn btn-sm btn-success bd-rad-0">Selanjutnya &rsaquo;</button></p>

	</div>
</div>

<script>

function spp_btn_next1() {
	if ($form_active_tab.get(0).checkValidity()) {
		$form_nav_link.get(1).click();
	} else {
		$('#form_btn_submit').trigger('click');
	}
}

// SET INPUT VALUE
winload(function() {
	$( $form_nav_tab.get(0).elements ).each(function() {
		var n = $(this).prop('name') || ''; if (n === '') return;
		var v = data.spp[n] || ''; if (v === '') return;

		if (/^TGL/.test(n)) {
			this.value = v.split(' ')[0];
			return;
		}

		this.value = v;
		if (/^(BULAN)/.test(n)) $(this).trigger('change');
	});
});

// RINCIAN-HANDLE
winload(function() {
	$( $form[0].TGL_SPP ).on('change', function() {
		_ready_rician();
	});

	$('#spp_inp_keg').trigger('change');
});
</script>