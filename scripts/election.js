function logout(){
    $.ajax({
        url: './Backend/Logout.php',
        method: 'POST',
        data: null,
        success: function (response) {
          try {
            alert(response);
            localStorage.setItem("loginDetails", null);
            location.assign("index.html");
          } catch (error) {
            alert(er)
          }
        }
    });
}