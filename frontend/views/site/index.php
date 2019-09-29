<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

$this->registerJsFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyCF--7kPDlQxS69oFmn1J89T5Zb2g20DVA");

?>
<base href="/">
<div class="site-about">
    <div id="map" class="google-map-atm"></div>
</div>

<style>
    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>