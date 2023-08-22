let form = document.querySelector("form");
let loginBtn = document.querySelector("#loginBtn");
let email = document.querySelector("#email");
let password = document.querySelector("#password");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  loginBtn.addEventListener("click", handleLogin);
});

function handleLogin(e) {
  creds = {
    email: email.value,
    password: password.value,
  };
  fetch("./php/checkCreds.php", {
    method: "POST",
    headers: {
      "Content-Type": "Application/json",
    },
    body: JSON.stringify(creds),
  })
    .then((r) => r.json())
    .then((data) => handleResponse(data));
}
function handleResponse(data) {
  if (data === "valid") window.location.href = "../sales/";
  else {
    displayError();
  }
}

function displayError() {
  try {
    document
      .querySelector(
        ".sufee-alert.alert.with-close.alert-danger.alert-dismissible.fade.show"
      )
      .remove();
  } catch {}
  let alert = document.createElement("div");
  alert.innerHTML = `<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
  can't find your account try again with a different account
</div>`;
  form.prepend(alert);
}
