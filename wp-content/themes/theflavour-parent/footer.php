    <footer class="footer">
        <div class="container">
            <div class="row footer-nav">
                <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-0 col-xs-offset-0">
                    <?php tfuse_menu('footer'); ?>
                    <!--Footer Social-->
                    <div class="footer-socials">
                        <?php tfuse_footer_social(); ?>
                    </div>
                    <!--Copyright-->
                    <div class="copyright">
                        <?php echo tfuse_options('custom_copyright'); ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a class="anchor hidden" id="to-top" href="#page"><span class="tficon-row-up"></span></a>
</div><!-- /#page-->
<?php wp_footer(); ?>
</body>
</html>