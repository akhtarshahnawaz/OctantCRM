<div class="span8">


    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.7.1.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>


    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/filemanager/css/elfinder.min.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/filemanager/js/elfinder.min.js"></script>

    <!-- Mac OS X Finder style for jQuery UI smoothness theme (OPTIONAL) -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/filemanager/css/theme.css">
<?php


    $url= site_url('customerfiles').'/';
    $url= site_url('customerfiles').'/';

    ?>
    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
            var elf = $('#elfinder').elfinder({
                // lang: 'ru',             // language (OPTIONAL)
                url : '<?php echo base_url();?>assets/filemanager/php/connector.php?path=<?PHP echo $path; ?>&url=<?PHP echo $url; ?>',  // connector URL (REQUIRED)
                height : 500,
            }).elfinder('instance');
        });
    </script>
    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>
</div>