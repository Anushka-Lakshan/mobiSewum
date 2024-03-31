<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section class="header-content--left">
    <a href="<?= BASE_URL ?>/" class="brand-logo">
        <img src="<?= BASE_URL ?>/assets/images/logo.png" alt="Mobisewum logo" />
    </a>
    <button class="nav-toggle">
        <span class="toggle--icon"></span>
    </button>
</section>
<section class="header-content--right">
    <nav class="header-nav" role="navigation">
        <ul class="nav__list" aria-expanded="false">
            <li class="list-item">
                <a class="nav__link" href="<?= BASE_URL ?>/">
                    Home
                </a>
            </li>
            <li class="list-item">
                <a class="nav__link" href="<?= BASE_URL ?>/browseByBrand">
                    Browse by Brands
                </a>
            </li>
            
            <li class="list-item">
                <a class="nav__link" href="<?= BASE_URL ?>/contact-us">
                    Contact Us
                </a>
            </li>
            <li class="list-item">
                <a class="nav__link" href="#">
                    About Us
                </a>
            </li>
            <li class="list-item">
                <a class="nav__link" href="<?= BASE_URL ?>/List_prices">
                    List your store prices
                </a>
            </li>
        </ul>
    </nav>
</section>

<?php

if (isset($_SESSION['temp_msg'])) {
    echo '
                <script>
                    Swal.fire({
                        title: "' . $_SESSION['temp_msg'] . '",
                        text: "' . (isset($_SESSION['temp_msg_secondery']) ? $_SESSION['temp_msg_secondery'] : '') . '",
                        icon: "' . (isset($_SESSION['temp_msg_type']) ? $_SESSION['temp_msg_type'] : 'success') . '",
                        showCancelButton: false,
                        confirmButtonText: "Continue"
                    });
                </script>
                ';
    unset($_SESSION['temp_msg']);
    unset($_SESSION['temp_msg_secondery']);
    unset($_SESSION['temp_msg_type']);
}

?>