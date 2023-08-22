document.body.onload = fetchData();
let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let topCategory = document.querySelector("#topCategory");
let CategoriesTable = document.querySelector("#CategoriesTable");
function fetchData() {
  fetch("./php/getCategoryData.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
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
  pouplateBarGraph(data[1]);
  populateCategoriesTable(data[1]);
  pouplateMainTable(data[2]);
}

function pouplateBarGraph(data) {
  console.log(data);
  let categories = data.map((e) => e.category_name);
  let sales = data.map((e) => e.total_sales);

  let ctx = document.getElementById("barChart");
  if (ctx) {
    ctx.height = 200;
    let myChart = new Chart(ctx, {
      type: "bar",
      defaultFontFamily: "Poppins",
      data: {
        labels: categories.slice(0, 9),
        datasets: [
          {
            label: "My First dataset",
            data: sales,
            borderColor: "rgba(0, 123, 255, 0.9)",
            borderWidth: "0",
            backgroundColor: "rgba(0, 123, 255, 0.5)",
            fontFamily: "Poppins",
          },
        ],
      },
      options: {
        legend: {
          position: "top",
          labels: {
            fontFamily: "Poppins",
          },
        },
        scales: {
          xAxes: [
            {
              ticks: {
                fontFamily: "Poppins",
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins",
              },
            },
          ],
        },
      },
    });
  }
}

function populateCategoriesTable(data) {
  data.slice(0, 8).forEach((e) => {
    let tr = document.createElement("tr");
    tr.innerHTML = `<td>${e.category_name}</td>
    <td class="text-right">${e.total_sales}</td>`;
    topCategory.append(tr);
  });
}

function pouplateMainTable(data) {
  CategoriesTable.innerHTML = "";
  data.forEach((e) => {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow");
    if (e["status"] != 0) {
      tr.innerHTML = `
      <td>
        <div>
        <img src='${e["imageURL"]},${e["image"]}'>
        </div>
      </td>
      <td>
        <span class="name">${e["name"]}</span>
      </td>
      <td class="total_categorys">${e["total_products"]}</td>
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
      CategoriesTable.append(tr);
      CategoriesTable.append(spacer);
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
  MainGlobeldiv = mainDiv;
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
  fetch("./php/DeleteCategory.php", {
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
function handleFileUpload(event) {
  const selectedFile = event.target.files[0];
  const uploadButton = document.querySelector(".uploadSection");

  if (selectedFile) {
    let displayName = selectedFile.name.substring(0, 8);

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
function cancel(e) {
  fetchData();
}
function update(e) {
  let categoryId, newFile, newName;
  categoryId = e.currentTarget.getAttribute("data-id");
  newFile = document.querySelector("#getFile").files[0] ?? null;
  console.log(isFileAllowed(newFile));
  if (!isFileAllowed(newFile)) {
    location.reload();
  }
  newName = document.querySelector(".newName").value;

  let category = {
    id: categoryId,
    picture: newFile,
    name: newName,
  };

  getBase64(newFile).then((data) => sendData(data, category));
}
function sendData(data, category) {
  category.picture = data;
  fetch("./php/updateCategory.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify(category),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") fetchData();
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



let addItemBtn = document.querySelector(".addItemBtn");
addItemBtn.addEventListener("click", addCategory);


function addCategory(e) {
  if (document.querySelectorAll(".newCategory").length < 1) {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow", "newCategory");
    tr.innerHTML = `
      <td>
        <div>
        <button style="display:block;width:120px; height:30px;" class="uploadSection" onclick="document.getElementById('getFile').click()">Upload The File</button>  <input type='file' id="getFile" style="display:none" onchange="handleFileUpload(event)">
        </div>
      </td>
      <td>
      <input type="text" class="newName" placeholder="category name">
      </td>
      <td class="total_products"> 0</td>
      <td>
        <div class="table-data-feature">
  
          <button class="item AddCategoryBtn btn-success btn"data-toggle="tooltip" data-placement="top" title="Add">
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
    CategoriesTable.append(tr);
    CategoriesTable.append(spacer);
    document
      .querySelector(".AddCategoryBtn")
      .addEventListener("click", insertcategory);
    document.querySelector(".cancelBtn").addEventListener("click", cancel);
  }
}

function insertcategory(e) {
  let newFile, newName
  newFile = document.querySelector(".newCategory #getFile").files[0] ?? null;
  console.log(isFileAllowed(newFile));
  if (!isFileAllowed(newFile)) {
    location.reload();
  }
  newName = document.querySelector(".newCategory .newName").value;
  

  let category = {
    picture: newFile,
    name: newName
  };
  getBase64(newFile).then((data) => appendDB(data, category));
}
function appendDB(data, category) {
  category.picture = data;
  fetch("./php/AddCategory.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify(category),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") fetchData();
    });
}