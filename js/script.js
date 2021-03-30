function myFunction() {
  var x = document.getElementById("pwdVisible");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  if (x.nextElementSibling.className === "togglePwd fas fa-eye") {
    x.nextElementSibling.className = "togglePwd fas fa-eye-slash";
  } else {
    x.nextElementSibling.className = "togglePwd fas fa-eye";
  }
}
function myFunction2() {
  var x = document.getElementById("pwdVisible2");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  if (x.nextElementSibling.className === "togglePwd fas fa-eye") {
    x.nextElementSibling.className = "togglePwd fas fa-eye-slash";
  } else {
    x.nextElementSibling.className = "togglePwd fas fa-eye";
  }
}
