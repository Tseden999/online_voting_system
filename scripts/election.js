
// get localstorage value 
//localstorage stores only string value
const loginDetails = localStorage.getItem("loginDetails");

// convert loginDetails into object
// use JASON.stringify to convert object into string

const signupDetails = JSON.parse(loginDetails)

// access the loginDetails field value
console.log(signupDetails.role);
console.log(signupDetails.username);
console.log(signupDetails.password);
 

const ElectionStartDate = new Date()-1;//previous date 10
const CurrentDate = new Date();//current date 9

//
if(signupDetails.role != "admin"  && CurrentDate > ElectionStartDate ){
  alert("Election has not ended yet !")
  location.assign("./FirstPage.html")
};


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
