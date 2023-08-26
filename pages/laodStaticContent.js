let doc = document.querySelector('.page-wrapper div:first-child ').innerHTML =
`


<header class="header-desktop3 d-none d-lg-block ">
<div class="section__content section__content--p35">
  <div class="header3-wrap">
    <div class="header__logo">

      <!-- <to-do> ADD a link to the home page</to-do> -->

      <a href="../../../index.php">
        <img src="../../../images/logo.png" style= "filter: invert(100%);
        "alt="Presento" />
      </a>
    </div>
    <div class="header__navbar">
      <ul class="list-unstyled">
        <li>
          <a href="../sales/">
            <i class="fa-sharp fa-regular fa-money-bill-trend-up"></i>dashboard
            <span class="bot-line"></span>
          </a>
        </li>
        <li>
          <a href="../products/">
            <i class="fa-regular fa-boxes-stacked"></i>
            <span class="bot-line"></span>Products</a>
        </li>
        <li>
          <a href="../categories/">
            <i class="fa-regular fa-grid-horizontal"></i>
            <span class="bot-line"></span>Categories</a>
        </li>
        <li>
          <a href="../user/">
            <i class="fa-regular fa-users"></i>
            <span class="bot-line"></span>Users</a>
        </li>
        <li>
          <a href="../orders/">
            <i class="fa-regular fa-cart-circle-arrow-down"></i>
            <span class="bot-line"></span>Orders</a>
        </li>
      </ul>
    </div>
    <div class="header__tool">
      <div class="account-wrap">
        <div class="account-item account-item--style2 clearfix js-item-menu">
          <div class="content">
            <a class="js-acc-btn"><span class="dyName"> john doe</span> &nbsp;&nbsp;</a>
          </div>
          <div class="account-dropdown js-dropdown">
            <div class="info clearfix curser-defult">
              <div class="content ">
                <h5 class="name">
                  <span class="dyName">john doe</span>
                </h5>
                <span class="email dyEmail">johndoe@example.com</span>
              </div>
            </div>
            <div class="account-dropdown__body">
              <div class="account-dropdown__item">
                <a href="../account">
                  <i class="zmdi zmdi-account"></i>Account</a>
              </div>

            </div>
            <div class="account-dropdown__footer">
              <a class="logOut">
                <i class="zmdi zmdi-power"></i>Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</header>
<!-- END HEADER DESKTOP-->

<!-- HEADER MOBILE-->

<header class="header-mobile header-mobile-2 d-block d-lg-none">
<div class="header-mobile__bar">
  <div class="container-fluid">
    <div class="header-mobile-inner">
      <a class="logo" href="index.html">
        <img src="../../../images/logo.png" style= "filter: invert(100%);
        " />
      </a>
      <button class="hamburger hamburger--slider" type="button">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button>
    </div>
  </div>
</div>
<nav class="navbar-mobile">
  <div class="container-fluid">
    <ul class="navbar-mobile__list list-unstyled">
      <li>
        <a href="../sales/">
          <i class="fa-sharp fa-regular fa-money-bill-trend-up"></i>dashboard
          <span class="bot-line"></span>
        </a>
      </li>
      <li>
        <a href="../products/">
          <i class="fa-regular fa-boxes-stacked"></i>
          <span class="bot-line"></span>Products</a>
      </li>
      <li>
        <a href="../categories/">
          <i class="fa-regular fa-grid-horizontal"></i>
          <span class="bot-line"></span>Categories</a>
      </li>
      <li>
        <a href="../user/">
          <i class="fa-regular fa-users"></i>
          <span class="bot-line"></span>Users</a>
      </li>
      <li>
        <a href="../orders/">
          <i class="fa-regular fa-cart-circle-arrow-down"></i>
          <span class="bot-line"></span>Orders</a>
      </li>
    </ul>
  </div>
</nav>
</header>
<div class="sub-header-mobile-2 d-block d-lg-none">
<div class="header__tool">
  <div class="account-wrap">
    <div class="account-item account-item--style2 clearfix js-item-menu">
      <div class="content">
        <a class="js-acc-btn "><span class="dyName">john doe</span>&nbsp; </a>
      </div>
      <div class="account-dropdown js-dropdown">
        <div class="info clearfix">
          <div class="content">
            <h5 class="name">
              <a href="#" class="dyName">john doe</a>
            </h5>
            <span class="email dyEmail">johndoe@example.com</span>
          </div>
        </div>
        <div class="account-dropdown__body">
          <div class="account-dropdown__item">
            <a href="#">
              <i class="zmdi zmdi-account"></i>Account</a>
          </div>
        </div>
        <div class="account-dropdown__footer">
          <a class="logOut">
            <i class="zmdi zmdi-power"></i>Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>`;


let footer = document.querySelector('#footer').innerHTML = `
<div class="container">
<div class="row">
  <div class="col-md-12">
    <div class="copyright p-b-10">
      <p>Copyright © 2023 Our Team. All rights reserved.</p>
    </div>
  </div>
</div>
</div>`;

