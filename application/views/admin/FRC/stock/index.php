                       <caption style='caption-side : top' class=" text-info">
                         <h6 class="text-center"> <?php echo $caption; ?></h6>
                       </caption>
                       <thead class="bg-dark text-white">
                         <tr class="odd" role="row">
                           <th>Select<input type="checkbox" class="sub_chk" id="master"></th>

                           <th>Date</th>
                           <th>Challan No</th>
                           <th> To</th>
                           <th> From</th>
                           <th>Pbc</th>
                           <th>Fabric </th>

                           <th>Hsn </th>
                           <th>Fab Type</th>
                           <th>Color</th>
                           <th>Ad_no</th>
                           <th>Quantity</th>
                           <th>current qty</th>
                           <th>Unit </th>
                           <th>Rate </th>
                           <th>Total</th>
                           <th>Print</th>
                         </tr>
                       </thead>
                       <tbody>
                         <?php
                          if (isset($frc_data['data'])) {
                            $data = $frc_data['data'];
                          } else {
                            $data = $frc_data;
                          }
                          $c = 1;
                          $t = 0.0;
                          $q = 0.0;
                          $cq = 0.0;
                          foreach ($data as $value) {
                            if ($value['parent'] == '') {
                              $q += $value['stock_quantity'];
                            }
                            $cq += $value['current_stock'];
                            $t += $value['total_value'];
                          ?>
                           <tr class="<?php if ($value['parent'] == '') {
                                        echo ' text-primary';
                                      } ?>" id="tr_<?php echo $value['fsr_id'] ?>">

                             <td><input type="checkbox" class="sub_chk hover" data-id="<?php echo $value['fsr_id'] ?> ">
                             </td>

                             <td><?php $date = date_create($value['created_date']);
                                  echo date_format($date, "d-m-y "); ?>
                             </td>
                             <td><?php echo $value['challan_no'] ?></td>
                             <td><?php echo $value['challan_to'] ?></td>
                             <td><?php echo $value['challan_from'] ?></td>
                             <td><?php echo $value['parent_barcode']; ?></td>
                             <td><?php echo $value['fabricName']; ?></td>
                             <td><?php echo $value['hsn']; ?></td>
                             <td><?php echo $value['fabric_type'] ?></td>
                             <td><span class="label label-danger"><?php echo $value['color_name'] ?></span></td>
                             <td><?php echo $value['ad_no']; ?></td>
                             <td><?php echo $value['stock_quantity'] ?></td>
                             <td><span class="label label-danger"><?php echo $value['current_stock'] ?></span></td>
                             <td><?php echo $value['stock_unit'] ?></td>

                             <td><?php echo $value['purchase_rate']; ?></td>
                             <td><?php echo $value['total_value']; ?></td>
                             <td><a class="text-center tip hover" target="_blank" href="<?php echo base_url('admin/FRC/return_print/') . $value['fsr_id'] ?>">
                                 <i class="fa fa-print " aria-hidden="true"></i></a></td>
                           </tr>

                         <?php $c = $c + 1;
                          } ?>

                       </tbody>
                       <tfoot class="bg-dark text-white">
                         <tr>
                           <th>Total</th>
                           <th></th>
                           <th></th>
                           <th> </th>
                           <th></th>
                           <th> </th>

                           <th> </th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th><?php echo $q; ?></th>
                           <th><?php echo $cq; ?></th>
                           <th> </th>
                           <th> </th>
                           <th><?php echo $t; ?></th>
                           <th></th>
                           <th></th>
                         </tr>
                       </tfoot>