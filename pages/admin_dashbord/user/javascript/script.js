let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let userTable = document.querySelector("#userTable");
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
  fetch("./php/GetUserData.php", {
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
  let name = data[0]["username"];
  let email = data[0]["email"];

  DyName.forEach((e) => {
    e.textContent = name;
  });
  DyEmail.forEach((e) => {
    e.textContent = email;
  });
  populateTable(data[1]);
}

function populateTable(data) {
  userTable.innerHTML = "";
  data.forEach((e) => {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow");
    if (e["status"] != 0) {
      tr.innerHTML = `
      <td>
        <div>
        <img src='${e["pictureURI"]},${e["picture"]}'>
        </div>
      </td>
      <td>
        <span class="name">${e["name"]}</span>
      </td>
      <td class="email">${e["email"]}</td>
      <td class="phone_number">${e["phone_number"]}</td>
      <td>
      <td>
      <span class="address">${e["address"]}</span>
    </td>
  <td>
        <div class="table-data-feature">
          <button class="item editBtn" data-id = ${e["id"]}  data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="zmdi zmdi-edit"></i>
          </button>
          <button class="item deleteBtn" data-id = ${e["id"]}  data-toggle="tooltip" data-placement="top" title="Delete">
            <i class="zmdi zmdi-delete"></i>
          </button>
  
        </div>
      </td>
  `;
      let spacer = document.createElement("tr");
      spacer.classList.add("spacer");
      userTable.append(tr);
      userTable.append(spacer);
    }
  });
  document
    .querySelectorAll(".editBtn")
    .forEach((e) => e.addEventListener("click", handleEditBtn));
  document
    .querySelectorAll(".deleteBtn")
    .forEach((e) => e.addEventListener("click", handleDeleteBtn));
}

function handleEditBtn(e) {
  let id = e.currentTarget.getAttribute("data-id");
  let mainDiv = e.currentTarget.closest(".tr-shadow");
  let imgDiv = mainDiv.querySelector(":nth-child(1) div");
  imgDiv.innerHTML += `
  <button style="display:block;width:120px; height:30px;" class="uploadSection" onclick="document.getElementById('getFile').click()">Upload The File</button>
  <input type='file' id="getFile" style="display:none" onchange="handleFileUpload(event)">
`;
  let nameField = mainDiv.querySelector("td:nth-child(2) span");
  let inputElement = document.createElement("input");
  inputElement.classList.add("newName");
  inputElement.type = "text";
  inputElement.value = nameField.textContent;

  nameField.parentNode.replaceChild(inputElement, nameField);

  let phoneNumberField = mainDiv.querySelector("td:nth-child(4)");
  console.log(phoneNumberField);
  inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.classList.add("newphoneNumber");
  inputElement.value = phoneNumberField.textContent;
  phoneNumberField.innerHTML = " ";
  phoneNumberField.append(inputElement);

  let emailField = mainDiv.querySelector("td:nth-child(3)");
  inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.classList.add("newEmail");
  inputElement.value = emailField.textContent;
  emailField.innerHTML = " ";
  emailField.append(inputElement);

  let buttons = mainDiv.querySelector("td:last-child div");

  let btn1 = buttons.querySelector("button:first-child");
  let btn2 = buttons.querySelector("button:last-child");

  btn1.removeEventListener("click", handleEditBtn);
  btn2.removeEventListener("click", handleDeleteBtn);

  btn1.classList.remove("editBtn");
  btn1.classList.add("confirmBtn", "btn-success", "btn");
  btn1.title = "Confirm";
  btn1.innerHTML = '<i class="zmdi zmdi-check"></i>';

  btn2.classList.remove("deleteBtn");
  btn2.classList.add("cancelBtn", "btn", "btn-danger");

  btn2.setAttribute("title", "Cancel");

  btn2.innerHTML = '<i class="fa-solid fa-xmark"></i>';
  btn1.addEventListener("click", update);
  btn2.addEventListener("click", cancel);
}

function handleDeleteBtn(e) {
  $id = e.currentTarget.getAttribute("data-id");
  fetch("./php/DeleteUser.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify($id),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") {
        removeDiv(e.target);
      }
    });
}

function removeDiv(e) {
  e.closest(".tr-shadow").remove();
}

