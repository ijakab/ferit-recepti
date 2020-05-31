<?php

require_once '../start.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zadatak 1</title>
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
    />
    <style>

        .fighter-list .disabled {
            width: 150px;
            height: 150px;
            position:relative;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .fighter-list .disabled img {
            max-width:100%;
            max-height:100%;
        }

        .fighter-list .disabled .image_overlay{
            position:absolute;
            top:0;
            left:0;
            bottom:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.4);
        }

        .fighter-list .selected img {
            border: 5px solid black;
        }
        .win-border {
            border: 10px solid green;
        }
        .loss-border {
            border: 10px solid red;
        }

        .fighter-box {
            position: relative;
        }
        .fighter-box .edit-btn {
            position: absolute;
            top: 5px;
            left: 5px;
            z-index: 9;
        }
        .fighter-box .delete-btn {
            position: absolute;
            bottom: 5px;
            left: 5px;
            z-index: 9;
        }
    </style>
</head>
<body>