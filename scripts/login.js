var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");
function register() {
  x.style.left = "-400px";
  y.style.left = "-70px";
  z.style.left = "110px";
  document.getElementById("register").style.display = "block";
}

function login() {
  x.style.left = "-60px";
  // y.style.left = '450px';
  document.getElementById("register").style.display = "none";
  z.style.left = "0px";
}
function patient_checked() {
  console.log("object");
  document.getElementById("field_patient").style.display = "block";
  document.getElementById("field_doctor").style.display = "none";
  
}
function doctor_checked() {
  console.log("object12");
  document.getElementById("field_patient").style.display = "none";
  document.getElementById("field_doctor").style.display = "block";
}
