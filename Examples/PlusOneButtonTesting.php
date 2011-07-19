<?php
ini_set('display_errors', false);
error_reporting(0);

header('Content-Type: text/html; charset=utf-8');
ini_set('zlib.output_compression', true);

require_once '../API/SocialMediaButtons.php';
$buttonFactory = new Pfb_API_SocialMediaButtons();

$plusOneButton = $buttonFactory->getButton('PlusOneButton', 'http://www.example.com/');

// IMPORTANT: set this to your public (!) application path
// (that is the path the user types into his address bar, not the internal file system path)
// Pfb_Config::setConfig('publicApplicationPath', '/public//path/to/privacy/for/buttons');
Pfb_Config::setConfig('publicApplicationPath', '/pfb');
?>
<!DOCTYPE html>
<title>+1 Button Testing</title>
<style type="text/css">
<?php print $plusOneButton->getButtonCSS(); ?>
</style>

<body>
<h1>Server-Side API Test:</h1>
<div>
    <?php if (!Pfb_Config::getConfig('publicApplicationPath')) { ?>
        <p style="color: #900; font-weight: bold;">You need to set <em>'publicApplicationPath'</em>!</p>
    <?php } ?>
    <p><em>Button valid for URL <strong>http://www.example.com/</strong></em></p>
    <p>Tall Google +1 button:</p>
    <?php
        $plusOneButton->setParam('type', 'tall');
        print $plusOneButton->getButtonCode();
    ?>
    <p>Standard Google +1 button:</p>
    <?php
        $plusOneButton->setParam('type', 'standard');
        print $plusOneButton->getButtonCode();
    ?>
    <p>And a medium Google +1 button:</p>
    <?php
        $plusOneButton->setParam('type', 'medium');
        print $plusOneButton->getButtonCode();
    ?>
    <p>Without counter:</p>
    <?php
        $plusOneButton->setParam('type', 'medium');
        $plusOneButton->setParam('showCounter', false);
        print $plusOneButton->getButtonCode();
    ?>
    <p>And now in very small:</p>
    <?php
        $plusOneButton->setParam('type', 'small');
        
        $plusOneButton->setParam('showCounter', true);
        print $plusOneButton->getButtonCode();
    ?>
</div>

<h1>Iframe Web API Test:</h1>
<div>
    <p>Finally all variants with counter in an Iframe via Web API:</p>
    <iframe style="border: none; height: 60px; width: 50px;" src="../?c=PlusOneButton&amp;url=http://www.example.com/&amp;type=tall&amp;showcounter=1"></iframe>
    <iframe style="border: none; height: 24px; width: 106px;" src="../?c=PlusOneButton&amp;url=http://www.example.com/&amp;type=standard&amp;showcounter=1"></iframe>
    <iframe style="border: none; height: 20px; width: 90px;" src="../?c=PlusOneButton&amp;url=http://www.example.com/&amp;type=medium&amp;showcounter=1"></iframe>
    <iframe style="border: none; height: 15px; width: 70px;" src="../?c=PlusOneButton&amp;url=http://www.example.com/&amp;type=small&amp;showcounter=1"></iframe>
</div>