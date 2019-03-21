<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/admin/style.css">
    <title><?= $this->e($title) ?></title>


</head>
<body>

<?php $this->insert('admin::'.$layout) ?>

<script defer src="../js/vendor/jquery.js"></script>
<script defer src="../js/vendor/what-input.js"></script>
<script defer src="../js/vendor/foundation.js"></script>
<script defer src="../js/app.js" ></script>
</body>
</html>