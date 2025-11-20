<!-- component -->
<!-- notificatoin box 1 --> 
<div class="notif1 hidden shadow-lg rounded-lg bg-white mx-auto m-8 p-4 notification-box">
    <div class="text-sm pb-2">
      	<h2 class='judul'>Notification Title</h2>
	      <span class="x float-right" onclick="close_notif1()">
	        <svg
	          class="fill-current text-gray-600"
	          xmlns="http://www.w3.org/2000/svg"
	          viewBox="0 0 24 24"
	          width="22"
	          height="22"
	        >
	          <path
	            class="heroicon-ui"
	            d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"
	          />
	        </svg>
	      </span>
    </div>
    <div class="konten text-sm text-gray-600  tracking-tight ">
      I will never close automatically. This is a purposely very very long
      description that has many many characters and words.
    </div>
  </div>

<script>
	function close_notif1(){
		document.querySelector('.notif1').classList.add('hidden');
	}	
	function open_notif1(judul,konten){
		document.querySelector('.notif1').classList.remove('hidden');
		document.querySelector('.notif1 .judul').innerHTML=judul;
		document.querySelector('.notif1 .konten').innerHTML=konten;
		setTimeout(function(){
			close_notif1();
		},3000);
	}	
</script>
<style>
 .notification-box {
    width:20rem;
   }
   .notif1 .judul{
   		font-weight: bold;
   		margin-bottom: 3px;
   }
   .notif1 .konten{
   	color:white;
   }
   .notif1 .x{
   	float: right;
    color: white;
    background: wheat;
    border-radius: 4px;
    margin-top: -22px;
    cursor: pointer;
   }
   .notif1{
	   	position: fixed;
	    top: 10px;
	    right: 10px;
	    background: rgba(0, 0, 0, 0.5);
	    color: white;
	    z-index: 99;
   }
</style>