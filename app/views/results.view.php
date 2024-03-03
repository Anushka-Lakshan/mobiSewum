<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>Mobisewum</title>
</head>

<body>
  <div class="result-header">
    <div class="container-nav">
      <header class="site-header">
        <div class="header__content--flow">
          <section class="header-content--left">
            <a href="#" class="brand-logo">
              <img src="./assets/images/logo.png" alt="Mobisewum logo" />
            </a>
            <button class="nav-toggle">
              <span class="toggle--icon"></span>
            </button>
          </section>
          <section class="header-content--right">
            <nav class="header-nav" role="navigation">
              <ul class="nav__list" aria-expanded="false">
                <li class="list-item">
                  <a class="nav__link" href="#">Home</a>
                </li>
                <li class="list-item">
                  <a class="nav__link" href="#">Browse by Brands</a>
                </li>
                <li class="list-item">
                  <a class="nav__link" href="#">Mobile Stores</a>
                </li>
                <li class="list-item">
                  <a class="nav__link" href="#">Contact Us</a>
                </li>
                <li class="list-item">
                  <a class="nav__link" href="#">About Us</a>
                </li>
                <li class="list-item">
                  <a class="nav__link" href="#">List your store prices</a>
                </li>
              </ul>
            </nav>
          </section>
        </div>
      </header>
    </div>

    <div class="container">

      <h1 class="results-readline">Results for: Samsung s22 ultra</h1>
      <p class="results-count">22 results found..</p>
    </div>
  </div>


  <div class="container">

    <div class="search-area">
      <form action="<?=BASE_URL?>/mobiles" method="get">
        <input type="text" name="phone" id="search" placeholder="Enter Mobile Phone name ..." />
        <button type="submit">Search</button>
      </form>
    </div>

  </div>

  </div>

  <main class="container search-content">

    <div class="filter-container">

      <button id="toggleButton" class="">Filter</button>

      

    <form action="<?=BASE_URL?>/mobiles" method="get" class="filter-card">
      <p>Filter options</p>

      <div class="filter-brand">
        <label for="result-brand">Search by Brand:</label>
        <select name="brand" id="result-brand">
          <option value="all">All</option>
          <option value="samsung">Samsung</option>
          <option value="apple">Apple</option>
        </select>
      </div>

      <div class="result-filter">
        <label for="result-sort">Sort by: </label>
        <select name="sort" id="result-sort">
          <option value="">Default</option>
          <option value="toHigh">Low to High</option>
          <option value="toLow">High to low</option>
        </select>
      </div>

      <div class="filter-price">
        <label for="min-price">
          Price Range:
        </label>

        <table>
          <tr>
            <td>
              <label for="min-price">Min :</label>
            </td>
            <td>
              <input type="number" name="min" id="min-price" />
            </td>
          </tr>

          <tr>
            <td>
              <label for="max-price">Max :</label>
            </td>
            <td>
              <input type="number" name="max" id="max-price" />

            </td>
          </tr>

          <input type="hidden" name="phone" value="<?=$_GET['phone'] ?? ''?>">


        </table>


      </div>

      <button type="submit">Filter</button>
    </form>

    <script>
      const toggleButton = document.getElementById("toggleButton");
      const form = document.querySelector("form.filter-card");

      toggleButton.addEventListener("click", () => {
          if (window.innerWidth < 950) {
              form.classList.toggle("hidden");
          }
      });
      </script>

    </div>


    <!-- search results start -->
    <div class="result-container">

      <div class="result-card">
        <div class="card-top">
          <div class="shop">
            <img src="./assets/images/company-logos/geniusMobile.png" alt="geniusMobile">
            <span>Genius Mobile</span>
          </div>

          <div class="item-count">
            6 mobiles
          </div>
        </div>

        <div class="card-bottom">
          <table class="item-table">
            <tr>
              <td>
                <img src="./assets/images/mobile-images/itest.jpg" alt="samsung-galaxy-s22-ultra">
              </td>
              <td>
                <a href="#">Samsung Galaxy S22 Ultra</a><span class="stock-badge">Out of stock</span>
              </td>
              <td>
                Rs.204,990.63
              </td>
            </tr>

            <tr>
              <td>
                <img src="./assets/images/mobile-images/itest.jpg" alt="samsung-galaxy-s22-ultra">
              </td>
              <td>
                <a href="#">Samsung Galaxy S22 Ultra</a>
              </td>
              <td>
                Rs.204,990.63
              </td>
            </tr>
          </table>
        </div>
      </div>


      <div class="result-card">
        <div class="card-top">
          <div class="shop">
            <img src="./assets/images/company-logos/geniusMobile.png" alt="geniusMobile">
            <span>Genius Mobile</span>
          </div>

          <div class="item-count">
            6 mobiles
          </div>
        </div>

        <div class="card-bottom">
          <table class="item-table">
            <tr>
              <td>
                <img src="./assets/images/mobile-images/itest.jpg" alt="samsung-galaxy-s22-ultra">
              </td>
              <td>
                <a href="#">Samsung Galaxy S22 Ultra</a><span class="stock-badge">Out of stock</span>
              </td>
              <td>
                Rs.204,990.63
              </td>
            </tr>

            <tr>
              <td>
                <img src="./assets/images/mobile-images/itest.jpg" alt="samsung-galaxy-s22-ultra">
              </td>
              <td>
                <a href="#">Samsung Galaxy S22 Ultra</a>
              </td>
              <td>
                Rs.204,990.63
              </td>
            </tr>
          </table>
        </div>
      </div>


      <div class="result-card">
        <div class="card-top">
          <div class="shop">
            <img src="./assets/images/company-logos/geniusMobile.png" alt="geniusMobile">
            <span>Genius Mobile</span>
          </div>

          <div class="item-count">
            6 mobiles
          </div>
        </div>

        <div class="card-bottom">
          <table class="item-table">
            <tr>
              <td>
                <img src="./assets/images/mobile-images/itest.jpg" alt="samsung-galaxy-s22-ultra">
              </td>
              <td>
                <a href="#">Samsung Galaxy S22 Ultra</a><span class="stock-badge">Out of stock</span>
              </td>
              <td>
                Rs.204,990.63
              </td>
            </tr>

            <tr>
              <td>
                <img src="./assets/images/mobile-images/itest.jpg" alt="samsung-galaxy-s22-ultra">
              </td>
              <td>
                <a href="#">Samsung Galaxy S22 Ultra</a>
              </td>
              <td>
                Rs.204,990.63
              </td>
            </tr>
          </table>
        </div>
      </div>


    </div>

  </main>



  <script src="./assets/js/app.js"></script>
  <script src="./assets/js/price-range.js"></script>
</body>

</html>