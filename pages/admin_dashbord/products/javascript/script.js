document.body.onload = fetchData();
let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let topPoductTable = document.querySelector('#TopProductTable');

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
}

function populateTopProductTable(data){
  data.forEach((e,i)=> {
    tr = document.createElement('tr');
    
    tr.innerHTML = `
    <td>${e['product_name']}</td>
    <td class="text-right">${e['total_sold_quantity'].toLocaleString()}</td>
  `
  topPoductTable.append(tr);
  
  });

}

