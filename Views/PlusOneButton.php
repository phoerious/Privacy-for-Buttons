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
    <?php if ($this->type == 'tall' || $this->type == 'medium' || $this->type == 'standard') { ?>
        <span class="pfb-plusOneButton-counter"><?php print $this->count; ?></span>
    <?php } ?>
        <a<?php if (!$this->buttonOnly) { ?> target="_top"<?php } ?> class="pfb-plusOneButton-button" href="https://twitter.com/share?original_referer=<?php print rawurlencode($this->url); ?>&amp;source=plusOneButton&amp;text=Testpage&amp;url=<?php print rawurlencode($this->url); ?>">
            <span>+1</span>
        </a>
    </span>
<?php if (!$this->buttonOnly) { ?></div><?php } ?>