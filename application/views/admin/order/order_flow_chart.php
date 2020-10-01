<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="d-md-flex">
          <div>
            <h4 class="card-title"> All ORDERS List</h4>
            <h5 class="card-subtitle">Overview of all order details information</h5>
          </div>
        </div>
        <div>
          <hr>
          <table class="table-bordered text-center table-responsive ">
            <thead>
              <th class="">
                OD DATE
              </th>
              <th class="">
                ORDER NO
              </th>
              <th class="">
                BRANCH
              </th>
              <th class="">
                CUSTOMER
              </th>
              <th class="rotate">
                TOTAL
              </th>
              <th class="rotate">
                BALANCE
              </th>
              <th class="rotate">
                PENDING
              </th>
              <th class="rotate">
                CANCEL
              </th>
              <th class="rotate">
                PG LIST
              </th>
              <?php foreach ($godownlist as  $row) { ?>
                <th class="rotate">
                  <?php echo $row  ?>
                </th>
              <?php } ?>
            </thead>
            <tbody>
              <?php foreach ($chart as  $row) { ?>

                <tr>
                  <td> <?php echo $row['order_date']  ?></td>
                  <td><?php echo $row['order_number']  ?></td>
                  <td><?php echo $row['branch']  ?></td>
                  <td><?php echo $row['customer']  ?></td>
                  <td><?php echo $row['total']  ?></td>
                  <td><?php echo $row['pglist']  ?></td>
                  <td><?php echo $row['pending']  ?></td>
                  <td><?php echo $row['cancel']  ?></td>
                  <td><?php echo $row['done']  ?></td>
                  <?php foreach ($godownlist as $key => $row2) { ?>
                    <td><?php echo $row[$key]  ?></td>
                  <?php } ?>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>