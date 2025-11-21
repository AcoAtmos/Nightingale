
function reset_form(){
    document.querySelector('div.form_pasien_baru .nama_pasien').value='';
	document.querySelector('div.form_pasien_baru .no_telp_pasien').value=''
    document.querySelector('div.form_pasien_baru .tanggal_lahir_pasien').value='';
	document.querySelector('div.form_pasien_baru .alamat_pasien').value='';

	document.querySelector('div.form_pasien_baru .pasien_id').value='';
	document.querySelectorAll('div.form_pasien_baru .jenis_kelamin').forEach(function(el){
			el.removeAttribute('checked');
		});
}
window.reset_form = reset_form;