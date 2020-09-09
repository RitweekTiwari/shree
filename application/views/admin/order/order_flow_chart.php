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
              <?php foreach ($godown as $row) { ?>
                <th class="rotate">
                  <?php echo $row['sortname'] ?>
                </th>
              <?php } ?>
            </thead>
            <tbody>
              <?php foreach ($godown as $row1) { ?>
               
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
                      <?php echo $row['id'] ?>
                    </td>
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