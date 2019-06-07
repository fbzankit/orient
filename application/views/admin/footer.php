
<div class="footer-copyright-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="footer-copy-right">
                    <p>Copyright Â© <?php echo date('Y'); ?>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('ckedit');
</script>
<!-- summernote JS
                ============================================ -->
<script src="js/summernote/summernote.min.js"></script>
<script src="js/summernote/summernote-active.js"></script>
<!-- jquery
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//vendor/jquery-1.12.4.min.js"></script>
<!-- bootstrap JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//bootstrap.min.js"></script>
<!-- wow JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//wow.min.js"></script>
<!-- price-slider JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//jquery-price-slider.js"></script>
<!-- meanmenu JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//jquery.meanmenu.js"></script>
<!-- owl.carousel JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//owl.carousel.min.js"></script>
<!-- sticky JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//jquery.sticky.js"></script>
<!-- scrollUp JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//jquery.scrollUp.min.js"></script>
<!-- mCustomScrollbar JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url(); ?>includes/js//scrollbar/mCustomScrollbar-active.js"></script>
<!-- metisMenu JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//metisMenu/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>includes/js//metisMenu/metisMenu-active.js"></script>
<!-- morrisjs JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>includes/js//sparkline/jquery.charts-sparkline.js"></script>
<script src="<?php echo base_url(); ?>includes/js//sparkline/sparkline-active.js"></script>
<!-- calendar JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//calendar/moment.min.js"></script>
<script src="<?php echo base_url(); ?>includes/js//calendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>includes/js//calendar/fullcalendar-active.js"></script>
<!-- plugins JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js//plugins.js"></script>
<!-- main JS
            ============================================ -->
<script src="<?php echo base_url(); ?>includes/js/main.js"></script>
<!-- tawk chat JS
            ============================================ -->
<!--<script src="<?php echo base_url(); ?>includes/js/tawk-chat.js"></script>-->
<!--<script src="<?php echo base_url(); ?>includes/js/dropzone/dropzone.js"></script>-->

<!-- chosen JS
        ============================================ -->
    <script src="<?php echo base_url(); ?>includes/js/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url(); ?>includes/js/chosen/chosen-active.js"></script>

<!-- select2 JS
        ============================================ -->
    <script src="<?php echo base_url(); ?>includes/js/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url(); ?>includes/js/select2/select2-active.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $("#main-cat").change(function () {
            $("#sub-sub-cat").html('<option value="" selected="" disabled="">Select Sub Sub Category</option>');
//            $("#catId").html('<option value="" selected="" disabled="">Select Sub Sub Sub Category</option>');
            var selectedCategory = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>admin/product/getCategories",
                data: {catId: selectedCategory}
            }).done(function (data) {
                $("#sub-cat").html(data);

            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#sub-cat").change(function () {
            $("#sub-sub-cat").html('<option value="" selected="" disabled="">Select Sub Sub Sub Category</option>');
//            $("#catId").html('<option value="" selected="" disabled="">Select Sub Sub Sub Category</option>');
            var selectedCategory = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>admin/product/getCategories",
                data: {catId: selectedCategory}
            }).done(function (data) {
//            console.log(data);
                $("#sub-sub-cat").html(data);
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#sub-sub-cat").change(function () {
            var selectedCategory = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>admin/product/getCategories",
                data: {catId: selectedCategory}
            }).done(function (data) {
                console.log(data);
//                $("#catId").html(data);
            });
        });
    });
</script>
<script>
    // jQuery ".Class" SELECTOR.
    $(document).ready(function () {
        $('#getField').keypress(function (event) {
            return isNumber(event, this)
        });
    });
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
                (charCode != 45 || $(element).val().indexOf('-') != -1) && // “-” CHECK MINUS, AND ONLY ONE.
                (charCode != 46 || $(element).val().indexOf('.') != -1) && // “.” CHECK DOT, AND ONLY ONE.
                (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>





</body>

</html>