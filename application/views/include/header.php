<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <!-- <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> -->
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url() ?>assets/css/mystyle.css" rel="stylesheet" type="text/css">
    
  </head>
    
<body>
<div class="container" style="margin-top: 20px;"></div>
<div class="row content-box">
<p class="row" style="width: 75%; margin: auto; color: #ff0000;"><span style="color: #000000;"><strong><span class="style4"><a style="color: #000000;" href="https://orlokkanjuruhan.or.id">HOME</a></span></strong></span>&ensp;
<span style="color: #000000;"><strong><span class="style4"><a style="color: #000000;" href="https://orlokkanjuruhan.or.id/blog">NEWS INFO</a></span></strong></span>&ensp;
<span style="color: #000000;"><strong><span class="style4"><a style="color: #000000;" href="https://callsign.orlokkanjuruhan.or.id">DATA ANGGOTA</a></span></strong></span>&ensp;
<span style="color: #000000;"><strong><span class="style4"><a style="color: #000000;" href="https://orlokkanjuruhan.or.id/sekretariat">SEKRETARIAT</a></span></strong></span></p>
  <?php if ($this->session->has_userdata('email')) : ?>
    <div class="row" style="width: 100%; margin: auto;">
      <div class="col-md-12">
        <div class="topnav">
          <a href="<?php echo base_url('Data_Kecamatan') ?>">Data Kecamatan</a>
          <a href="<?php echo base_url('tambah') ?>">Tambah Data</a>
          <a href="<?php echo base_url('/') ?>">Daftar Anggota</a>
          <a href="<?php echo base_url('login/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  <?php endif ?>
  <div class="row content-box">
    <h4 class="title-content"><span id="title">DATABASE ANGGOTA ORARI LOKAL KANJURUHAN<br>KAB. MALANG JAWA TIMUR ( YC3ZKM )</span></h4>
  </div>
	