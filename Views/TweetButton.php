<?php if (!$this->buttonOnly) { ?><!DOCTYPE html>
<title><?php print $this->locales['title']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
html,body,div {margin: 0;padding: 0;}
<?php print $this->render('TweetButtonCSS'); ?>
</style>
<body>
<div><?php } ?>
    <span class="pfb-tweetButton pfb-<?php print $this->type; ?>" lang="<?php print $this->lang; ?>">
    <?php if ($this->type == 'vertical' || $this->type == 'horizontal') { ?>
        <span class="pfb-tweetButton-counter">
            <a<?php if (!$this->buttonOnly) { ?> target="_top"<?php } ?> href="http://twitter.com/search?q=<?php print rawurlencode($this->url); ?>"><?php print $this->count; ?></a>
        </span>
    <?php } ?>
        <span class="pfb-tweetButton-button">
            <a<?php if (!$this->buttonOnly) { ?> target="_top"<?php } ?> href="https://twitter.com/share?original_referer=<?php print rawurlencode($this->url); ?>&amp;source=tweetbutton&amp;text=Testpage&amp;url=<?php print rawurlencode($this->url); ?>">
                <span><?php print $this->locales['tweet']; ?></span>
            </a>
            <script type="text/javascript">
                document.getElementsByTagName('a')[document.getElementsByTagName('a').length - 1].onclick = function() {
                    window.open(this.href, 'tweetThis', 'scrollbars=yes,resizable=yes,toolbar=no,location=yes,height=550,width=420');
                    return false;
                };
            </script>
        </span>
    </span>
<?php if (!$this->buttonOnly) { ?></div><?php } ?>