document.body.onload = fetchData();

function fetchData(){
  function FetchData() {
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
}

function renderData(data){
  console.log(data);
}