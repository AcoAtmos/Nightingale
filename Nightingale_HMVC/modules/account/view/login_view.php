<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <form id="loginForm" class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm space-y-4">
    <h1 class="text-xl font-semibold text-center text-gray-700">Login</h1>

    <div>
      <label class="block text-sm font-medium text-gray-600">Username</label>
      <input
        type="text"
        id="username"
        required
        class="mt-1 w-full border px-3 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
        placeholder="Masukkan username"
      />
    </div>

    <div>
      <label class="block text-sm font-medium text-gray-600">Password</label>
      <input
        type="password"
        id="pass"
        required
        class="mt-1 w-full border px-3 py-2 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
        placeholder="Masukkan password"
      />
    </div>

    <button
      type="submit"
      class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition"
    >
      Masuk
    </button>
  </form>

  <script>
    // menangkap data form saat login
    document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault(); // mencegah reload

      let username = document.getElementById("username").value.trim();
      let pass = document.getElementById("pass").value.trim();

      // contoh alert, nanti bisa ganti ke fetch() backend
      alert("Data terkirim:\nUsername: " + username + "\nPassword: " + pass);
      console.log({username, pass});
      //   jika mau pakai fetch:
        fetch("index.php?module=login_proses", {
          method: "POST",
          headers: {"Content-Type": "application/json"},
          body: JSON.stringify({username, pass})
        })
        .then(res => res.json())
        .then(data => {
          console.log(data); // cek data response

          if (data.status === 'success') {
            window.location.href = "index.php?module=pasien_view";
          } else {
            alert(data.message);
          }
        })
        .catch(error => console.error(error));

    });
  </script>

</body>
</html>
