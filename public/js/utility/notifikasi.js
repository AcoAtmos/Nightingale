
//fungsi menyediakan css 
function notifikasi_css(){
    const style = document.createElement('style');
    style.id = 'notifikasi_style';
    style.textContent =`
            #toast_box {
            position: fixed;
            bottom: 3rem;
            right: 0;
            display: flex;
            align-items: flex-end;
            flex-direction: column;
            overflow: hidden;
            padding: 15px;
        }
        .toast{
            position: relative;
            width: 20rem;
            height: 3rem;
            background-color: whitesmoke;
            font-weight: 500;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.2);

            display: flex;
            align-items: center;
            justify-content: flex-start;


            padding: 1rem;
            border-radius: 5px;
            margin: 0.5rem;

        }
        .toast i {
            margin: 0 15px;
            font-size: 1.3rem;
            color: green;
            text-align: center;
        }
        .fail i{
            color: red;
        }
        .invalid i{
            color: yellow;
        }

        .toast::after{
            content: '';
            width: 100%;
            height: 5px;
            position: absolute;
            bottom: 0;
            left: 0;
            background-color: green;
            animation: anim 3s linear forwards;
            border-radius: 0 0 5px 5px;
        }
        .toast.fail::after{
            background-color: red;
        }
        .toast.invalid::after{
            background-color: yellow;
        }

        @keyframes anim{
            100%{
                width: 0;
            }
        }`;
    document.head.appendChild(style);
}
export function notifikasi(type, text) {

    notifikasi_css(); // pasang CSS global

    // Font Awesome
    if (!document.getElementById("fa-kit")) {
        const script = document.createElement("script");
        script.id = "fa-kit";
        script.src = "https://kit.fontawesome.com/f179667565.js";
        script.crossOrigin = "anonymous";
        document.head.appendChild(script);
    }

    // container
    let toastBox = document.getElementById("toast_box");
    if (!toastBox) {
        toastBox = document.createElement("div");
        toastBox.id = "toast_box";
        document.body.appendChild(toastBox);
    }

    // create toast
    const toast = document.createElement("div");
    toast.className = "toast";
    toast.style.setProperty("--bar-color",
        type === "success" ? "green" :
        type === "fail"    ? "red"   :
        "orange"
    );

    const p = document.createElement("p");
    p.innerHTML =
        type === "success" ? `<i class="fa-solid fa-circle-check"></i> ${text}` :
        type === "fail" ? `<i class="fa-solid fa-circle-xmark"></i> ${text}` :
        `<i class="fa-solid fa-circle-exclamation"></i> ${text}`;

    toast.appendChild(p);
    toastBox.appendChild(toast);

    // Auto remove
    setTimeout(() => toast.remove(), 3000);
}

window.notifikasi = notifikasi;