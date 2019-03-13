<style type="text/css">
.carousel{
    /*background: #2f4357;*/
    margin-top: 20px;
}
.carousel .item{
    min-height: 280px; /* Prevent carousel from being distorted if for some reason image doesn't load */
}
.carousel .item img{
    margin: 0 auto; /* Align slide image horizontally center */
}
.bs-example{
  margin: 20px;
}
</style>
</head>
<body>
<div class="table-daftar-anggota">
   <div class="bs-example">
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
           <!-- Carousel indicators -->
           <ol class="carousel-indicators">
               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#myCarousel" data-slide-to="1"></li>
               <li data-target="#myCarousel" data-slide-to="2"></li>
           </ol>   
           <!-- Wrapper for carousel items -->
           <div class="carousel-inner">
               <div class="item active">
                   <img src="<?php echo base_url('assets/image/orari.png') ?>" width="100%">
               </div>
               <div class="item">
                   <img src="/examples/images/slide2.png">
               </div>
               <div class="item">
                   <img src="/examples/images/slide3.png">
               </div>
           </div>
           <!-- Carousel controls -->
           <a class="carousel-control left" href="#myCarousel" data-slide="prev">
               <span class="glyphicon glyphicon-chevron-left"></span>
           </a>
           <a class="carousel-control right" href="#myCarousel" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right"></span>
           </a>
       </div>
   </div> 
</div>

