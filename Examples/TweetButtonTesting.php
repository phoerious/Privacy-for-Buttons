<?php
ini_set('display_errors', true);
error_reporting(E_ALL | E_STRICT);

header('Content-Type: text/html; charset=utf-8');
ini_set('zlib.output_compression', true);

require_once 'pfb/API/SocialMediaButtons.php';
$buttonFactory = new Pfb_API_SocialMediaButtons();

$tweetButton = $buttonFactory->getButton('TweetButton', 'http://www.refining-linux.org/archives/27/20-Multi-line-sed-search-and-replace/');
Pfb_Config::setConfig('publicApplicationPath', 'http://manko10.dyndns.org:8080/pfb');
?>
<!DOCTYPE html>
<title>Server-Side API Test</title>
<style type="text/css">
<?php print $tweetButton->getButtonCSS(); ?>
</style>

<body>
<h1>Server-Side API Test:</h1>
<div>
    <p><em>Button valid for URL <strong>http://www.refining-linux.org/archives/27/20-Multi-line-sed-search-and-replace/</strong></em></p>
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
    <iframe style="border: none; height: 62px; width: 55px;" src="http://manko10.dyndns.org:8080/pfb?c=TweetButton&amp;url=http://www.refining-linux.org/archives/27/20-Multi-line-sed-search-and-replace/&amp;type=vertical"></iframe>
    <iframe style="border: none; height: 20px; width: 110px;" src="http://manko10.dyndns.org:8080/pfb?c=TweetButton&amp;url=http://www.refining-linux.org/archives/27/20-Multi-line-sed-search-and-replace/&amp;type=horizontal"></iframe>
    <iframe style="border: none; height: 20px; width: 55px;" src="http://manko10.dyndns.org:8080/pfb?c=TweetButton&amp;url=http://www.refining-linux.org/archives/27/20-Multi-line-sed-search-and-replace/&amp;type=none"></iframe>
</div>