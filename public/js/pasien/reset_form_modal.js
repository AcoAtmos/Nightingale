
function reset_form(){
    document.querySelector('div.form_pasien_baru .nama_pasien').value=nama_pasien;
	document.querySelector('div.form_pasien_baru .no_telp_pasien').value=no_telp_pasien.trim();
    document.querySelector('div.form_pasien_baru .tanggal_lahir_pasien').value=tanggal_lahir_pasien.trim();
	document.querySelector('div.form_pasien_baru .alamat_pasien').value=alamat_pasien.trim();

	document.querySelector('div.form_pasien_baru .pasien_id').value='';
	document.querySelectorAll('div.form_pasien_baru .jenis_kelamin').forEach(function(el){
			el.removeAttribute('checked');
		});
}