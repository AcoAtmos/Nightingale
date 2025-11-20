
document.addEventListener('DOMContentLoaded',function(){
	console.log('asdasdasd');
	list_pasien();
});


function list_pasien(){
	req_body={
		page:1,
		limit:20
	}

	fetch(`list_pasien.php`, {
	  method: 'POST',
	  headers: {
	    'Content-Type': 'application/json; charset=UTF-8'
	  },
	  body: JSON.stringify(req_body),
	}).then(response => {
		if (response.ok) {
		  	response.text().then(response => {
		  		let r=JSON.parse(response);
		  		let html='';
		  		console.log(r.data[2]);
		  		let no=0;
			    r.data.forEach(function(v,i){
			    	console.log(v.nama);
			    	no++;
			    	html+=`<tr class="text-gray-700 dark:text-gray-400" data-id=${v.id} >
                      <td class="px-4 py-3">${no}</td>
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="nama font-semibold">${v.nama}</p>
                            <p class="tgl_lahir text-xs text-gray-600 dark:text-gray-400" tgl-lahir="${v.tgl_lahir}">
                              ${hitung_umur(v.tgl_lahir)} tahun
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm no_telp">
                        ${v.no_telp}
                      </td>
                      <td class="jenis_kelamin px-4 py-3 text-sm">
                        ${v.jenis_kelamin}
                      </td>
                      <td class="px-4 py-3 text-sm">
                        ${format_tgl(v.tgl_daftar)}
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="alamat px-2 py-1 "
                        >
                          ${v.alamat}
                        </span>
                      </td>
                      
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button @click="openModal" onclick="edit_pasien(${v.id})"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                              ></path>
                            </svg>
                          </button>
                          <button onclick="delete_pasien(${v.id})"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </button>
                          
                        </div>
                      </td>
                    </tr>`;
			    });
				document.querySelector('table tbody.list-pasien').innerHTML=html;
		  	});
		}
	});
}

function reset_form(){
	document.querySelector('.form_tambah_pasien .pasien_id').value='';
	document.querySelector('.form_tambah_pasien .nama_pasien').value='';
	document.querySelector('div.form_tambah_pasien .tgl_lahir').value='';
	document.querySelector('div.form_tambah_pasien .no_telp').value='';
	document.querySelector('div.form_tambah_pasien .alamat').value='';
	document.querySelectorAll('div.form_tambah_pasien .jenis_kelamin').forEach(function(el){
			el.removeAttribute('checked');
		});
}

function edit_pasien(id){
	let nama=document.querySelector(`tbody.list-pasien tr[data-id='${id}'] td p.nama`).innerHTML;
	let no_telp=document.querySelector(`table > tbody tr[data-id='${id}']  td.no_telp`).innerHTML;
	let tgl_lahir=document.querySelector(`table > tbody tr[data-id='${id}']  td p.tgl_lahir`).getAttribute('tgl-lahir');
	let jenis_kelamin=document.querySelector(`table > tbody tr[data-id='${id}']  td.jenis_kelamin`).innerHTML;
	let alamat=document.querySelector(`table > tbody tr[data-id='${id}']  td span.alamat`).innerHTML;

	document.querySelector('div.form_tambah_pasien .nama_pasien').value=nama;
	document.querySelector('div.form_tambah_pasien .tgl_lahir').value=tgl_lahir;
	document.querySelector('div.form_tambah_pasien .no_telp').value=no_telp.trim();
	document.querySelector('div.form_tambah_pasien .alamat').value=alamat.trim();
	jenis_kelamin=jenis_kelamin.trim();
	console.log(jenis_kelamin);

	document.querySelector(`div.form_tambah_pasien .jenis_kelamin[value='${jenis_kelamin}']`).setAttribute('checked','checked');

	document.querySelector('div.form_tambah_pasien .pasien_id').value=id;
	// document.querySelectorAll('div.form_tambah_pasien .jenis_kelamin').forEach(function(el){
	// 	if(el.value==jenis_kelamin){
	// 		el.setAttribute('checked','checked');
	// 	}
	// });
}

