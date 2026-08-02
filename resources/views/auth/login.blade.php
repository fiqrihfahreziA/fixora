<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - FixoraV2</title>
<link rel="icon" href="{{ asset('gambar/rsmz.png') }}" type="image/png">

<style>
/* Font dan Reset */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body, html {
    height: 100%;
    background: linear-gradient(270deg, #4f46e5, #06b6d4, #10b981, #f59e0b);
    background-size: 800% 800%;
    animation: gradientBG 15s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Animasi Gradient */
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Container Login */
.login-container {
    background: rgba(255, 255, 255, 0.95);
    padding: 50px 35px;
    width: 400px;
    border-radius: 20px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.2);
    animation: fadeIn 0.8s ease forwards;
    text-align: center;
}

/* Animasi muncul */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(-20px);}
    to {opacity: 1; transform: translateY(0);}
}

.login-container h1 {
    font-size: 28px;
    color: #1f2937;
    margin-bottom: 5px;
    font-weight: 700;
}

.login-container p.subtitle {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 25px;
}

/* Input Group */
.input-group {
    position: relative;
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #374151;
    font-weight: 500;
}

.input-group input {
    width: 100%;
    padding: 12px 40px 12px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    transition: 0.3s;
}

.input-group input:focus {
    border-color: #4f46e5;
    outline: none;
}

/* Icon di input */
.input-group .icon {
    position: absolute;
    right: 12px;
    top: 36px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6b7280;
}

/* Tombol Login */
button {
    width: 100%;
    padding: 14px;
    background: #4f46e5;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #3730a3;
}

/* Footer */
.footer {
    text-align: center;
    margin-top: 20px;
    font-size: 12px;
    color: #6b7280;
}

/* Show/hide password */
.show-pass {
    position: absolute;
    right: 12px;
    top: 36px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 14px;
    color: #4b5563;
}

/* Error messages */
.input-error {
    color: #dc2626;
    font-size: 12px;
    margin-top: 4px;
}
.login-header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px; /* jarak antara logo dan teks */
    margin-bottom: 8px;
}

.login-header img.logo {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

/* .login-header h1 {
    font-size: 32px;
    color: #1f2937;
    font-weight: 700;
    text-transform: uppercase;
} */

.login-header h1 {
    font-size: 32px;
    font-weight: 600; /* lebih ringan dari 700 */
    background: linear-gradient(90deg, #4f46e5, #10b981); /* gradient warna ungu ke hijau */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; /* membuat gradient muncul di teks */
    text-align: center;
    letter-spacing: 1px; /* jarak antar huruf lebih rapi */
    margin: 0 10px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.subtitle {
    font-size: 14px;
    color: #2563eb; /* biru RSMZ agar terasa identitas RS */
    margin-bottom: 25px;
}

</style>
</head>
<body>

<div class="login-container">
<div class="login-header">
    <img src="{{ asset('gambar/rsmz.png') }}" alt="Logo RSMZ" class="logo left-logo">
    <h1>FixoraV2</h1>
    <!-- <img src="{{ asset('gambar/logoi.png') }}" alt="Logo Aplikasi" class="logo right-logo"> -->
</div>
<p class="subtitle">Sistem Perbaikan dan Permintaan Barang RSMZ</p>


    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autofocus>
            <span class="icon">📧</span>
            <x-input-error :messages="$errors->get('email')" class="input-error" />
        </div>

        <!-- Password -->
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span class="show-pass" onclick="togglePassword()">👁️</span>
            <x-input-error :messages="$errors->get('password')" class="input-error" />
        </div>

        <!-- Remember Me -->
        <div style="margin-bottom:20px; text-align:left;">
            <label>
                <input type="checkbox" name="remember" style="margin-right:6px;">
                Remember me
            </label>
        </div>

        <!-- Button -->
        <button type="submit" id="loginBtn">Login</button>

    </form>

    <div class="footer">SIMRS RSMZ 2026</div>
</div>

<script>
// Show/hide password
function togglePassword() {
    const pass = document.getElementById('password');
    if(pass.type === 'password'){
        pass.type = 'text';
    } else {
        pass.type = 'password';
    }
}

// Loading button saat submit
document.querySelector("form").addEventListener("submit",function(){
    const btn = document.getElementById('loginBtn');
    btn.innerText = "Loading...";
    btn.disabled = true;
});
</script>

</body>
</html>

