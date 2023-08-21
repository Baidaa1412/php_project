document.body.onload = fetchData();
let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let topPoductTable = document.querySelector("#TopProductTable");
let productTable = document.querySelector(".productTable");

let numberOfCategories = document.querySelector(".numberOfCategories");
let totalSold = document.querySelector(".totalSold");
let itemsSoldToday = document.querySelector(".itemsSoldToday");
let totalStock = document.querySelector(".totalStock");
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
  totalStock.textContent = data["total_available_stock"].toLocaleString();
  itemsSoldToday.textContent =
    data["total_sold_quantity_today"].toLocaleString();
  totalSold.textContent = data["total_sold_items"].toLocaleString();
  numberOfCategories.textContent =
    data["number_of_categories"].toLocaleString();
}

function populateProductTable(data) {
  console.log(data);
  data.forEach((e) => {
    tr = document.createElement("tr");
    tr.classList.add("tr-shadow");
    tr.innerHTML = `
    <td><img src='data:image/svg+xml;base64,${e["picture"]}'
    
  ></td>
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
          e["best_seller"] == 0 ? 'checked' : ''
        }>
        <span class="au-checkmark"></span>
      </label>
    </td>
    <td>
      <div class="table-data-feature">

        <button class="item editBtn"  data-toggle="tooltip" data-placement="top" title="Edit">
          <i class="zmdi zmdi-edit"></i>
        </button>
        <button class="item deleteBtn"  data-toggle="tooltip" data-placement="top" title="Delete">
          <i class="zmdi zmdi-delete"></i>
        </button>

      </div>
    </td>
`;
    let spacer = document.createElement("tr");
    spacer.classList.add("spacer");
    productTable.append(tr);
    productTable.append(spacer);
  });
  document.querySelectorAll('.editBtn').forEach(e=> e.addEventListener('click' , handleEditBtn))
  document.querySelectorAll('.deleteBtn').forEach(e=> e.addEventListener('click' , handleDeleteBtn))
}


function handleDeleteBtn(e){
  console.log(e.target);

}
function handleEditBtn(e){
  console.log(e.target);

}