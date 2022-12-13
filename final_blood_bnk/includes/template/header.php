<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_name; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="BFCAI IS TEAM" />
    <meta name="description" content="Blood Bank" />
    <meta name="keywords" content="html,css,js,jquery" />
    <!-- Page icon Link -->
    <link rel="icon" href="img/favicon2.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri&family=Cairo&family=Readex+Pro&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $cssPath?>all.min.css">
    <!-- Owl.carousel Plugin -->
    <link rel="stylesheet" href="<?php echo $cssPath?>owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $cssPath?>owl.theme.default.min.css">
    <!-- Wow js library-->
    <link rel="stylesheet" href="<?php echo $cssPath?>animate.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo $cssPath?>bootstrap.min.css">
    
    <?php
    if($style == "bloodForm.css" || $style == "donarQues.css"){?>
        <link rel="stylesheet" href="<?php echo $cssPath?>swiper-bundle.min.css" />
    <?php } 

if($style == "NewsStory_1.css" || $style == "history.css" || $style == "NewsStory.css" || $style == "dash-buy-blood.css" || $style == "dash-buy-vacine.css" || $style == "vac.css"){?>
        <link rel="stylesheet" href="<?php echo $cssPath?>semantic.min.css" />
        <?php } 
    
    ?>

<!-- Main Css File -->
<link rel="stylesheet" href="<?php echo $cssPath?>toastr.min.css">
    <link rel="stylesheet" href="<?php echo $cssPath?><?php echo $style ?>">

    <style>
        body و *{
            font-family: 'Cairo', sans-serif !important;
        }
        h1,h2,h3,h5,h4,h6,p,span,input,select,button,div{
        font-family: 'Cairo', sans-serif !important;
        }
    </style>   

        
    <script src="<?php echo $jsPath?>jquery-3.5.1.min.js"></script>
    <script src="<?php echo $jsPath?>toastr.min.js"></script>
</head>
<body>
