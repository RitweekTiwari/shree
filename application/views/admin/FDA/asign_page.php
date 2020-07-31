


                    <div>
                    <form >
                    <h4>Apply FDA: <?php echo $fabric_type; ?></h4>
                    <input type="hidden" name="fabric_type" value="<?php echo $fabric_type; ?>">
                    <input type="hidden" name="fabric_name" value="<?php echo $fabric_name; ?>">
                    </div>
                   <div class="">
                    <table class="table table-bordered data-table" id="table" id="fabric">
                        <thead>
                          <tr class="odd" role="row">
                            <td style="display:none;" ?></td>               
                           <th><b>Sr. No.</b></th>
                           <th><b>Design Name</b></th>
                           <th><b>Design Code</b></th>
                           <th><b>Stitch</b></th>
                          
                           
                         </tr>
                        </thead>
                      <tbody>
                        <?php $id=0; foreach($data_value as $value): $id++;?>
                        <tr class="gradeU" id="tr_<?php echo $value['id']?>">

                          <td style="display:none;" class="ui-widget-content"><?php echo $value['id']?></td>
                          <td><?php echo  $id;?></td>
                          <td><?php echo $value['designName'];?></td>
                          <td><?php echo $value['desCode']?></td>
                          <td><?php echo $value['stitch'] ?></td>
                         
             						</tr>
                      <?php endforeach;?>
                      </tbody>
                   </table>
                   </div>
                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  
                   <input type="submit" name="OK" class="btn btn-primary" value="Assign" id="asign"/>
                   </form>
                  
                   <?php include('asign_js.php'); ?>
