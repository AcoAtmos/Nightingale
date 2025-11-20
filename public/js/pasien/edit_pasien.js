
function edit_pasien(id){
    console.log('sdfsdf')
	let nama_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"] td p.nama`).innerHTML;
	let no_telp_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"]  td.no_telp`).innerHTML;
	let jenis_kelamin=document.querySelector(`tbody.list_pasien tr[data_id="${id}"] td span.jenis_kelamin`).innerHTML;
	let tanggal_lahir_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"]  td.tanggal_lahir`).innerHTML;
	let alamat_pasien=document.querySelector(`tbody.list_pasien tr[data_id="${id}"]  td.alamat`).innerHTML;

    console.log(nama_pasien)
    
	document.querySelector('div.form_pasien_baru .nama_pasien').value=nama_pasien;
	document.querySelector('div.form_pasien_baru .no_telp_pasien').value=no_telp_pasien.trim();
    document.querySelector('div.form_pasien_baru .tanggal_lahir_pasien').value=tanggal_lahir_pasien.trim();
	document.querySelector('div.form_pasien_baru .alamat_pasien').value=alamat_pasien.trim();
	jenis_kelamin=jenis_kelamin.trim();
	document.querySelector(`div.form_pasien_baru .jenis_kelamin[value='${jenis_kelamin}']`).setAttribute('checked','checked');

	document.querySelector('div.form_pasien_baru .pasien_id').value=id;
	// document.querySelectorAll('div.form_tambah_pasien .jenis_kelamin').forEach(function(el){
	// 	if(el.value==jenis_kelamin){
	// 		el.setAttribute('checked','checked');
	// 	}
	// });
}
window.edit_pasien = edit_pasien;