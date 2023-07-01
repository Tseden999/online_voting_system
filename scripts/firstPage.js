
const loginDetails = JSON.parse(localStorage.getItem("loginDetails"));
const register = document.getElementById("register");
const login = document.getElementById("login");
const voting = document.getElementById("voting");
const candidates = document.getElementById("candidates");
const voters = document.getElementById("voters");
const logoutBtn = document.getElementById("logout");
const profile = document.getElementById("profile_img");
const usernameElement = document.getElementById("username");
const voteBtn = document.getElementById("voteBtn");

if(loginDetails?.username){
    usernameElement.innerText = loginDetails?.username ?? "";

    if(register) register.style.display = "none";
    if(login) login.style.display = "none";
    if(voting) voting.style.display = "block";
    if(candidates) candidates.style.display = "block";
    if(logoutBtn) logoutBtn.style.display = "block";
    profile.style.display ="block";

    if(loginDetails.profile){
        profile.src = "./Backend/uploads/"+loginDetails.profile;
    }else{
        profile.src = "./Backend/uploads/users.png";
    }
}else{
    if(register) register.style.display = "block";
    if(login) login.style.display = "block";
    if(logoutBtn) logoutBtn.style.display = "none";
    if(voting) voting.style.display = "none";
    if(candidates) candidates.style.display = "none";
    if(voters) voters.style.display = "none";
    profile.style.display ="none";
}

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

function redirect(pageUrl){
    if(loginDetails?.username) location.assign(pageUrl);
    else location.assign("index.html");
}

function vote(_candidateId){
   if(loginDetails?.role === "candidate" || loginDetails?.role === "admin" ) return alert("Your role cannot vote !")

   $.ajax({
    url: './Backend/Voting.php',
    method: 'POST',
    data: { 
        username: loginDetails?.username, 
        password: loginDetails?.password,
        candidate_id:_candidateId 
    },
    success: function(response) {
        alert(response)

        if(response.includes("Voted successfully !")){
            location.reload();
        }
    }
});
}

function deleteUser(userId, table_name){
   if(loginDetails?.role != "admin" ) return alert("Your role cannot delete the user !")

   $.ajax({
    url: './Backend/DeleteUser.php',
    method: 'POST',
    data: { 
        userId: userId, 
        table_name:table_name
    },
    success: function(response) {
        alert(response)
        location.reload();
    }
});
}