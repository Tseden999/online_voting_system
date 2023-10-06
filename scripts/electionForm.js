function registerElection(){
 const name =document.querySelector('#name').value;
 const eType =document.querySelector('#eType').value;
 const start_date =document.querySelector('#start_date').value;
 const end_date =document.querySelector('#end_date').value;

 $.ajax ({
    url:'./Backend/Election.php',
    method:'post',
    data:{name,eType,start_date,end_date},
    success:function(response)
    {
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
        } catch (error) {
            console.log(error)
            alert("Failed to add!")
        }
    }
 });

}