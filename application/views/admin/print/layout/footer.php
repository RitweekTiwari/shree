<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url('optimum/web/js/vendor/jquery-1.12.4.min.js'); ?>"></script>

<!-- printThis -->

<script type="text/javascript" src="<?php echo base_url('optimum/printThis/printThis.js'); ?>"></script>

<!-- demo -->
<script>
$(document).ready(function(){
    var head='<?php if(isset($head)){echo $head;}else{echo "";} ?>';
    var title='<?php if(isset($title)){echo $title;}else{echo "";} ?>';
    $('.PrintThis').printThis({header: head,pageTitle : title });
});
</script>

</body>

</html>
