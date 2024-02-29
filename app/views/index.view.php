<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>Mobisewum</title>
</head>

<body>
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
                <a class="nav__link" href="#">
                  Home
                </a>
              </li>
              <li class="list-item">
                <a class="nav__link" href="#">
                  Browse by Brands
                </a>
              </li>
              <li class="list-item">
                <a class="nav__link" href="#">
                  Mobile Stores
                </a>
              </li>
              <li class="list-item">
                <a class="nav__link" href="#">
                  Contact Us
                </a>
              </li>
              <li class="list-item">
                <a class="nav__link" href="#">
                  About Us
                </a>
              </li>
              <li class="list-item">
                <a class="nav__link" href="#">
                  List your store prices
                </a>
              </li>
            </ul>
          </nav>
        </section>
      </div>
    </header>
  </div>

  <div class="container">
    <main class="search-container">
      <form action="<?= BASE_URL ?>/mobiles" method="get" id="home-search">
        <div class="main-search">
          <input type="text" name="phone" id="search" placeholder="Enter Mobile Phone name ..." />
          <button type="submit">Search</button>
        </div>

        <button type="button" class="advanced-search">
          Advanced options
          <img src="./assets/images/arrow.png" class="a-s-i" alt="filter arrow" />
        </button>

        

        <div class="advanced-options">

          <div class="search-filer">
            <label for="SF-brand">Search by Brand:</label>
            <select name="brand" id="SF-brand">
              <option value="all">All</option>
              <option value="samsung">Samsung</option>
              <option value="apple">Apple</option>
            </select>
          </div>

          <div class="wrapper-price-range">
            
              <label for="">Price Range: </label>
              <p>Use slider or enter min and max price</p>
            
            <div class="price-input">
              <div class="field">
                <span>Min</span>
                <input type="number" class="input-min" value="0" name="p-min">
              </div>
              <div class="separator">-</div>
              <div class="field">
                <span>Max</span>
                <input type="number" class="input-max" value="759900" name="p-max">
              </div>
            </div>

            <div class="slider">
              <div class="progress"></div>
            </div>
            <div class="range-input">
              <input type="range" class="range-min" min="0" max="759900" value="0" step="1000">
              <input type="range" class="range-max" min="0" max="759900" value="759900" step="1000">
            </div>
          </div>

          <script>
            const advancedSearch = document.querySelector(".advanced-search");
            const advancedOptions = document.querySelector(".advanced-options");
            const aSI = document.querySelector(".a-s-i");
  
            advancedSearch.addEventListener("click", () => {
              advancedOptions.classList.toggle("active");
              aSI.classList.toggle("active");
            })
          </script>

          <style>
            ::selection {
              color: #fff;
              background: #1757b8;
            }

            .wrapper-price-range {
              width: 100%;
              margin: 20px auto;
            }

            .price-input {
              width: 100%;
              display: flex;
              margin: 10px 0 35px;
            }

            .price-input .field {
              display: flex;
              width: 100%;
              height: 45px;
              align-items: center;
            }

            .field input {
              width: 100%;
              height: 100%;
              outline: none;
              font-size: 19px;
              margin-left: 12px;
              border-radius: 5px;
              text-align: center;
              border: 1px solid #999;
              -moz-appearance: textfield;
              appearance: textfield;
            }

            input[type="number"]::-webkit-outer-spin-button,
            input[type="number"]::-webkit-inner-spin-button {
              -webkit-appearance: none;
            }

            .price-input .separator {
              width: 130px;
              display: flex;
              font-size: 19px;
              align-items: center;
              justify-content: center;
            }

            .slider {
              height: 5px;
              position: relative;
              background: #ddd;
              border-radius: 5px;
            }

            .slider .progress {
              height: 100%;
              left: 0;
              right: 0;
              position: absolute;
              border-radius: 5px;
              background: #2d6bf1;
            }

            .range-input {
              position: relative;
            }

            .range-input input {
              position: absolute;
              width: 100%;
              height: 5px;
              top: -5px;
              background: none;
              pointer-events: none;
              -webkit-appearance: none;
              -moz-appearance: none;
              appearance: none;
            }

            input[type="range"]::-webkit-slider-thumb {
              height: 17px;
              width: 17px;
              border-radius: 50%;
              background: #172fb8;
              pointer-events: auto;
              -webkit-appearance: none;
              box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            }

            input[type="range"]::-moz-range-thumb {
              height: 17px;
              width: 17px;
              border: none;
              border-radius: 50%;
              background: #17a2b8;
              pointer-events: auto;
              -moz-appearance: none;
              box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            }

            
          </style>

        </div>
      </form>
    </main>
  </div>

  <script src="./assets/js/app.js"></script>
  <script src="./assets/js/price-range.js"></script>
</body>

</html>