<?php $bgImgPath = $this->path . '/?c=PlusOneButton&a=bgimage'; ?>
.pfb-plusOneButton * {
    margin: 0;
    padding: 0;
    outline: none;
    text-decoration: none;
}
.pfb-plusOneButton {
    display: block;
    position: relative;
    width: 50px;
}
.pfb-plusOneButton-button {
    background: url("<?php print $bgImgPath; ?>") no-repeat -204px 0;
    display: block;
    height: 20px;
}
.pfb-plusOneButton-button span {
    position: absolute;
    left: -9999em;
}
.pfb-plusOneButton-button:hover, .pfb-plusOneButton-button:focus {
    background-position: -255px 0;
}
.pfb-plusOneButton-button:active {
    background-position: -153px 0;
}

.pfb-tall .pfb-plusOneButton-counter {
    display: block;
    background: url("<?php print $bgImgPath ?>") no-repeat -255px -21px;
    color: #666;
    font: 17px Arial, Helvetica, sans-serif;
    height: 29px;
    margin-bottom: 5px;
    padding-top: 6px;
    text-align: center;
}
/**
.pfb-horizontal.pfb-plusOneButton {
    width: auto;
    height: 20px;
}
.pfb-horizontal .pfb-plusOneButton-button {
    float: left;
    width: 55px;
}
.pfb-horizontal .pfb-plusOneButton-counter a {
    background-position: right -145px;
    display: block;
    font: bold 12px/20px Arial,sans-serif;
    height: 20px;
    margin-right: -8px;
    min-width: 26px;
    padding-right: 4px;
    text-align: center;
}
.pfb-horizontal .pfb-plusOneButton-counter:hover, .pfb-horizontal .pfb-plusOneButton-counter:focus, .pfb-horizontal .pfb-plusOneButton-counter:active {
    background-position: 0 -166px;
}
.pfb-horizontal .pfb-plusOneButton-counter a:hover, .pfb-horizontal .pfb-plusOneButton-counter a:focus, .pfb-horizontal .pfb-plusOneButton-counter a:active {
    background-position: right -166px;
}
.pfb-horizontal .pfb-plusOneButton-counter {
    float: left;
    height: 20px;
    left: 58px;
    padding-left: 8px;
    position: absolute;
    top: 0;
}
*/