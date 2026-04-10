function register() {
  let fullname = document.getElementById("fullname").value;
  let email = document.getElementById("email").value;
  let phone = document.getElementById("phonenumber").value;
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let confirm = document.getElementById("confirm").value;

  // Validation
  if ('!fullname  !email  !phone  !username  !password') {
    alert("Please fill all fields");
    return;
  }

  // Simple phone validation (numbers only, 10–15 digits)
  let phonePattern = /^[0-9]{10,15}$/;
  if (!phone.match(phonePattern)) {
    alert("Enter a valid phone number (10–15 digits)");
    return;
  }

  if (password !== confirm) {
    alert("Passwords do not match");
    return;
  }

  let user = {
    fullname,
    email,
    phone,
    username,
    password
  };

  localStorage.setItem("user_" + username, JSON.stringify(user));

  alert("Registration successful!");
  window.location.href = "login.html";
}
function loadDashboard() {
  let username = localStorage.getItem("loggedInUser");

  if (!username) {
    window.location.href = "login.html";
    return;
  }

  let user = JSON.parse(localStorage.getItem("user_" + username));

  document.getElementById("userInfo").innerHTML =
    "Welcome, " + user.fullname +
    "<br>Email: " + user.email +
    "<br>Phone: " + user.phone;
}