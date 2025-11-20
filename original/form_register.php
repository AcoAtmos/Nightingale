<html>
    <head>
    <script>

        function save_user(){
            let nama = document.getElementById('#nama ').value
            let user_login = document.getElementById('#user_login ').value
            let user_pass  = document.getElementById('#user_pass ').value
            let no_wa  = document.getElementById('#no_wa ').value
            let email =  document.getElementById('#email ').value


            let payload ={
                user_login : u,
                user_pass : ,
                no_wa : ,
                email : , 
                nama :
            }
            
            // butuh validasi sebelum di kirim
            fetch(`save_user.php`, {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json; charset=UTF-8'
            },
            body: JSON.stringyfy(payload),
            }).then(response =>{
            if (response.ok ){
                response.text().then(response =>{
                    let r = parse(response);
                    alert(response);
                })
            }
            })


        }
        document.addEventListener('DOMContentLoad', function(){
            document.getElementById('reg-btn').addEventListener('click',function(){ alert('test')})
        } )
    </script>
    </head>
    <body>
        <div>
            <input type="text" id="nama" placeholder="nama lengkap">
            <input type="text" id="user_login" placeholder="username">
            <input type="password" id="user_pass" placeholder="Password">
            <input type="text" id="email" placeholder="Email">
            <input type="text" id="no_wa" placeholder="No wa">
            <input type="submit" value="Register" id="reg_btn">

        </div>
    </body>
</html>