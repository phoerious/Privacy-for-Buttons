<?php
/**
 * Model for Tweet button.
 *
 * @package Pfb::Models
 * @author Janek Bevendorff
 * @since 0.1
 */
class Pfb_Models_TweetButtonModel implements Pfb_Interfaces_Model
{
    /**
     * @since 0.1
     * @var string
     */
    private $referenceUrl;
    
    /**
     * @since 0.1
     * @var array
     */
    private $locales = array(
        'en' => array(
            'title' => 'Twitter For Websites: Tweet Button',
            'tweet' => 'Tweet',
        ),
        'de' => array(
            'title' => 'Twitter für Webseiten: Tweet-Schaltfläche',
            'tweet' => 'Twittern',
        ),
        'es' => array(
            'title' => 'Twitter para sitios web: Botón para Twittear',
            'tweet' => 'Twittear',
        ),
        'fr' => array(
            'title' => 'Twitter pour votre site web : bouton "Tweeter"',
            'tweet' => 'Tweeter',
        ),
        'it' => array(
            'title' => 'Tweeter per i siti web: Bottone Tweet',
            'tweet' => 'Tweet',
        ),
        'ja' => array(
            'title' => 'WEBサイト向けTwitter: ツイートボタン',
            'tweet' => 'ツイートする',
        ),
        'ko' => array(
            'title' => '트위터 웹버전: 트윗 버튼',
            'tweet' => '트윗',
        ),
        'pt' => array(
            'title' => 'Twitter para websites: Botão de Tweet',
            'tweet' => 'Tweetar',
        ),
        'ru' => array(
            'title' => 'Твиттер для веб-сайта: кнопка «Твитнуть»',
            'tweet' => 'Твитнуть',
        ),
        'tr' => array(
            'title' => 'Web siteleri için Twitter: Tweetle Butonu',
            'tweet' => 'Tweetle',
        )
    );
    
    /**
     * @since 0.1
     * @var array
     */
    private $currentTokenSet = array();
    
    /**
     * Constructor. Pass the reference URL for which you want the button
     * data for to this method.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $referenceUrl
     * @return void
     */
    public function __construct($referenceUrl) {
        $this->referenceUrl = $referenceUrl;
    }
    
    /**
     * Get counter for reference URL.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @return int
     */
    public function getCounter() {
        $provider = new Pfb_Provider_HttpProvider();
        $provider->setObjectSource('http://urls.api.twitter.com/1/urls/count.json?url=' . rawurlencode($this->referenceUrl) . '&callback=twttr.receiveCount');
        $json = json_decode(preg_replace('#.*(\{.+\}).*#s', '$1', $provider->requestObject('GET')->getBody()));
        return (int)$json->{'count'};
    }
    
    /**
     * Get array of localized strings for specified language.
     * Returns null if locale does not exist.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $lang
     * @return array | null
     */
    public function getLocales($lang) {
        if (isset($this->locales[$lang])) {
            return $this->locales[$lang];
        }
        return null;
    }
    
    /**
     * Return twitter background sprite image (raw data, not URL).
     * Returns false on failure.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $lang
     * @return string | bool
     */
    public function getBackgroundImage($lang) {
        // ensure language is known
        if (!array_key_exists($lang, $this->locales)) {
            return false;
        }
        
        // ensure tokens are available
        if (empty($this->currentTokenSet)) {
            $this->refreshTokenSet();
        }
        
        $provObj = $this->fetchBackgroundImage($lang);
        if (200 == $provObj->getStatus() || 304 == $provObj->getStatus()) {
            return $provObj->getBody();
        }
        
        // in case of error try it one (!) more time by
        // forcing token refetch from Twitter servers
        $this->refreshTokenSet(0);
        $provObj = $this->fetchBackgroundImage($lang);
        if (200 == $provObj->getStatus() || 304 == $provObj->getStatus()) {
            return $provObj->getBody();
        }
        
        return false;
    }
    
    /**
     * Do the actual fetching of Tweet button background from Twitter servers.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $lang
     * @return Pfb_Interfaces_ProviderObject
     */
    protected function fetchBackgroundImage($lang) {
        $token =  '_' . $lang . '.' . $this->currentTokenSet[$lang];
        if ($lang == 'en' || $lang == 'it') {
            $token =  '.' . $this->currentTokenSet[$lang];
        }
        $provider = new Pfb_Provider_HttpProvider();
        $provider->setObjectSource('http://platform0.twitter.com/widgets/images/tweet' . $token . '.png');
        return $provider->requestObject('GET');
    }
    
    /**
     * Fetch current set of tokens for background images and save it to currentTokenSet.
     * Hardcoded default cache time is 12 hours. ONLY CHANGE THIS IF REALLY NEEDED!
     * We respect Twitter and therefore we don't want to flood their website.
     *
     * NOTE: Tokens seem to be always the same. Therefore this method currently
     * returns static values and doesn't actually fetch anything from Twitter.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param int $cacheTime
     * @return void
     */
    protected function refreshTokenSet($cacheTime = 43200) {
        // since tokens seem to be always the same, use these static ones instead
        // of calling Twitter. Let's see if this is forever
        $this->currentTokenSet = array(
            'en' => 'dfbf1dd98bad9f5b5addd80494650dca',
            'it' => 'dfbf1dd98bad9f5b5addd80494650dca',
            'es' => '5be0ba7f2b232a8e61a302d0c2058362',
            'fr' => '9d531c89ee510e26982dc999404bddf4',
            'de' => '50586538507186f962a4f53a6d49657a',
            'ja' => '5019a315326fc162fb7f2fffb0871496',
            'ko' => '6c19c741ebc8fdceda460706d7ac9ace',
            'ru' => '9a8165f1c69c2cc7354938892154fc88',
            'pt' => '0b90ff8d7430a8916a872195262985b1',
            'tr' => '2aa67c27a2804fbc170330e90e2d43d2'
        );
        return;
        
        // code for fetching tokens from Twitter – currently we don't need this.
        $provider = new Pfb_Provider_HttpProvider($cacheTime);
        $provider->setObjectSource('http://platform0.twitter.com/widgets/tweet_button.html');
        $resultPage = $provider->requestObject('GET')->getBody();
        
        preg_match_all('#/widgets/images/tweet(?:_([a-z]{2}))?\.([0-9a-f]{32})\.png#Ui', $resultPage, $tokens, PREG_SET_ORDER);
        foreach ($tokens as $t) {
            if ($t[1] == '') {
                $this->currentTokenSet['en'] = $t[2];
                $this->currentTokenSet['it'] = $t[2];
                continue;
            }
            $this->currentTokenSet[$t[1]] = $t[2];
        }
    }
}