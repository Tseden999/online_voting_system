

document.getElementById("register")?.addEventListener("click", () => {
    const username = document.getElementById("name").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;
    const age = document.getElementById("age").value;
    const address = document.getElementById("address").value;
    const contact_no = document.getElementById("contact").value;
    const email = document.getElementById("email").value;
    const profile = document.getElementById("profile").files[0];

    const formdata = new FormData();
    
    formdata.append("username", username);
    formdata.append("password", password);
    formdata.append("role", role);
    formdata.append("age", age);
    formdata.append("address", address);
    formdata.append("contact_no", contact_no);
    formdata.append("email", email);
    formdata.append("profile", profile);

    $.ajax({
        url: './Backend/Registration.php',
        method: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        success: function(response) {
            alert(response)

            if(response.includes("Register successfull !")){
                location.assign("./index.html");
            }
        }
    });
})