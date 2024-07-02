<footer class="footer">
  <div class="footer-links">
  
    <a href="<?= BASE_URL ?>/">Home</a>
    <a href="<?= BASE_URL ?>/browseByBrand">Browse by Brands</a>
    <a href="<?= BASE_URL ?>/contact-us">Contact Us</a>
    <a href="<?= BASE_URL ?>/List_prices">List your store prices.</a>
  </div>
  <div class="footer-copyright">
    &copy; 2024 Mobisewum. All rights reserved.
  </div>
</footer>

<style>
body{
    min-height: 100vh;
    position: relative;
    padding-bottom: 100px;
}
/* Footer Styles */
.footer {
    position: absolute;
    bottom: 0;
    width: 100%;
  background-color: #333; /* Dark background */
  color: #fff; /* White text */
  text-align: center; /* Center text */
  padding: 20px 0; /* Padding for top and bottom */
}

.footer-links {
  margin-bottom: 20px; /* Space between links and copyright text */
}

.footer-copyright {
  background-color: rgb(41, 41, 122); /* Dark background for copyright text */
  width: fit-content;
  padding: 10px 30px;
  border-radius: 8px;
  margin: 0 auto;
}

.footer-links a {
  color: #fff; /* White text for links */
  margin: 0 15px; /* Spacing between links */
  text-decoration: none; /* Remove underline from links */
}

.footer-links a:hover {
  text-decoration: underline; /* Underline links on hover */
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .footer-links a {
    display: block; /* Stack links vertically */
    margin: 10px 0; /* Space between vertical links */
  }
}

</style>