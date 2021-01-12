        </div> <!--container -->
        <script type="text/javascript" src="<?=JS_PATH;?>/jquery/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="<?=JS_PATH;?>/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=JS_PATH;?>/jquery/jquery.mask.min.js"></script>
        <script type="text/javascript" src="<?=JS_PATH;?>/bootstrap/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="<?=JS_PATH;?>/alert/sweetalert2.all.min.js"></script>
        <?php if ($controller === 'customer'): ?>
            <script type="text/javascript" src="<?=JS_PATH;?>/global/functions.js"></script>
            <script type="text/javascript" src="<?=JS_PATH;?>/jquery/validation/jquery.validate.min.js"></script>
            <script type="text/javascript" src="<?=JS_PATH;?>/jquery/validation/localization/messages_pt_BR.min.js"></script>
            <script type="text/javascript" src="<?=JS_PATH;?>/customer/customer.js"></script>
        <?php endif; ?>
    </body>
</html>