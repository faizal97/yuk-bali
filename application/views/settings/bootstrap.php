<?php
if (empty($gambar) || !isset($gambar)) {
    $gambar = '';
}
if (empty($title) || !isset($title)) {
    $title = 'Yuk Bali';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <script src="<?php echo base_url('bs4/jquery.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="<?php echo base_url('holderjs/holder.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('bs4/css/bootstrap.min.css') ?>">
    <script src="<?php echo base_url('bs4/js/bootstrap.min.js') ?>"></script>
    <link href="<?php echo base_url() ?>open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:500" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('summernote/dist/summernote-bs4.css') ?>">
	<script src="<?php echo base_url('summernote/dist/summernote-bs4.js') ?>"></script>
    <script src="<?php echo base_url() ?>js/ytapi.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
	<style>
    body {
        font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background-image:url('<?php echo $gambar ?>');
		background-size:1920px 1080px;
    }
    </style>
</head>
<body>
