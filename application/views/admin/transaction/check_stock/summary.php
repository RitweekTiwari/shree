<div class="row container">
    <div class="col-sm-12">
        <table class="table-bordered table-responsive">
            <tr>
                <th>From</th>
                <th>To </th>
                <th>Fabric</th>
                <th>Type</th>
                <th>Count</th>
            </tr>
            <tbody>
                <?php foreach ($stock as $row) { ?>
                    <tr>
                        <td> <?php echo $row['from_godown'] ?></td>
                        <td><?php echo $row['to_godown'] ?></td>
                        <td><?php echo $row['fabric_name'] ?></td>
                        <td><?php echo $row['fabricType'] ?></td>
                        <td><?php echo $row['COUNT(fabric.fabricType)'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>