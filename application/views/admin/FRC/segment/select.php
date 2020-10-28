<div class="col-12">
    <div class="container row">

        <h4>Which segment do you want to choose?</h4>
        <hr>
        <?php foreach ($segment as $value) { ?>
            <div class="form-check  form-check-inline">
                <input class="form-check-input check " type="checkbox" name="check[]" data-id="<?php echo $value['segmentName'] ?>" value="<?php echo $value['metaId'] ?>">
                <h6>

                    <b> <?php echo ucfirst($value['segmentName'])  ?></b>:

                </h6>
            </div>
        <?php } ?>
    </div>
    <hr>
    <button type="button" id="next" class="btn btn-success ">Next</button>

    <hr>
</div>