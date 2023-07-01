function login() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;

    $.ajax({
        url: './Backend/Login.php',
        method: 'POST',
        data: { username, password, role },
        success: function (response) {
            try {
                const _response = response?.split(";;");
                const message = _response[0];
                const details = _response[1];

                let filterDetails = details?.split(";")

                filterDetails = filterDetails?.reduce(function (result, item) {
                    var parts = item.split('=');
                    var key = parts[0];
                    var value = parts[1];
                    result[key] = value.trim();
                    return result;
                }, {});

                if (message.includes("Login successfull !")) {
                    localStorage.setItem("loginDetails", JSON.stringify(filterDetails));
                    location.assign("./FirstPage.html");
                }
            } catch (error) {
                console.log(error)
                alert("Failed to login !")
            }
        }
    });
}