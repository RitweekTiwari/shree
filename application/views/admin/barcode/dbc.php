<?php if(isset($list)){?>
  <div class="container-fluid">
  <div class="row">
   <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="widget-box">
              <div class="widget-title"><h5> Design Barcode List </h5><hr></div></br>
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                 <h5> Barcode:  &nbsp; &nbsp; <?php echo $list->barCode?></h5></br></div>
  <div class="row">
       <div class="col-6">
         <div class="row">
            <div class="col-sm-5"><h6>Design Name :</h6></div>
            <div class="col-sm-7"><?php echo $list->designName?></div>
            <div class="col-5"><h6>Design Series :</h6></div><div class="col-7"><?php echo $list->designSeries?></div>
            <div class="col-5"><h6>Design Code :</h6></div><div class="col-7"><?php echo $list->desCode?></div>
            <div class="col-5"><h6>Rate :</h6></div><div class="col-7"><?php echo $list->rate?></div>
            <div class="col-5"><h6>Stitch :</h6></div><div class="col-7"><?php echo $list->stitch?></div>
            <div class="col-5"><h6>Dye :</h6></div><div class="col-7"><?php echo $list->dye?></div>
            <div class="col-5"><h6>Matching :</h6></div><div class="col-7"><?php echo $list->matching?></div>
            <div class="col-5"><h6>Ht Catting Rate :</h6></div><div class="col-7"><?php echo $list->htCattingRate?></div>

            <div class="col-5"><h6>Fabric Name :</h6></div><div class="col-7"><?php echo $list->fabricName?></div>
            <div class="col-5"><h6>Design On :</h6></div><div class="col-7"><?php echo $list->designOn?></div>
        </div>
       </div>
       <div class="col-6">

          <img src="<?php echo base_url('upload/').$list->designPic?>" height="400px" width="400px">

      </div>
  </div>
 </div>
</div>
</div>
</div>
</div>
</div>

    <?php } ?>
