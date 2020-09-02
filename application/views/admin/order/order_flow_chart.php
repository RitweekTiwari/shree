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
              <th class="rotate">
                <p>OD DATE</p>
              </th>
              <th class="rotate">
                <p>ORDER NO</p>
              </th>
              <th class="rotate">
                <p>TOTAL</p>
              </th>
              <th class="rotate">
                <p>BALANCE</p>
              </th>
              <th class="rotate">
                <p>PENDING</p>
              </th>
              <th class="rotate">
                <p>CANCEL</p>
              </th>
              <th class="rotate">
                <p>PG LIST</p>
              </th>
              <?php foreach ($godown as $row) { ?>
                <th class="rotate">
                  <p><?php echo $row['subDeptName'] ?></p>
                </th>
              <?php } ?>
            </thead>
            <tbody>
              <tr>
                <td>12/04.2020</td>
                <td>ORD1</td>
                <td>12</td>
                <td>12</td>
                <td>12</td>
                <td>12</td>
                <td>12</td>
                <?php foreach ($godown as $row) { ?>
                  <td>
                    <p><?php echo $row['id'] ?></p>
                  </td>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('_order_flow_chart.php'); ?>