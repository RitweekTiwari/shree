<div class="col-12">
    <div class="container row">

        <h4>Which segment do you want to choose?</h4><hr>
        <?php foreach ($segment as $value) { ?>
            <div class="form-check  form-check-inline">
                <input class="form-check-input check " type="checkbox" name="check[]"  value="<?php echo $value['id'] ?>">
                <h6>

                    <b> <?php echo $value['segmentName'] ?></b>:
                    <?php echo $value['fabricName'] ?>

                </h6>
            </div>
        <?php } ?>
    </div>
    <hr>
    <button type="button" id="next" class="btn btn-success ">Next</button>

    <hr>
</div>