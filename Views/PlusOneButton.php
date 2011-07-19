<?php if (!$this->buttonOnly) { ?><!DOCTYPE html>
<title>Google +1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
html,body,div {margin: 0;padding: 0;}
/*<![CDATA[*/
<?php print $this->render('PlusOneButtonCSS'); ?>
/*]]>*/
</style>
<body>
<div><?php } ?>
    <span class="pfb-plusOneButton pfb-<?php print $this->type; ?>" lang="<?php print $this->lang; ?>">
    <?php if ($this->showCounter) { ?>
        <span class="pfb-plusOneButton-counter"><?php print $this->count; ?><?php if ($this->type != 'tall') { ?><span>&nbsp;</span><?php } ?></span>
    <?php } ?>
        <a<?php if (!$this->buttonOnly) { ?> target="_top"<?php } ?> class="pfb-plusOneButton-button" href="<?php print $this->path; ?>/?c=PlusOneButton&amp;a=original&amp;type=<?php print $this->type . '&amp;lang=' . $this->lang . '&amp;url=' . rawurlencode($this->url) . '&amp;showcounter=' . $this->showCounter; ?>">
            <span>+1</span>
        </a>
    </span>
    <script type="text/javascript">
        var link = document.getElementsByTagName('a')[document.getElementsByTagName('a').length - 1];
        link.onclick = function() {
            window.open(this.href, 'OriginalPlusOne', 'height=300,width=400');
            return false;
        };
    </script>
<?php if (!$this->buttonOnly) { ?></div><?php } ?>