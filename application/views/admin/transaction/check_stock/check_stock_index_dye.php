<div class="container-fluid">



    <table class=" table-bordered  text-center " id="list">

        <thead class="bg-dark text-white">
            <tr>
                <th>From</th>
                <th>To God</th>
                <th>OBC</th>
                <th>Fabric</th>
                <th>Dye </th>
                <th>Matching</th>
                <th>Quantity</th>
                <th>Unit</th>

            </tr>
        </thead>
        <tbody>
        <tbody>
            <?php
            $c = 1;
            $qty = 0.0;
            foreach ($stock as $value) {
                $qty += $value['finish_qty'];
            ?>
                <tr>
                    <td><?php echo $value['from_godown']; ?></td>
                    <td><?php echo $value['to_godown']; ?></td>
                    <td><?php echo $value['order_barcode']; ?></td>
                    <td><?php echo $value['hsn'] ?></td>
                    <td><?php echo $value['fabric_name']; ?></td>
                    <td><?php echo $value['dye'] ?></td>
                    <td><?php echo $value['finish_qty'] ?></td>
                    <td><?php echo $value['unit'] ?></td>




                </tr>

            <?php $c = $c + 1;
            } ?>
        </tbody>
        </tbody>
        <tfoot>
            <tr>

                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Total</th>
                <th><?php echo $qty; ?></th>
                <th></th>
                <th></th>
                <th></th>



            </tr>
        </tfoot>
    </table>