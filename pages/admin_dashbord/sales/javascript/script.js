let DyName = document.querySelectorAll(".dyName");
let DyEmail = document.querySelectorAll(".dyEmail");
let todaysSales = document.querySelector("#todaySale");
let weeksSales = document.querySelector("#weekSale");
let totalSales = document.querySelector("#totalSale");

NumberOfCustomers = document.querySelector("#NumCustomer");

document.body.onload = FetchData();

function FetchData() {
  fetch("./php/GetDashboardData.php", {
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
  document.querySelector(".welcomeMes").textContent = name.split(" ")[0];

  DyName.forEach((e) => {
    e.textContent = name;
  });
  DyEmail.forEach((e) => {
    e.textContent = email;
  });
  let sales = data[1];

  const currentDate = new Date();
  currentDate.setHours(0, 0, 0, 0);

  let today = 0;
  let WeeksToday = 0;
  let TotalSales = 0;
  let users = 0;

  const startOfWeek = getStartOfWeek(currentDate);
  const endOfWeek = getEndOfWeek(currentDate);
  categories = {};
  for (let key in sales) {
    let sale = sales[key];
    let saleDate = new Date(sale["date_of_order"]);

    if (saleDate.toDateString() === currentDate.toDateString()) {
      today -= -sale["product_price"];
    }

    if (saleDate >= startOfWeek && saleDate <= endOfWeek) {
      WeeksToday -= -sale["product_price"];
    }

    TotalSales -= -sale["product_price"];
    users = users > sale["order_id"] ? users : sale["order_id"];
    categories[sale["category_name"]]
      ? categories[sale["category_name"]]++
      : (categories[sale["category_name"]] = 1);
  }
  console.log(today , weeksSales , TotalSales);

  todaysSales.textContent = `$${today.toLocaleString()}`;
  weeksSales.textContent = `$${WeeksToday.toLocaleString()}`;
  totalSales.textContent = `$${TotalSales.toLocaleString()}`;
  NumberOfCustomers.textContent = users.toLocaleString();

  populatePia(categories);
  populateGraph(data[2]);
  populateTable(data[1]);
}
function populateTable(data) {
  let table = document.querySelector('#OrdersTable');
  let custName, CustEmail, adrress, price, Stat;
  for (let i = 0; i < (data.length > 10 ? 10 : data.length); i++) {
    custName = data[i]["customer_name"];
    CustEmail = data[i]["customer_email"];
    adrress = data[i]["order_address"];
    price = data[i]["product_price"] * data[i]["order_quantity"];
    Stat = data[i]["order_status"] == 1 ? true : false;
    let newRow = document.createElement('tr'); 
    newRow.innerHTML =`
    <td>${custName}</td>
     <td>${CustEmail}</td>
      <td>${adrress}</td>
       <td>$${price.toLocaleString()}</td>
        <td class="${
      Stat ? "process" : "denied"
    }">${Stat ? "Confirmed" : "Cancelled"}
    </td>
`;
    table.append(newRow);
  }

  // for(let i in)
}

function populatePia(categories) {
  let categoryColors = generateColors(Object.keys(categories).length);
  let ctx = document.getElementById("pieChart");
  if (ctx) {
    ctx.height = 200;
    let myChart = new Chart(ctx, {
      type: "pie",
      data: {
        datasets: [
          {
            data: Object.values(categories),
            backgroundColor: categoryColors,
            hoverBackgroundColor: categoryColors.map((color) =>
              color.replace("0.9", "0.3")
            ),
          },
        ],
        labels: Object.keys(categories),
      },
      options: {
        legend: {
          position: "top",
          labels: {
            fontFamily: "Poppins",
          },
        },
        responsive: true,
      },
    });
  }
}

function populateGraph(data) {
  console.log(data);
  let monthNames = data.map((item) => item.month_name);
  let totalRevenueArray = data.map((item) => item.total_revenue);
  monthNames.push("September");
  monthNames.push("October");
  monthNames.push("November");
  monthNames.push("December");
  monthNames.unshift("July");
  totalRevenueArray.unshift(0);
  console.log(monthNames);

  let ctx_ = document.getElementById("team-chart");
  if (ctx_) {
    ctx_.height = 150;
    let myChart = new Chart(ctx_, {
      type: "line",
      data: {
        labels: monthNames,
        type: "line",
        defaultFontFamily: "Poppins",
        datasets: [
          {
            data: totalRevenueArray,
            label: "Sales",
            backgroundColor: "rgba(0,103,255,.15)",
            borderColor: "rgba(0,103,255,0.5)",
            borderWidth: 3.5,
            pointStyle: "circle",
            pointRadius: 5,
            pointBorderColor: "transparent",
            pointBackgroundColor: "rgba(0,103,255,0.5)",
          },
        ],
      },
      options: {
        responsive: true,
        tooltips: {
          mode: "index",
          titleFontSize: 12,
          titleFontColor: "#000",
          bodyFontColor: "#000",
          backgroundColor: "#fff",
          titleFontFamily: "Poppins",
          bodyFontFamily: "Poppins",
          cornerRadius: 3,
          intersect: false,
        },
        legend: {
          display: false,
          position: "top",
          labels: {
            usePointStyle: true,
            fontFamily: "Poppins",
          },
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              scaleLabel: {
                display: false,
                labelString: "Month",
              },
              ticks: {
                fontFamily: "Poppins",
              },
            },
          ],
          yAxes: [
            {
              display: true,
              gridLines: {
                display: false,
                drawBorder: false,
              },
              scaleLabel: {
                display: true,
                labelString: "Sales in dollor",
                fontFamily: "Poppins",
              },
              ticks: {
                fontFamily: "Poppins",
              },
            },
          ],
        },
        title: {
          display: false,
        },
      },
    });
  }
}

function getStartOfWeek(date) {
  let startOfWeek = new Date(date);
  startOfWeek.setDate(date.getDate() - date.getDay());
  return startOfWeek;
}

function getEndOfWeek(date) {
  let endOfWeek = new Date(date);
  endOfWeek.setDate(date.getDate() + (6 - date.getDay()));
  return endOfWeek;
}

function generateColors(numColors) {
  let colors = [];
  for (let i = 0; i < numColors; i++) {
    let lightness = 50 + i * (40 / numColors); // Adjust lightness based on the number of colors
    colors.push(`hsla(210, 100%, ${lightness}%, 0.9)`); // Hue 210 represents blue
  }
  return colors;
}
