document.body.onload = renderData();

function renderData() {
  fetch("./php/getCartInfo.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({}),
  })
    .then((r) => r.json())
    .then((data) => renderProducts(data));
  }
let total_item = 0;
let total_price = 0;

function renderProducts(data){
  div = document.querySelector('.list-group');
  div.innerHTML = ' ';
  data.forEach(e => {
    let li = document.createElement('li');
    li.classList.add('list-group-item');
    total_item += e['quantity'];
    total_price += e['price'];
    li.innerHTML = `
    <div class="row">
      <div class="col-md-3">
        <img src="${e['pictureURL']},${e['picture']}" alt="${e['name']}" class="img-fluid">
      </div>
      <div class="col-md-6">
        <h4>${e['name']}</h4>
        <p class="mb-0">$${e['price']}</p>
      </div>
      <div class="col-md-3">
        <input type="number" class="qunatityInp form-control" value="${e['quantity']}" min="1">
        <button class="remove btn btn-sm btn-danger mt-2" data-id="${e['id']}">Remove</button>
      </div>
    </div>
    `
    document.querySelector('#total-items').textContent = `${total_item}`;
    document.querySelector('#sub-total').textContent = `${total_price}`;
    div.append(li);
  });
  document.querySelectorAll('.remove').forEach(e=>e.addEventListener('click' , handleRemove)) ;
  document.querySelectorAll('.qunatityInp').forEach(e=>{
    e.addEventListener('onchange' , handleQuantityChange)
  })
}
form = document.querySelector('.form');
form.addEventListener('submit' , handleOrder)
function handleQuantityChange(e){

}
function handleOrder(e){
  e.preventDefault();   
  fetch("./php/placeOrder.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(form.address.value),
  })
    .then((r) => r.json())
    .then((data) => console.log(data));
}



function handleRemove(e){

}
