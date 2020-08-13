 <div class="container-fluid">
     <div class='row'>
         <div class="col-md-12">
             <div class="card">
                 <div class="card-body">
                     <div class='row'>
                         <div class="col-md-6">
                             <h4 class="card-title">SRC LIST</h4>
                         </div>
                         <div class="col-md-6 text-right"> <a href="<?php echo base_url('admin/SRC/show_src'); ?>">

                                 <h5>ADD New</h5>
                             </a></div>
                     </div>
                     <hr>
                     <table class="data-table table-bordered">
                         <thead>
                             <th>fabric</th>
                             <th>code</th>
                             <?php foreach ($grade as $value) : ?>
                                 <th><?php echo $value['grade']; ?></th>
                             <?php endforeach; ?>
                         </thead>
                         <tbody>
                             <?php foreach ($output as $val) : ?>
                                 <tr>
                                     <td><?php echo $val['fabric'] ?></td>
                                     <td><?php echo $val['code'] ?></td>

                                     <?php foreach ($grade as $value) : ?>
                                         <?php if (array_key_exists($value['grade'], $val['grade'])) : ?>
                                             <td><?php echo $val['grade'][$value['grade']]; ?></td>
                                         <?php else : ?>
                                             <td>N/A</td>
                                         <?php endif; ?>
                                     <?php endforeach; ?>
                                 </tr>
                             <?php endforeach; ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>
 </div>