function delete_pasien(id){
	if(confirm('Yakin ingin menghapus data ini?')){
		fetch(`delete_pasien.php?id=${id}`, {
			method: 'GET',
			headers: {
				'Content-Type': 'application/json; charset=UTF-8'
			}
		}).then(response => {
			if (response.ok) {
				response.text().then(response => {
					console.log(response);
					let r=JSON.parse(response);
					alert(r.message);

					list_pasien();
					// document.querySelector('.list-pasien tr[data-id="'+id+'"]').remove();
					//open_notif1('Notifkasi Master Pasien',response);
				});
			}
		});
	}
	console.log(id);
}

function format_tgl(tgl) {
	const date = new Date(tgl);
	const options = { day: '2-digit', month: 'long', year: 'numeric'};
	const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(date);
	return (formattedDate);
}

function hitung_umur(tgl_lahir) {
    
	if (!tgl_lahir) {
        throw new Error('Tanggal lahir harus diisi');
    }
    const lahir = new Date(tgl_lahir);
    if (isNaN(lahir.getTime())) {
        throw new Error('Format tanggal tidak valid. Gunakan format YYYY-MM-DD');
    }

    const sekarang = new Date();
    let tahun = sekarang.getFullYear() - lahir.getFullYear();
	return tahun;
 
}

function save_pasien(){

	//capture data
	let id=document.querySelector('.form_tambah_pasien .pasien_id').value;
	let nama=document.querySelector('.form_tambah_pasien .nama_pasien').value;
	let tgl_lahir=document.querySelector('.form_tambah_pasien .tgl_lahir').value;
	let no_telp =document.querySelector('.form_tambah_pasien .no_telp').value;
	let alamat = document.querySelector('.form_tambah_pasien .alamat').value;
	// let no_wa = document.querySelector('.form_tambah_pasien #no_wa').value;
	// let no_wa = document.querySelector('#no_wa').value;
	let no_whatsapp = no_wa.value;

	let jenis_kelamin;
	document.querySelectorAll('.form_tambah_pasien .jenis_kelamin').forEach(function(el){
	    if(el.checked==true){
	    	jenis_kelamin=el.value;
		} 
	});
	
	// validasi data
	let err=false;
	let msg='';
	if(nama=='' || nama==undefined || nama==null){
		err=true;
		msg+=' Nama wajib di isi';
	}
	if(tgl_lahir=='' || tgl_lahir==undefined || tgl_lahir==null){
		err=true;
		msg+=' Tgl Lahir wajib di isi';
	}
	if(no_telp=='' || no_telp==undefined || no_telp==null){
		err=true;
		msg+=' No Telp wajib di isi';
	}
	if (no_telp.length>=14) {
		err=true;
		msg+=' No telp max 14 karakter';
	}
	if (alamat=='') {
		err=true;
		msg+=' Alamat Wajib diisi';
	}
	if(jenis_kelamin=='' || jenis_kelamin==undefined || jenis_kelamin==null){
		err=true;
		msg+=' Jenis kelamin wajib di isi';
	}

	if (err) {
		alert(msg);
		return;
	}

	//hit backend/api
	req_body={
		id:id,
		nama:nama,
		tgl_lahir:tgl_lahir,
		no_telp:no_telp,
		jenis_kelamin:jenis_kelamin,
		alamat:alamat
	}

	fetch(`save_pasien.php`, {
	  method: 'POST',
	  headers: {
	    'Content-Type': 'application/json; charset=UTF-8'
	  },
	  body: JSON.stringify(req_body),
	}).then(response => {
		if (response.ok) {
		  	response.text().then(response => {
			    console.log(response);
			    open_notif1('Notifkasi Master Pasien',response);
			    document.querySelector(".modal1 .cancel_btn").click();
		  	});
		}
	});
	// console.log(`${nama} ${tgl_lahir} ${no_telp} ${jenis_kelamin} ${no_whatsapp}`);

}
