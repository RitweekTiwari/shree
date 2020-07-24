<?php
                                        $id=1;
                                       

                                        
                                        foreach ($data as $value) { 
                                          ?>
                                        <tr  id="tr_<?php echo $value['trans_meta_id']?>">
                                          <td><?php echo $id?> <input type="hidden" name="id[]" value='<?php echo $value['trans_meta_id']?>'></td>
                                          <td><input type="text" class="form-control pbc" name="pbc[]" value="<?php echo $value['pbc']?>"  readonly></td>
                    <td><input type="text" class="form-control obc" name="obc[]" value="<?php echo $value['order_barcode']?>" readonly></td>
                    <td><input type="text" class="form-control "  value="<?php echo $value['order_number']?>"  readonly></td>
                    <td><input type="text"  class="form-control " value="<?php echo $value['fabric_name']?>" readonly></td>
                    <td><input type="text" class="form-control "  value="<?php echo $value['hsn']?>"  readonly></td>
                    <td><input type="text" class="form-control "  value="<?php echo $value['design_name']?>"  readonly></td>
                    <td><input type="text" class="form-control "  value="<?php echo $value['design_code']?>"  readonly></td>
                    <td><input type="text" class="form-control " value="<?php echo $value['dye']?>"  readonly></td>
                    <td><input type="text" class="form-control "  value="<?php echo $value['matching']?>"  readonly></td>
                    <td><input type="text" class="form-control" name="quantity[]" value="<?php echo $value['quantity']?>"  readonly></td>
                    <td><input type="text"  class="form-control unit " value="<?php echo $value['unit']?>" readonly>
                  
                                        </tr>

                                        <?php 
                                         $id=$id+1;
                                        }
                                      
                                       
                                           ?>