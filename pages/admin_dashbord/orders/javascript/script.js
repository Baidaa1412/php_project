let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let orderTable = document.querySelector("#orderTable");
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
  fetch("./php/GetOrderData.php", {
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
  orderTable.innerHTML = "";
  data.forEach((e) => {
    if (e["order_status"] == 2) {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow");
      tr.innerHTML = `
      <td><img src="${e["imageURL"]},${e["picture"]}"></td>
      <td>
        <span class="productName">${e["product_name"]}</span>
      </td>
      <td class="quantity">${e["order_quantity"]}</td>
      <td class="customerName">${e["customer_name"]}</td>
      <td class="phone_number">${e["customer_phone_number"]}</td>
      <td>
        <span class="address">${e["order_address"]}</span>
      </td>
      <td class="text-right">
        <button data-id="${e["order_id"]}" class="btn btn-success btn-sm mg-y-5 confirmBtn"><i class="fa-duotone fa-check"></i>
          Confirm</button>
        <button data-id="${e["order_id"]}" class="btn btn-danger btn-sm mg-y-5 cancelBtn"><i class="fa-solid fa-xmark"></i>
          Cancel</button>
      </td>
      </tr>
  `;
      let spacer = document.createElement("tr");
      spacer.classList.add("spacer");
      orderTable.append(tr);
      orderTable.append(spacer);
    }
  });
  document
    .querySelectorAll(".confirmBtn")
    .forEach((e) => e.addEventListener("click", handleConfirm));
  document
    .querySelectorAll(".cancelBtn")
    .forEach((e) => e.addEventListener("click", handleCancelBtn));
}

function handleConfirm(e) {
  let requestData={
    id:e.currentTarget.getAttribute("data-id"),
    status:1
  }

  fetch("./php/editOrder.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(requestData),
  }).then(
    FetchData()
  );
}

function handleCancelBtn(e){
  let requestData={
    id:e.currentTarget.getAttribute("data-id"),
    status:0
  }

  fetch("./php/editOrder.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(requestData),
  }).then(
    FetchData()
  );
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
