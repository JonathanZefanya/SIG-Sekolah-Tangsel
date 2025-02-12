<!--
=========================================================
* Material Kit 2 - v3.0.4
=========================================================
* Product Page:  https://www.creative-tim.com/product/material-kit
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com
 =========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('home/_head') ?>
</head>

<body class="index-page bg-gray-200">
    <!-- Navbar -->
    <?= $this->include('home/_nav') ?>
    <!-- Header -->
    <?= $this->include('home/_header') ?>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
        <?= $this->include('home/_about') ?>
        <?= $this->include('home/_school') ?>
        <?= $this->include('home/_map') ?>
    </div>

    <!-- Footer -->
    <?= $this->include('home/_footer') ?>

    <?= $this->include('home/_script') ?>

</body>

</html>
