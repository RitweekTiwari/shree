<?php
                                        $c=1;
                                        foreach ($frc_data as $value) { ?>
                  <tr class="gradeU" id="tr_<?php echo $value['fc_id']?>">

                    <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['fc_id'] ?>"> <span class="label label-info"><?php echo $c?></span></td>
                    <td><?php $date=date_create($value['challan_date']); echo date_format($date,"d-m-y "); ?></td>

                    <td><?php echo $value['sub1'];?></td>
                    <td><?php echo $value['challan_no'];?></td>
                    <td><?php echo $value['doc_challan'];?></td>
                    <td><?php echo $value['fabric_type'];?></td>

                    <td><?php echo $value['total_quantity']?></td>

                    <td><?php echo $value['total_amount']?></td>
                    <td>

                      <a href="<?php if ($value['is_tc']==1){
                        $url= base_url('admin/segment/viewRecieve/');
                      }else{
                                  $url =     base_url('admin/FRC/viewRecieve/');
                      }
                      
                      echo $url.$value['fc_id'] ?> ">
                        <i class="fas fa-eye"></i>
                      </a>

                    </td>
                    <td>

                      <a href="<?php echo base_url('admin/FRC/ViewEditRecieve/').$value['fc_id'] ?> ">
                        <i class="fas fa-edit"></i>
                      </a>

                    </td>
                  </tr>

                  <?php $c=$c+1; } ?>