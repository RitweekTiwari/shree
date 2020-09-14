<?php
                                        $id=1;
                                       

                                       

                                        
                                        foreach ($tc as $value2) { 
                                          ?>
                                        <tr >

                                          <td><input type="text" class="form-control "  value="<?php echo $id;?>" readonly></td>
                                          <td><input type="text" class="form-control " name="date[]" value="<?php
                                          echo $value2['date'];
                                              ?>" readonly></td>

                                          <td><input type="text" class="form-control " name="pbc[]" value="<?php echo $value2['pbc'];?>" readonly></td>
                                          <td><input type="text" class="form-control " name="fabric[]" value="<?php echo $value2['fabricName'];?>" readonly><input type="hidden"  name="fabric_id[]" value="<?php echo $value2['fabric_id'];?>" ></td>
                                           <td><input type="text" class="form-control " name="color[]" value="<?php echo $value2['color_name'];?>" readonly></td>
                                          
                                          <td><input type="text" class="form-control " name="sqty[]" value="<?php echo $value2['qty']?>" readonly></td>
                                          <td><input type="text" class="form-control " name="cqty[]" value="<?php echo $value2['current_stock']?>" readonly></td>
                                          <td><input type="text" class="form-control " name="unit[]" value="<?php echo $value2['stock_unit']?>" readonly></td>
                                          <td><input type="text" class="form-control " name="tc[]" value="<?php echo $value2['tc']?>" readonly></td>
                                          <input type="hidden"  name="ADNo[]" value="<?php echo $value2['ad_no'];?>" >
                                          <input type="hidden"  name="pcode[]" value="<?php echo $value2['purchase_code'];?>" >
                                          <input type="hidden"  name="prate[]" value="<?php echo $value2['purchase_rate'];?>" >
                                          <input type="hidden"  name="hsn[]" value="<?php echo $value2['hsn'];?>" >
                                          <input type="hidden"  name="fabType[]" value="<?php echo $value2['fabric_type'];?>" >
                                          <input type="hidden"  name="fsr_id[]" value="<?php echo $value2['fsr_id'];?>" >
                                        </tr>

                                        <?php 
                                         $id=$id+1;
                                        }
                                      
                                       
                                           ?>
                                           