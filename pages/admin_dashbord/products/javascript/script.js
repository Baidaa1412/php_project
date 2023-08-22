document.body.onload = fetchData();
let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let topPoductTable = document.querySelector("#TopProductTable");
let productTable = document.querySelector(".productTable");

let numberOfCategories = document.querySelector(".numberOfCategories");
let totalSold = document.querySelector(".totalSold");
let itemsSoldToday = document.querySelector(".itemsSoldToday");

let addItemBtn = document.querySelector(".addItemBtn");
addItemBtn.addEventListener("click", addProduct);

let totalStock = document.querySelector(".totalStock");

function addProduct(e) {
  if (document.querySelectorAll(".newProduct").length < 1) {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow", "newProduct");
    tr.innerHTML = `
      <td>
        <div>
        <button style="display:block;width:120px; height:30px;" class="uploadSection" onclick="document.getElementById('getFile').click()">Upload The File</button>  <input type='file' id="getFile" style="display:none" onchange="handleFileUpload(event)">
        </div>
      </td>
      <td>
      <input type="text" class="newName" placeholder="Product name">
      </td>
      <td class="stock">
        <input type="text" class="newStock" placeholder="Stock">
      </td>
      <td class="discount">
          <input type="text" class="newDiscount" placeholder="Discount">
      </td>
      <td>
        <input type="text" class="newPrice" placeholder="Price">
      </td>
      <td>
        <label class="au-checkbox">
          <input type="checkbox" class="NewBestSeller">
          <span class="au-checkmark"></span>
        </label>
      </td>
      <td>
        <div class="table-data-feature">
  
          <button class="item AddProductBtn btn-success btn"data-toggle="tooltip" data-placement="top" title="Add">
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
    productTable.append(tr);
    productTable.append(spacer);
    document
      .querySelector(".AddProductBtn")
      .addEventListener("click", insertProduct);
    document.querySelector(".cancelBtn").addEventListener("click", cancel);
  }
}

function insertProduct(e) {
  let newFile, newName, newStock, newDiscount, newPrice, NewBestSeller;
  newFile = document.querySelector(".newProduct #getFile").files[0] ?? null;
  console.log(isFileAllowed(newFile));
  if (!isFileAllowed(newFile)) {
    location.reload();
  }
  newName = document.querySelector(".newProduct .newName").value;
  newDiscount = document.querySelector(".newProduct .newDiscount").value;
  newStock = document.querySelector(".newProduct .newStock").value;
  newPrice = document.querySelector(".newProduct .newPrice").value;
  NewBestSeller = document.querySelector(".newProduct .NewBestSeller").checked;

  let product = {
    picture: newFile,
    name: newName,
    stock: newStock,
    discount: newDiscount,
    price: newPrice,
    best_seller: NewBestSeller,
  };
  getBase64(newFile).then((data) => appendDB(data, product));
}
function appendDB(data, product) {
  product.picture = data;
  fetch("./php/AddProduct.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify(product),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") fetchData();
    });
}

function fetchData() {
  fetch("./php/getPeoductData.php", {
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
  console.log(data);
  let name = data[0]["username"];
  let email = data[0]["email"];
  DyName.forEach((e) => {
    e.textContent = name;
  });
  DyEmail.forEach((e) => {
    e.textContent = email;
  });
  console.log(data);
  populateTopProductTable(data[1]);
  populateStatistic(data[2]);
  populateProductTable(data[3]);
}

function populateTopProductTable(data) {
  data.forEach((e, i) => {
    tr = document.createElement("tr");

    tr.innerHTML = `
    <td>${e["product_name"]}</td>
    <td class="text-right">${e["total_sold_quantity"].toLocaleString()}</td>
  `;
    topPoductTable.append(tr);
  });
}

function populateStatistic(data) {
  (totalStock.textContent =
    data["total_available_stock"] ?? "0").toLocaleString();
  itemsSoldToday.textContent = (
    data["total_sold_quantity_today"] ?? "0"
  ).toLocaleString();
  (totalSold.textContent = data["total_sold_items"] ?? "0").toLocaleString();
  numberOfCategories.textContent =
    data["number_of_categories"].toLocaleString();
}

function populateProductTable(data) {
  productTable.innerHTML = "";
  data.forEach((e) => {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow");
    if (e["status"] != 0) {
      tr.innerHTML = `
      <td>
        <div>
        <img src='${e["URI"]},${e["picture"]}'>
        </div>
      </td>
      <td>
        <span class="name">${e["name"]}</span>
      </td>
      <td class="stock">${e["stock"]}</td>
      <td class="discount">${e["discount"]}%</td>
      <td>
        <span class="price">$${e["price"].toLocaleString()}</span>
      </td>
      <td>
        <label class="au-checkbox">
          <input type="checkbox" disabled ${
            e["best_seller"] == 0 ? "checked" : ""
          }>
          <span class="au-checkmark"></span>
        </label>
      </td>
      <td>
        <div class="table-data-feature">
  
          <button class="item editBtn" data-id = ${
            e["id"]
          }  data-toggle="tooltip" data-placement="top" title="Edit">
            <i class="zmdi zmdi-edit"></i>
          </button>
          <button class="item deleteBtn" data-id = ${
            e["id"]
          }  data-toggle="tooltip" data-placement="top" title="Delete">
            <i class="zmdi zmdi-delete"></i>
          </button>
  
        </div>
      </td>
  `;
      let spacer = document.createElement("tr");
      spacer.classList.add("spacer");
      productTable.append(tr);
      productTable.append(spacer);
    }
  });
  document
    .querySelectorAll(".editBtn")
    .forEach((e) => e.addEventListener("click", handleEditBtn));
  document
    .querySelectorAll(".deleteBtn")
    .forEach((e) => e.addEventListener("click", handleDeleteBtn));
}

function handleDeleteBtn(e) {
  $id = e.currentTarget.getAttribute("data-id");
  fetch("./php/DeleteProduct.php", {
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
let MainGlobeldiv;
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

  let stockField = mainDiv.querySelector("td:nth-child(3)");
  inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.classList.add("newStock");
  inputElement.value = stockField.textContent;
  stockField.innerHTML = " ";
  stockField.append(inputElement);

  let discountField = mainDiv.querySelector("td:nth-child(4)");
  console.log(discountField);
  inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.classList.add("newDiscount");
  inputElement.value = discountField.textContent;
  discountField.innerHTML = " ";
  discountField.append(inputElement);

  let priceField = mainDiv.querySelector("td:nth-child(5) span");
  inputElement = document.createElement("input");
  inputElement.type = "text";
  inputElement.classList.add("newPrice");
  inputElement.value = priceField.textContent;

  priceField.parentNode.replaceChild(inputElement, priceField);

  let is_best = mainDiv.querySelector('td label input[type="checkbox"]');
  is_best.classList.add("NewBestSeller");
  is_best.removeAttribute("disabled");

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
function removeDiv(e) {
  console.log(e);
  e.closest(".tr-shadow").remove();
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
function update(e) {
  let productId,
    newFile,
    newName,
    newStock,
    newDiscount,
    newPrice,
    NewBestSeller;
  productId = e.currentTarget.getAttribute("data-id");
  // console.log("id", productId);
  newFile = document.querySelector("#getFile").files[0] ?? null;
  console.log(isFileAllowed(newFile));
  if (!isFileAllowed(newFile)) {
    location.reload();
  }
  // console.log("file", newFile);
  newName = document.querySelector(".newName").value;
  newDiscount = document.querySelector(".newDiscount").value;
  // console.log("name", newName);
  newStock = document.querySelector(".newStock").value;
  // console.log('stock' , newStock);
  newPrice = document.querySelector(".newPrice").value;
  // console.log('price' , newPrice);
  NewBestSeller = document.querySelector(".NewBestSeller").checked;
  // console.log('best seller' , NewBestSeller);

  let product = {
    id: productId,
    picture: newFile,
    name: newName,
    stock: newStock,
    discount: newDiscount,
    price: newPrice,
    best_seller: NewBestSeller,
  };

  getBase64(newFile).then((data) => sendData(data, product));
}
function sendData(data, product) {
  product.picture = data;
  fetch("./php/updateProduct.php", {
    method: "POST",
    headers: {
      "Content0-Type": "application/json",
    },
    body: JSON.stringify(product),
  })
    .then((r) => r.json())
    .then((data) => {
      if (data !== "failed") fetchData();
    });
}
function cancel(e) {
  fetchData();
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
