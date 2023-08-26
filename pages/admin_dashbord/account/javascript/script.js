let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");

function checkCred() {
  fetch("../checkCreds.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({}),
  })
    .then((response) => {
      return response.text();
    })
    .then((data) => {
      if (data === "failed")  window.location.href = "../login";
      ;
    });
}
checkCred();

document.body.onload = FetchData();

function FetchData() {
  fetch("./php/GetAccountData.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({}),
  })
    .then((r) => r.json())
    .then((data) => renderData(data));
}

function renderData(data) {
  let name = data["username"];
  let email = data["email"];
  DyName.forEach((e) => {
    e.textContent = name;
  });
  DyEmail.forEach((e) => {
    e.textContent = email;
  });
  populateForm(data);
}

function populateForm(data) {
  let emailF = document.querySelector(".emailform");
  let username = document.querySelector(".usernameform");
  emailF.placeholder = data["email"];
  username.placeholder = `${data["username"]}`;
}

editBtns = document.querySelectorAll(".btn");
editBtns.forEach((e) => {
  e.addEventListener("click", handleEdit);
});
function handleEdit(e) {
  let editRequestor = e.currentTarget.id;
  let a = e.target.closest(".row").querySelector("div input");

  e.target.closest(".Toolbuttons").innerHTML = `
  <button data-id="${editRequestor}" class="btn btn-success btn-sm mg-y-5 confirmBtn"><i class="fa-duotone fa-check"></i>
  Confirm</button>
  <button data-id="${editRequestor}" class="btn btn-danger btn-sm mg-y-5 cancelBtn"><i class="fa-solid fa-xmark"></i>
    Cancel</button>
`;
  a.removeAttribute("disabled");
  a.setAttribute("required", 'true');
  document
    .querySelectorAll(".confirmBtn")
    .forEach((e) => e.addEventListener("click", handleConfirm));
  document
    .querySelectorAll(".cancelBtn")
    .forEach((e) => e.addEventListener("click", handleCancelBtn));
}

function handleConfirm(e) {
  console.log(e.currentTarget.getAttribute("data-id"));
  let a = document.querySelector(`.${e.currentTarget.getAttribute("data-id")}form`);
  let obj = {
    inp: a.value,
    changeable: e.currentTarget.getAttribute("data-id"),
  };
  fetch("./php/editAccountInfo.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(obj),
  }).then(d =>{
    location.reload();
  });
}
function handleCancelBtn(e) {
  location.reload();
}

document.querySelector('.logOut').addEventListener('click' ,logout);

function logout(e){
  fetch("../logout.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({}),
  }).then(d =>{
    window.location.href = '../login';
  });
}
