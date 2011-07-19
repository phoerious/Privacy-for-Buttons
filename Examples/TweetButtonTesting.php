<?php
ini_set('display_errors', false);
error_reporting(0);

header('Content-Type: text/html; charset=utf-8');
ini_set('zlib.output_compression', true);

require_once '../API/SocialMediaButtons.php';
$buttonFactory = new Pfb_API_SocialMediaButtons();

$tweetButton = $buttonFactory->getButton('TweetButton', 'http://www.example.com/');

// IMPORTANT: set this to your public (!) application path
// (that is the path the user types into his address bar, not the internal file system path)
// Pfb_Config::setConfig('publicApplicationPath', '/public/path/to/privacy/for/buttons');
?>
<!DOCTYPE html>
<title>Tweet Button Testing</title>
<style type="text/css">
<?php print $tweetButton->getButtonCSS(); ?>
iframe{display:block;margin:1em 0;}
</style>

<body>
<h1>Server-Side API Test:</h1>
<div>
    <?php if (!Pfb_Config::getConfig('publicApplicationPath')) { ?>
        <p style="color: #900; font-weight: bold;">You need to set <em>'publicApplicationPath'</em>!</p>
    <?php } ?>
    <p><em>Button valid for URL <strong>http://www.example.com/</strong></em></p>
    <p>This is my beautiful button:</p>
    <?php
        $tweetButton->setParam('lang', 'en');
        print $tweetButton->getButtonCode();
    ?>
    <p>And here the same horizontally:</p>
    <?php
        $tweetButton->setParam('type', 'horizontal');
        print $tweetButton->getButtonCode();
    ?>
    <p>Without counter:</p>
    <?php
        $tweetButton->setParam('type', 'none');
        print $tweetButton->getButtonCode();
    ?>
    <p>And now in Korean:</p>
    <?php
        $tweetButton->setParam('type', 'vertical');
        $tweetButton->setParam('lang', 'ko');
        print $tweetButton->getButtonCode();
    ?>
    <p>Do you like French?</p>
    <?php
        $tweetButton->setParam('type', 'vertical');
        $tweetButton->setParam('lang', 'fr');
        print $tweetButton->getButtonCode();
    ?>
    <p>…or Japanese?</p>
    <?php
        $tweetButton->setParam('type', 'vertical');
        $tweetButton->setParam('lang', 'ja');
        print $tweetButton->getButtonCode();
    ?>
</div>

<h1>Iframe Web API Test:</h1>
<div>
    <p>Finally all three variants in an Iframe via Web API:</p>
    <iframe style="border: none; height: 62px; width: 55px;" src="../?c=TweetButton&amp;url=http://www.example.com/&amp;type=vertical"></iframe>
    <iframe style="border: none; height: 20px; width: 110px;" src="../?c=TweetButton&amp;url=http://www.example.com/&amp;type=horizontal"></iframe>
    <iframe style="border: none; height: 20px; width: 55px;" src="../?c=TweetButton&amp;url=http://www.example.com/&amp;type=none"></iframe>
</div>