function update(e) {
  let userId, newFile, newName, newEmail, newphoneNumber;
  userId = e.currentTarget.getAttribute("data-id");
  newFile = document.querySelector("#getFile").files[0] ?? null;
  if (!isFileAllowed(newFile)) {
    location.reload();
  }
  newName = document.querySelector(".newName").value;
  newEmail = document.querySelector(".newEmail").value;
  newphoneNumber = document.querySelector(".newphoneNumber").value;

  let user = {
    id: userId,
    picture: newFile,
    name: newName,
    email: newEmail,
    phoneNumber: newphoneNumber,
  };

  getBase64(newFile).then((data) => sendData(data, user));
}

function sendData(data, user) {
  user.picture = data;
  fetch("./php/updateUser.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify(user),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") FetchData();
    });
}

function cancel(e) {
  FetchData();
}

function getBase64(file) {
  return new Promise((resolve, reject) => {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
      resolve(reader.result);
    };
    reader.onerror = function (error) {
      reject(error);
    };
  });
}

function isFileAllowed(fileInput) {
  const allowedExtensions = ["svg", "png", "jpeg", "jpg", "webp"];
  if (!fileInput) {
    return false;
  }
  const fileName = fileInput.name;
  const fileExtension = fileName.split(".").pop().toLowerCase();
  return allowedExtensions.includes(fileExtension);
}

function handleFileUpload(event) {
  const selectedFile = event.target.files[0];
  const uploadButton = document.querySelector(".uploadSection");

  if (selectedFile) {
    let displayName = selectedFile.name.substring(0, 8);

    // Add the file extension if it's not too long
    if (selectedFile.name.length > 8) {
      const fileExtension = selectedFile.name.split(".").pop();
      displayName += `...${fileExtension}`;
    } else {
      displayName += `.${selectedFile.name.split(".").pop()}`;
    }

    uploadButton.textContent = displayName;
  } else {
    uploadButton.textContent = "Upload The File";
  }
}

let addItemBtn = document.querySelector(".addItemBtn");
addItemBtn.addEventListener("click", addUser);

function addUser(e) {
  if (document.querySelectorAll(".newUser").length < 1) {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow", "newUser");
    tr.innerHTML = `
      <td>
        <div>
        <button style="display:block;width:120px; height:30px;" class="uploadSection" onclick="document.getElementById('getFile').click()">Upload The File</button>  <input type='file' id="getFile" style="display:none" onchange="handleFileUpload(event)">
        </div>
      </td>
      <td>
        <input type="text" class="newName" placeholder="User name">
      </td>
      <td>
        <input type="text" class="newEmail" placeholder="Email">
      </td>
      <td class="phone_number">
      <input type="text" class="newPhoneNumber" placeholder="Phone number">
      </td>
      <td>
        <input type="text" class="newAddress" placeholder="Address">
      </td>
      <td></td>
      <td>
        <div class="table-data-feature">
  
          <button class="item AddUserBtn btn-success btn"data-toggle="tooltip" data-placement="top" title="Add">
            <i class="zmdi zmdi-check"></i>
          </button>
          <button class="item cancelBtn btn btn-danger" data-toggle="tooltip" data-placement="top" title="Cancel">
            <i class="zmdi zmdi-delete"></i>
          </button>
        </div>
      </td>
  `;


    let spacer = document.createElement("tr");
    spacer.classList.add("spacer");
    userTable.append(tr);
    userTable.append(spacer);
    document.querySelector(".AddUserBtn").addEventListener("click", insertUser);
    document.querySelector(".cancelBtn").addEventListener("click", cancel);
  }
}

function insertUser(e) {
  let newFile, newName , newEmail , newPhoneNumber , newAddress;
  newFile = document.querySelector("#getFile").files[0] ?? null;
  console.log(isFileAllowed(newFile));
  if (!isFileAllowed(newFile)) {
    location.reload();
  }
  newName = document.querySelector(".newName").value;
  newEmail = document.querySelector(".newEmail").value;
  newPhoneNumber = document.querySelector(".newPhoneNumber").value;
  newAddress = document.querySelector(".newAddress").value;

  let User = {
    picture: newFile,
    name: newName,
    email: newEmail,
    phoneNumber: newPhoneNumber,
    address: newAddress
  };
  getBase64(newFile).then((data) => appendDB(data, User));
}
function appendDB(data, User) {
  User.picture = data;
  fetch("./php/AddUser.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify(User),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") fetchData();
    });
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
