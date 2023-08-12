const loginDetails = JSON.parse(localStorage.getItem("loginDetails"));

if(!loginDetails || loginDetails?.role !== "admin") {
    alert("Only admin is allow to access this page !")
    location.assign("./FirstPage.html")
}

function createElection() {
    const name = document.getElementById("name").value;
    const electionType = document.getElementById("electionType").value;
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;

    // form validation
    if(new Date(startDate) > new Date(endDate)) return alert("Start data must be before End date !ss")

    $.ajax({
        url: './Backend/registerElection.php',
        method: 'POST',
        data: { name, electionType, startDate, endDate},
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

                alert(message)
                location.reload();
            } catch (error) {
                console.log(error)
                alert("Failed to login !")
            }
        }
    });
}