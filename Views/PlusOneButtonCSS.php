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

.pfb-plusOneButton-counter {
    display: block;
    background: url("<?php print $bgImgPath ?>") no-repeat -255px -21px;
    color: #666;
    font: 17px Arial, Helvetica, sans-serif;
    height: 29px;
    margin-bottom: 5px;
    padding-top: 6px;
    text-align: center;
}

.pfb-tall .pfb-plusOneButton-button,
.pfb-tall .pfb-plusOneButton-counter{
    width: 50px;
}

.pfb-medium .pfb-plusOneButton-button,
.pfb-standard .pfb-plusOneButton-button,
.pfb-small .pfb-plusOneButton-button {
    background-position: -132px -21px;
    left: 0;
    position: absolute;
    top: 0;
    width: 32px;
}
.pfb-medium .pfb-plusOneButton-counter,
.pfb-standard .pfb-plusOneButton-counter,
.pfb-small .pfb-plusOneButton-counter {
    background-position: -207px -21px;
    left: 33px;
    font-size: 14px;
    height: 14px;
    margin-bottom: 0;
    margin-right: 2px;
    max-width: 45px;
    min-width: 8px;
    padding: 3px 6px 3px 12px;
    position: absolute;
    top: 0;
}
.pfb-medium .pfb-plusOneButton-counter span,
.pfb-standard .pfb-plusOneButton-counter span,
.pfb-small .pfb-plusOneButton-counter span {
    background: url("<?php print $bgImgPath ?>") no-repeat -252px -21px;
    height: 20px;
    position: absolute;
    left: 100%;
    top: 0;
    width: 2px;
}

.pfb-medium.pfb-plusOneButton {
    height: 20px;
}
.pfb-medium .pfb-plusOneButton-button:hover, .pfb-medium .pfb-plusOneButton-button:focus {
    background-position: -165px -21px;
}
.pfb-medium .pfb-plusOneButton-button:active {
    background-position: -99px -21px;
}

.pfb-standard.pfb-plusOneButton {
    height: 24px;
}
.pfb-standard .pfb-plusOneButton-button {
    background-position: -156px -58px;
    height: 24px;
    width: 38px;
}
.pfb-standard .pfb-plusOneButton-button:hover, .pfb-standard .pfb-plusOneButton-button:focus {
    background-position: -195px -58px;
}
.pfb-standard .pfb-plusOneButton-button:active {
    background-position: -117px -58px;
}
.pfb-standard .pfb-plusOneButton-counter {
    background-position: -235px -58px;
    height: 14px;
    max-width: 50px;
    min-width: 10px;
    left: 39px;
    padding: 5px 5px 5px 11px;
}
.pfb-standard .pfb-plusOneButton-counter span {
    background-position: -290px -58px;
    height: 24px;
}

.pfb-small.pfb-plusOneButton {
    height: 15px;
}
.pfb-small .pfb-plusOneButton-button {
    background-position: -100px -42px;
    height: 15px;
    width: 24px;
}
.pfb-small .pfb-plusOneButton-counter {
    background-position: -150px -42px;
    font-size: 10px;
    height: 11px;
    left: 26px;
    max-width: 35px;
    min-width: 3px;
    padding: 2px 5px 2px 10px;
}
.pfb-small .pfb-plusOneButton-counter span {
    background-position: -184px -42px;
    height: 15px;;
}
.pfb-small .pfb-plusOneButton-button:hover, .pfb-small .pfb-plusOneButton-button:focus {
    background-position: -125px -42px;
}
.pfb-small .pfb-plusOneButton-button:active {
    background-position: -75px -42px;
}