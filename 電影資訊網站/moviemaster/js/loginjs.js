function login() {
    var username = document.getElementById("username");
    var pass = document.getElementById("password");
    if (username.value == "" && pass.value  == "") {
    alert("請輸入使用者名稱和密碼");
    } else if (username.value == "") {
    alert("請輸入使用者名稱");
    } else if (pass.value  == "") {
    alert("請輸入密碼");
    } else if(username.value == "admin" && pass.value == "123456"){
    window.location.href="index.html";
    } else {
    alert("請輸入正確的使用者名稱和密碼！")
    }
    }

function create() {
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var password2 = document.getElementById("password2");
    if (username.value == "") {
    alert("請輸入使用者名稱");
    } else if (password.value  == "") {
    alert("請輸入密碼");
    } else if (password2.value  == "") {
    alert("請再次確認密碼");
    } else if (password2.value  != password.value) {
        alert("請輸入相同密碼");
    }else{
        alert("註冊成功!");
        window.location.href="login.html";
    }
    }








