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

            </thead>
            <tbody>
              <?php foreach ($flow as $row) { ?>

                <tr>
                  <td> <?php echo $row['order_date']  ?></td>
                  <td><?php echo $row['order_number']  ?></td>
                  <td><?php echo $row['total']  ?></td>
                  <td><?php echo $row['pglist']  ?></td>
                  <td><?php echo $row['pending']  ?></td>
                  <td><?php echo $row['cancel']  ?></td>
                  <td><?php echo $row['done']  ?></td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>