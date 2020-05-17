(function(window, undefined) {
    window.SocialShare = {};
    SocialShare.Networks = [{
            name: 'Facebook',
            class: 'facebook',
            icon: 'fl-icon-facebook',
            color: '3B5998',
            url: 'https://www.facebook.com/sharer.php?s=100&p[url]={url}&p[images][0]={img}&p[title]={title}&p[summary]={desc}'
        },
        // {
        //     name: 'Facebook (share dialog)',
        //     class: 'facebook',
        //      icon: 'fl-icon-facebook',
        //     url: 'https://www.facebook.com/dialog/share?app_id={app_id}&display=page&href={url}&redirect_uri={redirect_url}'
        // },
        {
            name: 'Twitter',
            class: 'twitter',
            icon: 'fl-icon-twitter',
            color: '55acee',
            url: 'https://twitter.com/intent/tweet?url={url}&text={title}&via={via}&hashtags={hashtags}'
        }, {
            name: 'Google+',
            class: 'google',
            icon: 'fl-icon-google',
            color: 'dd4b39',
            url: 'https://plus.google.com/share?url={url}',
        }, {
            name: 'Linked In',
            class: 'linkedin',
            icon: 'fl-icon-linkedin',
            color: '007bb5',
            url: 'https://www.linkedin.com/shareArticle?url={url}&title={title}',
        }, {
            name: 'Pinterest',
            class: 'pinterest',
            icon: 'fl-icon-pinterest',
            color: 'bd081c',
            url: 'https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}&is_video={is_video}&description={title}',
        }, {
            name: 'Email',
            class: 'email',
            icon: 'fl-icon-email',
            color: '0166ff',
            url: 'mailto:?subject={title}&body={url}',
        }, {
            name: 'Tumblr',
            class: 'tumblr',
            icon: 'fl-icon-tumblr',
            color: '35465c',
            url: 'https://www.tumblr.com/widgets/share/tool?canonicalUrl={url}&title={title}&caption={desc}',
        }, {
            name: 'Gmail',
            class: 'gmail',
            icon: 'fl-icon-gmail',
            color: 'dd5347',
            url: 'https://mail.google.com/mail/?ui=2&view=cm&fs=1&tf=1&su={title}&body={url}%0D%0A%0D%0A{desc}',
        }, {
            name: 'Wordpress',
            class: 'Wordpress',
            icon: 'fl-icon-wordpress',
            color: '464646',
            url: 'javascript:SocialShare.loadWP(\'{title}\',\'{url}\',\'{desc}\')'
        }, {
            name: 'Reddit',
            class: 'reddit',
            icon: 'fl-icon-reddit',
            color: 'ff4500',
            url: 'https://reddit.com/submit?url={url}&title={title}',
        }, {
            name: 'WhatsApp',
            class: 'whatsapp',
            icon: 'fl-icon-whatsapp',
            color: '12af0a',
            url: 'whatsapp://send?text={url}',
        }, {
            name: 'StumbleUpon',
            class: 'stumbleupon',
            icon: 'fl-icon-stumbleupon',
            color: 'ef4e23',
            url: 'http://www.stumbleupon.com/submit?url={url}&title={title}',
        }, {
            name: 'Aim',
            class: 'aim',
            icon: 'fl-icon-aim',
            color: '00c2ff',
            url: 'http://share.aim.com/share/?url={url}&title={title}',
        }, {
            name: 'Aol Mail',
            class: 'aol',
            icon: 'fl-icon-aol',
            color: '2a2a2a',
            url: 'https://mail.aol.com/38719-111/aol-6/en-us/mail/compose-message.aspx?subject={title}&body={url}',
        }, {
            name: 'Balatarin',
            class: 'balatarin',
            icon: 'fl-icon-balatarin',
            color: '079948',
            url: 'https://www.balatarin.com/links/submit?phase=2&url={url}&title={title}',
        }, {
            name: 'bibsonomy',
            class: 'bibsonomy',
            icon: 'fl-icon-bibsonomy',
            color: '2a2a2a',
            url: 'http://www.bibsonomy.org/login?notice=login.notice.post.bookmark',
        }, {
            name: 'bitty',
            class: 'bitty',
            icon: 'fl-icon-bitty',
            color: '999',
            url: 'http://www.bitty.com/manual/?contenttype=&contentvalue={url}',
        }, {
            name: 'blinklist',
            class: 'blinklist',
            icon: 'fl-icon-blinklist',
            color: '3d3c3b',
            url: 'http://blinklist.com/',
        }, {
            name: 'Blogger',
            class: 'blogger',
            icon: 'fl-icon-blogger',
            color: 'fda352',
            url: 'https://www.blogger.com/blog-this.g?u={url}&n={title}&t={desc}',
        }, {
            name: 'blogmarks',
            class: 'blogmarks',
            icon: 'fl-icon-blogmarks',
            color: '535353',
            url: 'http://blogmarks.net/my/new.php?mini=1&simple=1&title={title}&url={url}',
        }, {
            name: 'bookmarks.fr',
            class: 'bookmarks.fr',
            icon: 'fl-icon-bookmarks_fr',
            color: '96c044',
            url: 'http://www.bookmarks.fr/favoris/AjoutFavori?action=add&address={url}&title={title}',
        }, {
            name: 'BuddyMarks',
            class: 'buddymarks',
            icon: 'fl-icon-buddymarks',
            color: '96c044',
            url: 'http://buddymarks.com/add_bookmark.php?bookmark_url={url}&bookmark_title={title}&bookmark_desc={desc}',
        }, {
            name: 'Box.net',
            class: 'box-net',
            icon: 'fl-icon-box',
            color: '1a74b0',
            url: 'https://www.box.net/api/1.0/import?url={url}&name={title}&description={desc}&import_as=link',
        }, {
            name: 'Buffer',
            class: 'buffer',
            icon: 'fl-icon-buffer',
            color: '2a2a2a',
            url: 'https://bufferapp.com/add?url={url}&text={title}',
        }, {
            name: 'Care2',
            class: 'care2',
            icon: 'fl-icon-care2',
            color: '6eb43f',
            url: 'http://www.care2.com/news/news_post.html?url={url}&title={title}&v=1.3',
        }, {
            name: 'CiteULike',
            class: 'citeulike',
            icon: 'fl-icon-citeulike',
            color: '2781cd',
            url: 'http://www.citeulike.org/posturl?url={url}&title={title}',
        }, {
            name: 'Delicious',
            class: 'delicious',
            icon: 'fl-icon-delicious',
            color: '39f',
            url: 'https://delicious.com/save?v=5&provider={provider}&noui&jump=close&url={url}&title={title}',
        }, {
            name: 'DesignFloat',
            class: 'designfloat',
            icon: 'fl-icon-designfloat',
            color: '8ac8ff',
            url: 'https://delicious.com/save?v=5&provider={provider}&noui&jump=close&url={url}&title={title}',
        }, {
            name: 'Diary.Ru',
            class: 'diary_ru',
            icon: 'fl-icon-diary_ru',
            color: '912d31',
            url: 'http://www.diary.ru/?newpost&title={title}&text={url}',
        }, {
            name: 'diaspora',
            class: 'didiasporaary_ru',
            icon: 'fl-icon-diaspora',
            color: '2e3436',
            url: 'https://www.addtoany.com/ext/diaspora/share?linkurl={url}&linkname={title}&linknote={desc}',
        }, {
            name: 'Digg',
            class: 'digg',
            icon: 'fl-icon-digg',
            color: '2a2a2a',
            url: 'http://digg.com/submit?url={url}&title={title}',
        }, {
            name: 'dihitt',
            class: 'dihitt',
            icon: 'fl-icon-dihitt',
            color: 'ff6300',
            url: 'http://dihitt.com.br?botao=enviar&url={url}&title={url}',
        },{
            name: 'diigo',
            class: 'diigo',
            icon: 'fl-icon-diigo',
            color: '4a8bca',
            url: 'http://www.diigo.com/post?url={url}&title={title}&desc={desc}',
        }, {
            name: 'douban',
            class: 'douban',
            icon: 'fl-icon-douban',
            color: '071',
            url: 'https://www.douban.com/recommend/?url={url}&title={title}&sel={desc}',
        }, {
            name: 'draugiem',
            class: 'draugiem',
            icon: 'fl-icon-draugiem',
            color: 'f60',
            url: 'https://www.draugiem.lv/say/ext/add.php?link={url}&title={title}',
        }, {
            name: 'EverNote',
            class: 'evernote',
            icon: 'fl-icon-evernote',
            color: '8be056',
            url: 'http://www.evernote.com/clip.action?url={url}',
        },  {
            name: 'Facebook Messenger',
            class: 'messenger',
            icon: 'fl-icon-facebook_messenger',
            color: '0084ff',
            url: 'https://www.facebook.com/dialog/send?app_id=5303202981&display=popup&link={url}&redirect_uri=https%3a%2f%2fstatic.addtoany.com%2fmenu%2fthanks.html%23url%3d{url}',
        }, {
            name: 'Fark',
            class: 'fark',
            icon: 'fl-icon-fark',
            color: '555',
            url: 'http://cgi.fark.com/cgi/fark/submit.pl?new_url={url}',
        },{
            name: 'FlipBoard',
            class: 'flipboard',
            icon: 'fl-icon-flipboard',
            color: 'c00',
            url: 'https://share.flipboard.com/bookmarklet/popout?v=2&title={title}&url={url}',
        },{
            name: 'Folkd',
            class: 'folkd',
            icon: 'fl-icon-folkd',
            color: '0f70b2',
            url: 'http://www.folkd.com/submit/{url}',
        },{
            name: 'Google Bookmarks',
            class: 'google_bookmarks',
            icon: 'fl-icon-google',
            color: '4285f4',
            url: 'https://www.google.com/bookmarks/mark?op=edit&bkmk={url}&title={title}&annotation={desc}',
        },{
            name: 'Google Classroom',
            class: 'google_classroom',
            icon: 'fl-icon-google_classroom',
            color: 'ffc112',
            url: 'https://classroom.google.com/share?url={url}',
        },{
            name: 'Hacker News',
            class: 'hackernews',
            icon: 'fl-icon-hackernews fa fa-hacker-news',
            color: 'f60',
            url: 'https://news.ycombinator.com/submitlink?u={url}&t={title}&sref=addtoany',
        },{
            name: 'Hatena',
            class: 'hatena',
            icon: 'fl-icon-hatena',
            color: '00a6db',
            url: 'http://b.hatena.ne.jp/bookmarklet?url={url}&btitle={title}',
        },{
            name: 'Houzz',
            class: 'houzz',
            icon: 'fl-icon-houzz',
            color: '7ac143',
            url: 'javascript:SocialShare.loadExtScript("https://www.houzz.com/js/clipperBookmarklet.js")',
        }, {
            name: 'InstaPaper',
            class: 'instapaper',
            icon: 'fl-icon-instapaper',
            color: '2a2a2a',
            url: 'http://www.instapaper.com/edit?url={url}&title={title}&description={desc}',
        },  {
            name: 'Jamespot',
            class: 'jamespot',
            icon: 'fl-icon-jamespot',
            color: 'ff9e2c',
            url: 'http://www.jamespot.com/?action=spotit&url={url}',
        }, {
            name: 'Kakao',
            class: 'kakao',
            icon: 'fl-icon-kakao',
            color: 'fcb700',
            url: 'https://story.kakao.com/share?url={url}',
        }, {
            name: 'Kik',
            class: 'kik',
            icon: 'fl-icon-kik',
            color: '2a2a2a',
            url: 'https://www.kik.com/send/article?url={url}&app_name=Share&title={title}&text=',
        },{
            name: 'Kindle',
            class: 'kindle',
            icon: 'fl-icon-kindle',
            color: '2a2a2a',
            url: 'http://fivefilters.org/kindle-it/send.php?url={url}',
        },{
            name: 'Known',
            class: 'known',
            icon: 'fl-icon-known',
            color: '2a2a2a',
            url: 'https://withknown.com/share/?url={url}&title={title}',
        },{
            name: 'Line',
            class: 'line',
            icon: 'fl-icon-line',
            color: '00c300',
            url: 'https://timeline.line.me/social-plugin/share?url={url}',
        }, {
            name: 'LiveJournal',
            class: 'livejournal',
            icon: 'fl-icon-livejournal',
            color: '113140',
            url: 'http://www.livejournal.com/update.bml?subject={title}&event={url}',
        }, {
            name: 'Mail.Ru',
            class: 'mail_ru',
            icon: 'fl-icon-mail_ru',
            color: '356fac',
            url: 'http://connect.mail.ru/share?url={url}&title={title}',
        }, {
            name: 'Mendeley',
            class: 'mendeley',
            icon: 'fl-icon-mendeley',
            color: 'a70805',
            url: 'http://www.mendeley.com/import/?url={url}',
        }, {
            name: 'meneame.net',
            class: 'meneame',
            icon: 'fl-icon-meneame',
            color: 'ff7d12',
            url: 'http://meneame.net/submit.php?url={url}',
        }, {
            name: 'Mixi',
            class: 'mixi',
            icon: 'fl-icon-mixi',
            color: 'd1ad5a',
            url: 'https://mixi.jp/share.pl?u={url}',
        }, {
            name: 'MySpace',
            class: 'myspace',
            icon: 'fl-icon-myspace',
            color: '2a2a2a',
            // url: 'https://myspace.com/post?u={url}&t={title}&c=desc',
            url: 'http://www.myspace.com/Modules/PostTo/Pages/?u={url}&t={title}&l=3&c={desc}',
        }, {
            name: 'Netlog',
            class: 'netlog',
            icon: 'fl-icon-netlog',
            color: '2a2a2a',            
            url: 'http://www.netlog.com/go/manage/links/view=save&origin=external&url={url}&title={title}&description={desc}',
        }, {
            name: 'Netvouz',
            class: 'netvouz',
            icon: 'fl-icon-netvouz',
            color: '6c3',            
            url: 'http://www.netvouz.com/action/submitBookmark?url={url}&title={title}&popup=no&description={desc}',
        }, {
            name: 'NewsVine',
            class: 'newsvine',
            icon: 'fl-icon-newsvine',
            color: '055d00',
            url: 'http://www.newsvine.com/_tools/seed&save?u={url}',
        }, {
            name: 'Nujij',
            class: 'nujij',
            icon: 'fl-icon-nujij',
            color: 'd40000',            
            url: 'http://www.nujij.nl/jij.lynkx?u={url}&t={title}',
        },{
            name: 'Odnoklassniki',
            class: 'odnoklassniki',
            icon: 'fl-icon-odnoklassniki',
            color: 'f2720c',            
            url: 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl={url}',
        }, {
            name: 'oknotizie',
            class: 'oknotizie',
            icon: 'fl-icon-oknotizie',
            color: '88d32d',            
            url: 'http://oknotizie.virgilio.it/post?url={url}&amp;title={title}',
        }, {
            name: 'Outlook.com',
            class: 'outlook',
            icon: 'fl-icon-outlook_com',
            color: '0072c6',            
            url: 'https://mail.live.com/?rru=compose%3Fsubject%3D{title}%26body%3D{url}',
        }, {
            name: 'Papaly',
            class: 'papaly',
            icon: 'fl-icon-papaly',
            color: '3ac0f6',            
            url: 'https://papaly.com/api/share.html?url={url}&title={title}',
        }, {
            name: 'Pinboard',
            class: 'pinboard',
            icon: 'fl-icon-pinboard',
            color: '1341de',            
            url: 'https://pinboard.in/add?next=same&url={url}&title={title}&description={desc}',
        }, {
            name: 'Plurk',
            class: 'plurk',
            icon: 'fl-icon-plurk',
            color: 'cf682f',            
            url: 'http://www.plurk.com/m?qualifier=shares&status={url}',
        }, {
            name: 'GetPocket',
            class: 'getpocket',
            icon: 'fl-icon-pocket',
            color: 'ee4056',
            url: 'https://getpocket.com/save?url={url}',
        // }, {
        //     name: 'Polyvore',
        //     class: 'polyvore',
        //     icon: 'fl-icon-polyvore',
        //     color: '2a2a2a',
        //     url: "javascript:SocialShare.loadExtScript('//static.addtoany.com/menu/polyvore.js')",
        //      // url: "javascript:SocialShare.loadExtScript('"+CLOUDMLMSOFTWARE.siteUrl+"/files/js/polyvore.js')",
        // }, {
        }, {
            name: 'Protopage',
            class: 'protopage',
            icon: 'fl-icon-protopage',
            color: '413fff',
            url: 'http://www.protopage.com/add-button-site?url={url}&label=&type=page',
        }, {
            name: 'Pusha',
            class: 'pusha',
            icon: 'fl-icon-pusha',
            color: '0072b8',
            url: 'http://www.pusha.se/posta?url={url}',
        }, {
            name: 'QZone',
            class: 'qzone',
            icon: 'fl-icon-qzone',
            color: '2b82d9',
            url: 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={url}',
        }, {
            name: 'Rediff',
            class: 'rediff',
            icon: 'fl-icon-rediff',
            color: 'd20000',
            url: 'http://share.rediff.com/bookmark/addbookmark?bookmarkurl={url}&title={title}',
        }, {
            name: 'Refind',
            class: 'refind',
            icon: 'fl-icon-refind',
            color: '1492ef',
            url: 'https://refind.com/?url={url}',
        }, {
            name: 'RenRen',
            class: 'renren',
            icon: 'fl-icon-renren',
            color: '005eac',
            url: 'http://widget.renren.com/dialog/share?resourceUrl={url}&srcUrl={url}&title={title}',
        }, {
            name: 'Segnalo',
            class: 'segnalo',
            icon: 'fl-icon-segnalo',
            color: 'ff6500',
            url: 'http://segnalo.virgilio.it/post.html.php?url={url}&title={title}',
        }, {
            name: 'Sina Weibo',
            class: 'sina-weibo',
            icon: 'fl-icon-sina_weibo',
            color: 'e6162d',
            url: 'http://v.t.sina.com.cn/share/share.php?url={url}&title={title}',
        }, {
            name: 'SiteJot',
            class: 'sitejot',
            icon: 'fl-icon-sitejot',
            color: 'ffc808',
            url: 'http://www.sitejot.com/addform.php?iSiteAdd={url}&iSiteDes={title}',
        },{
            name: 'Skype',
            class: 'skype',
            icon: 'fl-icon-skype',
            color: '00aff0',
            url: 'https://web.skype.com/share?url={url}',
        }, {
            name: 'Slashdot',
            class: 'slashdot',
            icon: 'fl-icon-slashdot',
            color: '004242',
            url: 'http://slashdot.org/submission?url={url}',
        }, {
            name: 'SMS',
            class: 'sms',
            icon: 'fl-icon-sms',
            color: '6cbe45',
            url: 'sms://?&body={title}%20{url}',
        }, {
            name: 'StockTwits',
            class: 'stocktwits',
            icon: 'fl-icon-stocktwits',
            color: '40576f',
            url: 'https://stocktwits.com/widgets/share?body={title}%20{url}',
        }, {
            name: 'Stumpedia',
            class: 'stumpedia',
            icon: 'fl-icon-stumpedia',
            color: 'ffc808',
            url: 'http://www.stumpedia.com/submit?url={url}&title={title}',
        }, {
            name: 'Svejo',
            class: 'svejo',
            icon: 'fl-icon-svejo',
            color: '5bd428',
            url: 'http://svejo.net/story/submit_by_url?url={url}&title={title}&summary={desc}',
        }, {
            name: 'Telegram.me',
            class: 'telegramme',
            icon: 'fl-icon-telegram',
            color: '2ca5e0',
            url: 'https://telegram.me/share/url?url={url}&text={title}',
        }, {
            name: 'Symbaloo',
            class: 'Symbaloo',
            icon: 'fl-icon-symbaloo',
            color: '6da8f7',
            url: 'http://www.symbaloo.com/us/add/url={url}&type=rss&title={title}',
        }, {
            name: 'Threema',
            class: 'threema',
            icon: 'fl-icon-threema',
            color: '2a2a2a',
            url: 'threema://compose?text={title}%20{url}',
        }, {
            name: 'Trello',
            class: 'trello',
            icon: 'fl-icon-trello',
            color: '0079bf',
            url: 'https://trello.com/add-card?mode=popup&url={url}&name={title}&desc={desc}',
        }, {
            name: 'Tuenti',
            class: 'tuenti',
            icon: 'fl-icon-tuenti',
            color: '0075c9',
            url: 'http://www.tuenti.com/share?p=b5dd6602&url={url}',
        }, {
            name: 'Twiddla',
            class: 'twiddla',
            icon: 'fl-icon-twiddla',
            color: '2a2a2a',
            url: 'http://www.twiddla.com/New.aspx?url={url}&title={title}',
        }, {
            name: 'Typepad',
            class: 'typepad',
            icon: 'fl-icon-typepad',
            color: 'd2de61',
            url: 'http://www.typepad.com/services/quickpost/post?v=2&qp_show=ac&qp_title={title}&qp_href={url}',
        }, {
            name: 'Viadeo',
            class: 'viadeo',
            icon: 'fl-icon-viadeo',
            color: '2a2a2a',
            url: 'http://fr.viadeo.com/fr/widgets/share/preview?urlToBeShared={url}',
        }, {
            name: 'Viber',
            class: 'viber',
            icon: 'fl-icon-viber',
            color: '7c529e',
            url: 'viber://forward?text={url}',
        }, {
            name: 'VK',
            class: 'vk',
            icon: 'fl-icon-vk',
            color: '587ea3',
            url: 'http://oauth.vk.com/authorize?client_id=-1&redirect_uri={url}&display=widget&caption={title}',
        }, {
            name: 'Wanelo',
            class: 'wanelo',
            icon: 'fl-icon-wanelo',
            color: '9cb092',
            url: 'http://wanelo.com/p/save?url={url}&title={title}',
        }, {
            name: 'Webnews',
            class: 'webnews',
            icon: 'fl-icon-webnews',
            color: 'cc2512',
            url: 'http://www.webnews.de/einstellen?url={url}&title={title}',
        }, {
            name: 'WeChat',
            class: 'wechat',
            icon: 'fl-icon-wechat',
            color: '7bb32e',
            url: 'http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=http%3A//google.com&chld=H|0',
        }, {
            name: 'Wykop',
            class: 'wykop',
            icon: 'fl-icon-wykop',
            color: '367da9',
            url: 'https://www.wykop.pl/dodaj?url={url}',
        }, {
            name: 'Xing',
            class: 'xing',
            icon: 'fl-icon-xing',
            color: '165b66',
            url: 'https://www.xing.com/app/user?op=share&url={url}',
        }, {
            name: 'Yahoo Bookmarks',
            class: 'yahoo-bookmarks',
            icon: 'fl-icon-yahoo',
            color: '400090',
            url: 'http://bookmarks.yahoo.com/toolbar/savebm?u={url}&t={title}&ref=CloudMLMSoftware',
        }, {
            name: 'Yahoo Messenger',
            class: 'yahoo-messenger',
            icon: 'fl-icon-yim',
            color: '400090',
            url: 'ymsgr:sendim?+&m={url}',
        }, {
            name: 'Yahoo',
            class: 'yahoo',
            icon: 'fl-icon-yahoo',
            color: '400090',
            url: 'https://compose.mail.yahoo.com/?Subject={title}&body={url}',
        }, {
            name: 'Yoolink',
            class: 'yoolink',
            icon: 'fl-icon-yoolink',
            color: 'a2c538',
            url: 'http://go.yoolink.to/addorshare?url_value={url}&title={title}',
        }, {
            name: 'Youmob',
            class: 'youmob',
            icon: 'fl-icon-youmob',
            color: '3b599d',
            url: 'http://youmob.com/mob.aspx?mob={url}',
        }, {
            name: 'Yummly',
            class: 'yummly',
            icon: 'fl-icon-yummly',
            color: 'e16120',
            url: 'javascript:SocialShare.loadExtScript("https://www.yummly.com/js/yumlet.js")',
        }, {
            name: 'FriendFeed',
            class: 'friendfeed',
            icon: 'fl-icon-facebook',
            color: '417eca',
            url: 'http://friendfeed.com/?url={url}',
        }, {
            name: 'OK.ru',
            class: 'okru',
            icon: 'fl-icon-ok_ru',
            color: 'ef8200',
            url: 'https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl={url}&title={title}',
        }, {
            name: 'Douban',
            class: 'douban',
            icon: 'fl-icon-douban',
            color: '30A080',
            url: 'http://www.douban.com/recommend/?url={url}&title={title}',
        }, {
            name: 'Baidu',
            class: 'baidu',
            icon: 'fl-icon-baidu',
            color: 'e20a00',
            url: 'http://cang.baidu.com/do/add?it={title}&iu={url}',
        }, {
            name: 'Weibo',
            class: 'weibo',
            icon: 'fl-icon-sina_weibo',
            color: 'fa2f2f',
            url: 'http://service.weibo.com/share/share.php?url={url}&appkey=&title={text}&pic=&ralateUid=',
        },
    ];
    SocialShare.generateSocialUrls = function(opt) {
        if (typeof opt !== 'object') {
            return false;
        }
        var links = [],
            network;
        for (var i = 0; i < SocialShare.Networks.length; i++) {
            network = SocialShare.Networks[i];
            links.push({
                name: network.name,
                class: network.class,
                icon: network.icon,
                color: network.color,
                url: SocialShare.generateUrl(network.url, opt)
            });
        }
        return links;
    };
    SocialShare.generateUrl = function(url, opt) {
        var prop, arg, arg_ne;
        for (prop in opt) {
            arg = '{' + prop + '}';
            if (url.indexOf(arg) !== -1) {
                url = url.replace(new RegExp(arg, 'g'), encodeURIComponent(opt[prop]));
            }
            arg_ne = '{' + prop + '-ne}';
            if (url.indexOf(arg_ne) !== -1) {
                url = url.replace(new RegExp(arg_ne, 'g'), opt[prop]);
            }
        }
        return this.cleanUrl(url);
    };
    SocialShare.cleanUrl = function(fullUrl) {
        //firstly, remove any expressions we may have left in the url
        fullUrl = fullUrl.replace(/\{([^{}]*)}/g, '');
        //then remove any empty parameters left in the url
        var params = fullUrl.match(/[^\=\&\?]+=[^\=\&\?]+/g),
            url = fullUrl.split("?")[0];
        if (params && params.length > 0) {
            url += "?" + params.join("&");
        }
        return url;
    };
    SocialShare.doPopup = function(e) {
        e = (e ? e : window.event);
        var t = (e.target ? e.target : e.srcElement),
            width = t.data - width || 800,
            height = t.data - height || 500;
        // popup position
        var px = Math.floor(((screen.availWidth || 1024) - width) / 2),
            py = Math.floor(((screen.availHeight || 700) - height) / 2);
        // open popup
        var popup = window.open(t.href, "social", "width=" + width + ",height=" + height + ",left=" + px + ",top=" + py + ",location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1");
        if (popup) {
            popup.focus();
            if (e.preventDefault) e.preventDefault();
            e.returnValue = false;
        }
        return !!popup;
    },
    SocialShare.loadExtScript = function(a, b, c) {       
        var d = document.createElement("script");
        if (d.charset = "UTF-8",
        d.src = a,
        document.body.appendChild(d),
        "function" == typeof b)
            var e = setInterval(function() {
                var a = !1;
                try {
                    a = b.call()
                } catch (d) {}
                a && (clearInterval(e),
                c.call())
            }, 100)
    },
    SocialShare.openInNewTab = function(url) {      
      var win = window.open(url, '_blank');
      win.focus();
    },
    SocialShare.isURL = function(url) {          
          var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name and extension
          '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
          '(\\:\\d+)?'+ // port
          '(\\/[-a-z\\d%@_.~+&:]*)*'+ // path
          '(\\?[;&a-z\\d%@_.,~+&:=-]*)?'+ // query string
          '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
          return pattern.test(url);        
    },

    SocialShare.loadWP = function(title, url, desc) {       
        swal({
              title: "Post to WordPress",
              text: "Write your wordpress website URL:",
              type: "input",
              showCancelButton: true,
              closeOnConfirm: false,
              animation: "slide-from-top",
              inputPlaceholder: "Write something"
            },
            function(wpurl){
              if (wpurl === false) return false;

              if (wpurl === "") {
                swal.showInputError("You need to enter URL of your Wordpress Website!");
                return false
              }else if (SocialShare.isURL(wpurl) !== true){ 
                 swal.showInputError("You need to enter URL of your Wordpress Website!");
                return false
              }
              

              if (!!wpurl && !!wpurl.trim()) { //Check if url is not blank
                url = wpurl.trim(); //Removes blank spaces from start and end
                if (!/^(https?:)?\/\//i.test(wpurl)) { //Checks for if url doesn't match either of: http://example.com, https://example.com AND //example.com
                    wpurl = 'http://' + wpurl; //Prepend http:// to the URL
                }
            } else {
                 swal.showInputError("You need to enter URL of your Wordpress Website!");
                return false
            }

            finalURL = wpurl+"/wp-admin/press-this.php?u="+url+"&t="+title+"&s="+desc;

            console.log(finalURL);
               SocialShare.openInNewTab(finalURL);
               swal.close();

              // swal("Nice!", "You wrote: " + inputValue, "success");
            });
    };

})(window);
if ($('body .share_target').length) {
    $target_id = $('.share_target');
    $target_id.html('<ul class="icons-list sharelist"></ul>'); //clear!
    $target = $('.share_target .sharelist');
    var params = {
            url: $target_id.attr('data-url'),
            img: $target_id.attr('data-img'),
            title: $target_id.attr('data-title'),
            desc: $target_id.attr('data-desc'),
            redirect_url: $target_id.attr('data-rurl'),
            app_id: '723553184445369',
            via: $target_id.attr('data-via'),
            hashtags: $target_id.attr('data-hashtags')
        },
        links = SocialShare.generateSocialUrls(params);
    for (var i = 0; i < links.length; i++) {
        var link = links[i];
        console.log(link.image);
        $target.append('<li><a data-popup="tooltip" title="" data-original-title="' + link.name + '" class="sharer button btn-link ' + link.class + '" target="_blank" href="' + link.url + '" title="' + link.name + '" style="background-color:#' + link.color + '"><i class="a2a_svg ' + link.icon + '"></i></a></li>');
        // if(link.image){
        //     $target.append('<li><a data-popup="tooltip" title="" data-original-title="' + link.name + '" class="sharer button btn-link ' + link.class + '" target="_blank" href="' + link.url + '" title="' + link.name + '">'+link.image+'</a></li>');
        // }else if(link.icon){
        //     $target.append('<li><a data-popup="tooltip" title="" data-original-title="' + link.name + '" class="sharer button btn-link ' + link.class + '" target="_blank" href="' + link.url + '" title="' + link.name + '"><i class="'+link.icon+'"></i></a></li>');
        // }else{
        //     $target.append('<li><a data-popup="tooltip" title="" data-original-title="' + link.name + '" class="sharer button btn-link ' + link.class + '" target="_blank" href="' + link.url + '" title="' + link.name + '">'+link.name+'</a></li>');
        // }                   
    }
    // $target.find('a').on('click', SocialShare.doPopup);
}