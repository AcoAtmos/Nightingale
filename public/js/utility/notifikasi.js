

function notifikasi(fungsi,text){

    const toastBox = document.getElementById('toast_box');
    if (fungsi == 'sucsess'){
        let toast = document.createElement('div');
        toast.classList.add('toast');
        
        let p = document.createElement('p');
        p.innerHTML = `<i class="fa-solid fa-circle-check"></i> ${text}`;
        toast.appendChild(p);
        toastBox.appendChild(toast);

    }else if (fungsi == 'fail' ){
        let toast = document.createElement('div');
        toast.classList.add('toast');
        
        let p = document.createElement('p');
        p.innerHTML = `<i class="fa-solid fa-circle-xmark"></i> ${text}`;
        toast.appendChild(p);
        toastBox.appendChild(toast);
        toast.classList.add('fail');

    }else if (fungsi=='invalid'){
    let toast = document.createElement('div');
    toast.classList.add('toast');

    let p = document.createElement('p');
    p.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> ${text}`;
    toast.appendChild(p);
    toastBox.appendChild(toast);
    toast.classList.add('invalid')
    }

    setTimeout(() => {
        toastBox.removeChild(toastBox.firstChild);
    }, 5000);
}
window.notifikasi = notifikasi;