@php
	if (!empty($oCampaign)) {
		//permissions
		$bAllowComments = ($oCampaign->allow_comments == 1) ? true : false;
		$bAllowVideoComments = ($oCampaign->allow_video_reviews == 1) ? true : false;
		$bAllowHelpful = ($oCampaign->allow_helpful_feedback == 1) ? true : false;
		$bAllowLiveReading = ($oCampaign->allow_live_reading_review == 1) ? true : false;
		$bAllowRatings = ($oCampaign->allow_comment_ratings == 1) ? true : false;
		$bAllowCreatedTime = ($oCampaign->allow_review_timestamp == 1) ? true : false;

		//get other settings
		$bgColor = $oCampaign->bg_color;
		$txtColor = $oCampaign->text_color;
		$campaignID = $oCampaign->id;
	}
@endphp

<style>
    .upload-btn-wrapper {  position: relative;  display: block; width: 180px; height: 210px; margin: 0 auto;}
    .btn_upload {  border:none;  background:url(images/upload.png) center top no-repeat; width: 180px; height: 160px; position: relative;}
    .btn_upload span {	position: absolute;	bottom: 5px;	width: 180px;	left: 0;	font-size: 17px;	font-weight: 600;	line-height: 30px;}
    .btn_upload span strong{font-size: 13px; font-weight: 600;}
    .upload-btn-wrapper input[type=file] {  font-size: 100px;  position: absolute;  left: 0;  top: 0;  opacity: 0; width: 180px;}
    .upload-btn-wrapper select{width: 65px; height: 26px; background: #f8f8f8; border: 1px solid #d8d8d8; margin: 10px auto; display: block; border-radius: 2px; -webkit-appearance: none; -moz-appearance:none; appearance:none; padding: 0 0 0 5px; font-size: 11px; background: url(images/select_bkg_small.png) 85% 10px no-repeat}
</style>

<style type="text/css">


	.intl-tel-input {
	position: relative;
	display: inline-block; }
	.intl-tel-input * {
	box-sizing: border-box;
	-moz-box-sizing: border-box; }
	.intl-tel-input .hide {
	display: none; }
	.intl-tel-input .v-hide {
	visibility: hidden; }
	.intl-tel-input input, .intl-tel-input input[type=text], .intl-tel-input input[type=tel] {
	position: relative;
	z-index: 0;
	margin-top: 0 !important;
	margin-bottom: 0 !important;
	padding-right: 36px;
	margin-right: 0; }
	.intl-tel-input .flag-container {
	position: absolute;
	top: 0;
	bottom: 0;
	right: 0;
	padding: 1px; }
	.intl-tel-input .selected-flag {
	z-index: 1;
	position: relative;
	width: 36px;
	height: 100%;
	padding: 0 0 0 8px; }
	.intl-tel-input .selected-flag .iti-flag {
	position: absolute;
	top: 0;
	bottom: 0;
	margin: auto; }
	.intl-tel-input .selected-flag .iti-arrow {
	position: absolute;
	top: 50%;
	margin-top: -2px;
	right: 6px;
	width: 0;
	height: 0;
	border-left: 3px solid transparent;
	border-right: 3px solid transparent;
	border-top: 4px solid #555; }
	.intl-tel-input .selected-flag .iti-arrow.up {
	border-top: none;
	border-bottom: 4px solid #555; }
	.intl-tel-input .country-list {
	position: absolute;
	z-index: 2;
	list-style: none;
	text-align: left;
	padding: 0;
	margin: 0 0 0 -1px;
	box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
	background-color: white;
	border: 1px solid #CCC;
	white-space: nowrap;
	max-height: 200px;
	overflow-y: scroll; }
	.intl-tel-input .country-list.dropup {
	bottom: 100%;
	margin-bottom: -1px; }
	.intl-tel-input .country-list .flag-box {
	display: inline-block;
	width: 20px; }
	@media (max-width: 500px) {
	.intl-tel-input .country-list {
	white-space: normal; } }
	.intl-tel-input .country-list .divider {
	padding-bottom: 5px;
	margin-bottom: 5px;
	border-bottom: 1px solid #CCC; }
	.intl-tel-input .country-list .country {
	padding: 5px 10px; }
	.intl-tel-input .country-list .country .dial-code {
	color: #999; }
	.intl-tel-input .country-list .country.highlight {
	background-color: rgba(0, 0, 0, 0.05); }
	.intl-tel-input .country-list .flag-box, .intl-tel-input .country-list .country-name, .intl-tel-input .country-list .dial-code {
	vertical-align: middle; }
	.intl-tel-input .country-list .flag-box, .intl-tel-input .country-list .country-name {
	margin-right: 6px; }
	.intl-tel-input.allow-dropdown input, .intl-tel-input.allow-dropdown input[type=text], .intl-tel-input.allow-dropdown input[type=tel], .intl-tel-input.separate-dial-code input, .intl-tel-input.separate-dial-code input[type=text], .intl-tel-input.separate-dial-code input[type=tel] {
	padding-right: 6px;
	padding-left: 52px;
	margin-left: 0; }
	.intl-tel-input.allow-dropdown .flag-container, .intl-tel-input.separate-dial-code .flag-container {
	right: auto;
	left: 0; }
	.intl-tel-input.allow-dropdown .selected-flag, .intl-tel-input.separate-dial-code .selected-flag {
	width: 46px; }
	.intl-tel-input.allow-dropdown .flag-container:hover {
	cursor: pointer; }
	.intl-tel-input.allow-dropdown .flag-container:hover .selected-flag {
	background-color: rgba(0, 0, 0, 0.05); }
	.intl-tel-input.allow-dropdown input[disabled] + .flag-container:hover, .intl-tel-input.allow-dropdown input[readonly] + .flag-container:hover {
	cursor: default; }
	.intl-tel-input.allow-dropdown input[disabled] + .flag-container:hover .selected-flag, .intl-tel-input.allow-dropdown input[readonly] + .flag-container:hover .selected-flag {
	background-color: transparent; }
	.intl-tel-input.separate-dial-code .selected-flag {
	background-color: rgba(0, 0, 0, 0.05);
	display: table; }
	.intl-tel-input.separate-dial-code .selected-dial-code {
	display: table-cell;
	vertical-align: middle;
	padding-left: 28px; }
	.intl-tel-input.separate-dial-code.iti-sdc-2 input, .intl-tel-input.separate-dial-code.iti-sdc-2 input[type=text], .intl-tel-input.separate-dial-code.iti-sdc-2 input[type=tel] {
	padding-left: 66px; }
	.intl-tel-input.separate-dial-code.iti-sdc-2 .selected-flag {
	width: 60px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 input, .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 input[type=text], .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 input[type=tel] {
	padding-left: 76px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-2 .selected-flag {
	width: 70px; }
	.intl-tel-input.separate-dial-code.iti-sdc-3 input, .intl-tel-input.separate-dial-code.iti-sdc-3 input[type=text], .intl-tel-input.separate-dial-code.iti-sdc-3 input[type=tel] {
	padding-left: 74px; }
	.intl-tel-input.separate-dial-code.iti-sdc-3 .selected-flag {
	width: 68px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 input, .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 input[type=text], .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 input[type=tel] {
	padding-left: 84px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-3 .selected-flag {
	width: 78px; }
	.intl-tel-input.separate-dial-code.iti-sdc-4 input, .intl-tel-input.separate-dial-code.iti-sdc-4 input[type=text], .intl-tel-input.separate-dial-code.iti-sdc-4 input[type=tel] {
	padding-left: 82px; }
	.intl-tel-input.separate-dial-code.iti-sdc-4 .selected-flag {
	width: 76px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 input, .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 input[type=text], .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 input[type=tel] {
	padding-left: 92px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-4 .selected-flag {
	width: 86px; }
	.intl-tel-input.separate-dial-code.iti-sdc-5 input, .intl-tel-input.separate-dial-code.iti-sdc-5 input[type=text], .intl-tel-input.separate-dial-code.iti-sdc-5 input[type=tel] {
	padding-left: 90px; }
	.intl-tel-input.separate-dial-code.iti-sdc-5 .selected-flag {
	width: 84px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 input, .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 input[type=text], .intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 input[type=tel] {
	padding-left: 100px; }
	.intl-tel-input.separate-dial-code.allow-dropdown.iti-sdc-5 .selected-flag {
	width: 94px; }
	.intl-tel-input.iti-container {
	position: absolute;
	top: -1000px;
	left: -1000px;
	z-index: 1060;
	padding: 1px; }
	.intl-tel-input.iti-container:hover {
	cursor: pointer; }

	.iti-mobile .intl-tel-input.iti-container {
	top: 30px;
	bottom: 30px;
	left: 30px;
	right: 30px;
	position: fixed; }

	.iti-mobile .intl-tel-input .country-list {
	max-height: 100%;
	width: 100%; }
	.iti-mobile .intl-tel-input .country-list .country {
	padding: 10px 10px;
	line-height: 1.5em; }

	.iti-flag {
	width: 20px; }
	.iti-flag.be {
	width: 18px; }
	.iti-flag.ch {
	width: 15px; }
	.iti-flag.mc {
	width: 19px; }
	.iti-flag.ne {
	width: 18px; }
	.iti-flag.np {
	width: 13px; }
	.iti-flag.va {
	width: 15px; }
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
	.iti-flag {
	background-size: 5630px 15px; } }
	.iti-flag.ac {
	height: 10px;
	background-position: 0px 0px; }
	.iti-flag.ad {
	height: 14px;
	background-position: -22px 0px; }
	.iti-flag.ae {
	height: 10px;
	background-position: -44px 0px; }
	.iti-flag.af {
	height: 14px;
	background-position: -66px 0px; }
	.iti-flag.ag {
	height: 14px;
	background-position: -88px 0px; }
	.iti-flag.ai {
	height: 10px;
	background-position: -110px 0px; }
	.iti-flag.al {
	height: 15px;
	background-position: -132px 0px; }
	.iti-flag.am {
	height: 10px;
	background-position: -154px 0px; }
	.iti-flag.ao {
	height: 14px;
	background-position: -176px 0px; }
	.iti-flag.aq {
	height: 14px;
	background-position: -198px 0px; }
	.iti-flag.ar {
	height: 13px;
	background-position: -220px 0px; }
	.iti-flag.as {
	height: 10px;
	background-position: -242px 0px; }
	.iti-flag.at {
	height: 14px;
	background-position: -264px 0px; }
	.iti-flag.au {
	height: 10px;
	background-position: -286px 0px; }
	.iti-flag.aw {
	height: 14px;
	background-position: -308px 0px; }
	.iti-flag.ax {
	height: 13px;
	background-position: -330px 0px; }
	.iti-flag.az {
	height: 10px;
	background-position: -352px 0px; }
	.iti-flag.ba {
	height: 10px;
	background-position: -374px 0px; }
	.iti-flag.bb {
	height: 14px;
	background-position: -396px 0px; }
	.iti-flag.bd {
	height: 12px;
	background-position: -418px 0px; }
	.iti-flag.be {
	height: 15px;
	background-position: -440px 0px; }
	.iti-flag.bf {
	height: 14px;
	background-position: -460px 0px; }
	.iti-flag.bg {
	height: 12px;
	background-position: -482px 0px; }
	.iti-flag.bh {
	height: 12px;
	background-position: -504px 0px; }
	.iti-flag.bi {
	height: 12px;
	background-position: -526px 0px; }
	.iti-flag.bj {
	height: 14px;
	background-position: -548px 0px; }
	.iti-flag.bl {
	height: 14px;
	background-position: -570px 0px; }
	.iti-flag.bm {
	height: 10px;
	background-position: -592px 0px; }
	.iti-flag.bn {
	height: 10px;
	background-position: -614px 0px; }
	.iti-flag.bo {
	height: 14px;
	background-position: -636px 0px; }
	.iti-flag.bq {
	height: 14px;
	background-position: -658px 0px; }
	.iti-flag.br {
	height: 14px;
	background-position: -680px 0px; }
	.iti-flag.bs {
	height: 10px;
	background-position: -702px 0px; }
	.iti-flag.bt {
	height: 14px;
	background-position: -724px 0px; }
	.iti-flag.bv {
	height: 15px;
	background-position: -746px 0px; }
	.iti-flag.bw {
	height: 14px;
	background-position: -768px 0px; }
	.iti-flag.by {
	height: 10px;
	background-position: -790px 0px; }
	.iti-flag.bz {
	height: 14px;
	background-position: -812px 0px; }
	.iti-flag.ca {
	height: 10px;
	background-position: -834px 0px; }
	.iti-flag.cc {
	height: 10px;
	background-position: -856px 0px; }
	.iti-flag.cd {
	height: 15px;
	background-position: -878px 0px; }
	.iti-flag.cf {
	height: 14px;
	background-position: -900px 0px; }
	.iti-flag.cg {
	height: 14px;
	background-position: -922px 0px; }
	.iti-flag.ch {
	height: 15px;
	background-position: -944px 0px; }
	.iti-flag.ci {
	height: 14px;
	background-position: -961px 0px; }
	.iti-flag.ck {
	height: 10px;
	background-position: -983px 0px; }
	.iti-flag.cl {
	height: 14px;
	background-position: -1005px 0px; }
	.iti-flag.cm {
	height: 14px;
	background-position: -1027px 0px; }
	.iti-flag.cn {
	height: 14px;
	background-position: -1049px 0px; }
	.iti-flag.co {
	height: 14px;
	background-position: -1071px 0px; }
	.iti-flag.cp {
	height: 14px;
	background-position: -1093px 0px; }
	.iti-flag.cr {
	height: 12px;
	background-position: -1115px 0px; }
	.iti-flag.cu {
	height: 10px;
	background-position: -1137px 0px; }
	.iti-flag.cv {
	height: 12px;
	background-position: -1159px 0px; }
	.iti-flag.cw {
	height: 14px;
	background-position: -1181px 0px; }
	.iti-flag.cx {
	height: 10px;
	background-position: -1203px 0px; }
	.iti-flag.cy {
	height: 13px;
	background-position: -1225px 0px; }
	.iti-flag.cz {
	height: 14px;
	background-position: -1247px 0px; }
	.iti-flag.de {
	height: 12px;
	background-position: -1269px 0px; }
	.iti-flag.dg {
	height: 10px;
	background-position: -1291px 0px; }
	.iti-flag.dj {
	height: 14px;
	background-position: -1313px 0px; }
	.iti-flag.dk {
	height: 15px;
	background-position: -1335px 0px; }
	.iti-flag.dm {
	height: 10px;
	background-position: -1357px 0px; }
	.iti-flag.do {
	height: 13px;
	background-position: -1379px 0px; }
	.iti-flag.dz {
	height: 14px;
	background-position: -1401px 0px; }
	.iti-flag.ea {
	height: 14px;
	background-position: -1423px 0px; }
	.iti-flag.ec {
	height: 14px;
	background-position: -1445px 0px; }
	.iti-flag.ee {
	height: 13px;
	background-position: -1467px 0px; }
	.iti-flag.eg {
	height: 14px;
	background-position: -1489px 0px; }
	.iti-flag.eh {
	height: 10px;
	background-position: -1511px 0px; }
	.iti-flag.er {
	height: 10px;
	background-position: -1533px 0px; }
	.iti-flag.es {
	height: 14px;
	background-position: -1555px 0px; }
	.iti-flag.et {
	height: 10px;
	background-position: -1577px 0px; }
	.iti-flag.eu {
	height: 14px;
	background-position: -1599px 0px; }
	.iti-flag.fi {
	height: 12px;
	background-position: -1621px 0px; }
	.iti-flag.fj {
	height: 10px;
	background-position: -1643px 0px; }
	.iti-flag.fk {
	height: 10px;
	background-position: -1665px 0px; }
	.iti-flag.fm {
	height: 11px;
	background-position: -1687px 0px; }
	.iti-flag.fo {
	height: 15px;
	background-position: -1709px 0px; }
	.iti-flag.fr {
	height: 14px;
	background-position: -1731px 0px; }
	.iti-flag.ga {
	height: 15px;
	background-position: -1753px 0px; }
	.iti-flag.gb {
	height: 10px;
	background-position: -1775px 0px; }
	.iti-flag.gd {
	height: 12px;
	background-position: -1797px 0px; }
	.iti-flag.ge {
	height: 14px;
	background-position: -1819px 0px; }
	.iti-flag.gf {
	height: 14px;
	background-position: -1841px 0px; }
	.iti-flag.gg {
	height: 14px;
	background-position: -1863px 0px; }
	.iti-flag.gh {
	height: 14px;
	background-position: -1885px 0px; }
	.iti-flag.gi {
	height: 10px;
	background-position: -1907px 0px; }
	.iti-flag.gl {
	height: 14px;
	background-position: -1929px 0px; }
	.iti-flag.gm {
	height: 14px;
	background-position: -1951px 0px; }
	.iti-flag.gn {
	height: 14px;
	background-position: -1973px 0px; }
	.iti-flag.gp {
	height: 14px;
	background-position: -1995px 0px; }
	.iti-flag.gq {
	height: 14px;
	background-position: -2017px 0px; }
	.iti-flag.gr {
	height: 14px;
	background-position: -2039px 0px; }
	.iti-flag.gs {
	height: 10px;
	background-position: -2061px 0px; }
	.iti-flag.gt {
	height: 13px;
	background-position: -2083px 0px; }
	.iti-flag.gu {
	height: 11px;
	background-position: -2105px 0px; }
	.iti-flag.gw {
	height: 10px;
	background-position: -2127px 0px; }
	.iti-flag.gy {
	height: 12px;
	background-position: -2149px 0px; }
	.iti-flag.hk {
	height: 14px;
	background-position: -2171px 0px; }
	.iti-flag.hm {
	height: 10px;
	background-position: -2193px 0px; }
	.iti-flag.hn {
	height: 10px;
	background-position: -2215px 0px; }
	.iti-flag.hr {
	height: 10px;
	background-position: -2237px 0px; }
	.iti-flag.ht {
	height: 12px;
	background-position: -2259px 0px; }
	.iti-flag.hu {
	height: 10px;
	background-position: -2281px 0px; }
	.iti-flag.ic {
	height: 14px;
	background-position: -2303px 0px; }
	.iti-flag.id {
	height: 14px;
	background-position: -2325px 0px; }
	.iti-flag.ie {
	height: 10px;
	background-position: -2347px 0px; }
	.iti-flag.il {
	height: 15px;
	background-position: -2369px 0px; }
	.iti-flag.im {
	height: 10px;
	background-position: -2391px 0px; }
	.iti-flag.in {
	height: 14px;
	background-position: -2413px 0px; }
	.iti-flag.io {
	height: 10px;
	background-position: -2435px 0px; }
	.iti-flag.iq {
	height: 14px;
	background-position: -2457px 0px; }
	.iti-flag.ir {
	height: 12px;
	background-position: -2479px 0px; }
	.iti-flag.is {
	height: 15px;
	background-position: -2501px 0px; }
	.iti-flag.it {
	height: 14px;
	background-position: -2523px 0px; }
	.iti-flag.je {
	height: 12px;
	background-position: -2545px 0px; }
	.iti-flag.jm {
	height: 10px;
	background-position: -2567px 0px; }
	.iti-flag.jo {
	height: 10px;
	background-position: -2589px 0px; }
	.iti-flag.jp {
	height: 14px;
	background-position: -2611px 0px; }
	.iti-flag.ke {
	height: 14px;
	background-position: -2633px 0px; }
	.iti-flag.kg {
	height: 12px;
	background-position: -2655px 0px; }
	.iti-flag.kh {
	height: 13px;
	background-position: -2677px 0px; }
	.iti-flag.ki {
	height: 10px;
	background-position: -2699px 0px; }
	.iti-flag.km {
	height: 12px;
	background-position: -2721px 0px; }
	.iti-flag.kn {
	height: 14px;
	background-position: -2743px 0px; }
	.iti-flag.kp {
	height: 10px;
	background-position: -2765px 0px; }
	.iti-flag.kr {
	height: 14px;
	background-position: -2787px 0px; }
	.iti-flag.kw {
	height: 10px;
	background-position: -2809px 0px; }
	.iti-flag.ky {
	height: 10px;
	background-position: -2831px 0px; }
	.iti-flag.kz {
	height: 10px;
	background-position: -2853px 0px; }
	.iti-flag.la {
	height: 14px;
	background-position: -2875px 0px; }
	.iti-flag.lb {
	height: 14px;
	background-position: -2897px 0px; }
	.iti-flag.lc {
	height: 10px;
	background-position: -2919px 0px; }
	.iti-flag.li {
	height: 12px;
	background-position: -2941px 0px; }
	.iti-flag.lk {
	height: 10px;
	background-position: -2963px 0px; }
	.iti-flag.lr {
	height: 11px;
	background-position: -2985px 0px; }
	.iti-flag.ls {
	height: 14px;
	background-position: -3007px 0px; }
	.iti-flag.lt {
	height: 12px;
	background-position: -3029px 0px; }
	.iti-flag.lu {
	height: 12px;
	background-position: -3051px 0px; }
	.iti-flag.lv {
	height: 10px;
	background-position: -3073px 0px; }
	.iti-flag.ly {
	height: 10px;
	background-position: -3095px 0px; }
	.iti-flag.ma {
	height: 14px;
	background-position: -3117px 0px; }
	.iti-flag.mc {
	height: 15px;
	background-position: -3139px 0px; }
	.iti-flag.md {
	height: 10px;
	background-position: -3160px 0px; }
	.iti-flag.me {
	height: 10px;
	background-position: -3182px 0px; }
	.iti-flag.mf {
	height: 14px;
	background-position: -3204px 0px; }
	.iti-flag.mg {
	height: 14px;
	background-position: -3226px 0px; }
	.iti-flag.mh {
	height: 11px;
	background-position: -3248px 0px; }
	.iti-flag.mk {
	height: 10px;
	background-position: -3270px 0px; }
	.iti-flag.ml {
	height: 14px;
	background-position: -3292px 0px; }
	.iti-flag.mm {
	height: 14px;
	background-position: -3314px 0px; }
	.iti-flag.mn {
	height: 10px;
	background-position: -3336px 0px; }
	.iti-flag.mo {
	height: 14px;
	background-position: -3358px 0px; }
	.iti-flag.mp {
	height: 10px;
	background-position: -3380px 0px; }
	.iti-flag.mq {
	height: 14px;
	background-position: -3402px 0px; }
	.iti-flag.mr {
	height: 14px;
	background-position: -3424px 0px; }
	.iti-flag.ms {
	height: 10px;
	background-position: -3446px 0px; }
	.iti-flag.mt {
	height: 14px;
	background-position: -3468px 0px; }
	.iti-flag.mu {
	height: 14px;
	background-position: -3490px 0px; }
	.iti-flag.mv {
	height: 14px;
	background-position: -3512px 0px; }
	.iti-flag.mw {
	height: 14px;
	background-position: -3534px 0px; }
	.iti-flag.mx {
	height: 12px;
	background-position: -3556px 0px; }
	.iti-flag.my {
	height: 10px;
	background-position: -3578px 0px; }
	.iti-flag.mz {
	height: 14px;
	background-position: -3600px 0px; }
	.iti-flag.na {
	height: 14px;
	background-position: -3622px 0px; }
	.iti-flag.nc {
	height: 10px;
	background-position: -3644px 0px; }
	.iti-flag.ne {
	height: 15px;
	background-position: -3666px 0px; }
	.iti-flag.nf {
	height: 10px;
	background-position: -3686px 0px; }
	.iti-flag.ng {
	height: 10px;
	background-position: -3708px 0px; }
	.iti-flag.ni {
	height: 12px;
	background-position: -3730px 0px; }
	.iti-flag.nl {
	height: 14px;
	background-position: -3752px 0px; }
	.iti-flag.no {
	height: 15px;
	background-position: -3774px 0px; }
	.iti-flag.np {
	height: 15px;
	background-position: -3796px 0px; }
	.iti-flag.nr {
	height: 10px;
	background-position: -3811px 0px; }
	.iti-flag.nu {
	height: 10px;
	background-position: -3833px 0px; }
	.iti-flag.nz {
	height: 10px;
	background-position: -3855px 0px; }
	.iti-flag.om {
	height: 10px;
	background-position: -3877px 0px; }
	.iti-flag.pa {
	height: 14px;
	background-position: -3899px 0px; }
	.iti-flag.pe {
	height: 14px;
	background-position: -3921px 0px; }
	.iti-flag.pf {
	height: 14px;
	background-position: -3943px 0px; }
	.iti-flag.pg {
	height: 15px;
	background-position: -3965px 0px; }
	.iti-flag.ph {
	height: 10px;
	background-position: -3987px 0px; }
	.iti-flag.pk {
	height: 14px;
	background-position: -4009px 0px; }
	.iti-flag.pl {
	height: 13px;
	background-position: -4031px 0px; }
	.iti-flag.pm {
	height: 14px;
	background-position: -4053px 0px; }
	.iti-flag.pn {
	height: 10px;
	background-position: -4075px 0px; }
	.iti-flag.pr {
	height: 14px;
	background-position: -4097px 0px; }
	.iti-flag.ps {
	height: 10px;
	background-position: -4119px 0px; }
	.iti-flag.pt {
	height: 14px;
	background-position: -4141px 0px; }
	.iti-flag.pw {
	height: 13px;
	background-position: -4163px 0px; }
	.iti-flag.py {
	height: 11px;
	background-position: -4185px 0px; }
	.iti-flag.qa {
	height: 8px;
	background-position: -4207px 0px; }
	.iti-flag.re {
	height: 14px;
	background-position: -4229px 0px; }
	.iti-flag.ro {
	height: 14px;
	background-position: -4251px 0px; }
	.iti-flag.rs {
	height: 14px;
	background-position: -4273px 0px; }
	.iti-flag.ru {
	height: 14px;
	background-position: -4295px 0px; }
	.iti-flag.rw {
	height: 14px;
	background-position: -4317px 0px; }
	.iti-flag.sa {
	height: 14px;
	background-position: -4339px 0px; }
	.iti-flag.sb {
	height: 10px;
	background-position: -4361px 0px; }
	.iti-flag.sc {
	height: 10px;
	background-position: -4383px 0px; }
	.iti-flag.sd {
	height: 10px;
	background-position: -4405px 0px; }
	.iti-flag.se {
	height: 13px;
	background-position: -4427px 0px; }
	.iti-flag.sg {
	height: 14px;
	background-position: -4449px 0px; }
	.iti-flag.sh {
	height: 10px;
	background-position: -4471px 0px; }
	.iti-flag.si {
	height: 10px;
	background-position: -4493px 0px; }
	.iti-flag.sj {
	height: 15px;
	background-position: -4515px 0px; }
	.iti-flag.sk {
	height: 14px;
	background-position: -4537px 0px; }
	.iti-flag.sl {
	height: 14px;
	background-position: -4559px 0px; }
	.iti-flag.sm {
	height: 15px;
	background-position: -4581px 0px; }
	.iti-flag.sn {
	height: 14px;
	background-position: -4603px 0px; }
	.iti-flag.so {
	height: 14px;
	background-position: -4625px 0px; }
	.iti-flag.sr {
	height: 14px;
	background-position: -4647px 0px; }
	.iti-flag.ss {
	height: 10px;
	background-position: -4669px 0px; }
	.iti-flag.st {
	height: 10px;
	background-position: -4691px 0px; }
	.iti-flag.sv {
	height: 12px;
	background-position: -4713px 0px; }
	.iti-flag.sx {
	height: 14px;
	background-position: -4735px 0px; }
	.iti-flag.sy {
	height: 14px;
	background-position: -4757px 0px; }
	.iti-flag.sz {
	height: 14px;
	background-position: -4779px 0px; }
	.iti-flag.ta {
	height: 10px;
	background-position: -4801px 0px; }
	.iti-flag.tc {
	height: 10px;
	background-position: -4823px 0px; }
	.iti-flag.td {
	height: 14px;
	background-position: -4845px 0px; }
	.iti-flag.tf {
	height: 14px;
	background-position: -4867px 0px; }
	.iti-flag.tg {
	height: 13px;
	background-position: -4889px 0px; }
	.iti-flag.th {
	height: 14px;
	background-position: -4911px 0px; }
	.iti-flag.tj {
	height: 10px;
	background-position: -4933px 0px; }
	.iti-flag.tk {
	height: 10px;
	background-position: -4955px 0px; }
	.iti-flag.tl {
	height: 10px;
	background-position: -4977px 0px; }
	.iti-flag.tm {
	height: 14px;
	background-position: -4999px 0px; }
	.iti-flag.tn {
	height: 14px;
	background-position: -5021px 0px; }
	.iti-flag.to {
	height: 10px;
	background-position: -5043px 0px; }
	.iti-flag.tr {
	height: 14px;
	background-position: -5065px 0px; }
	.iti-flag.tt {
	height: 12px;
	background-position: -5087px 0px; }
	.iti-flag.tv {
	height: 10px;
	background-position: -5109px 0px; }
	.iti-flag.tw {
	height: 14px;
	background-position: -5131px 0px; }
	.iti-flag.tz {
	height: 14px;
	background-position: -5153px 0px; }
	.iti-flag.ua {
	height: 14px;
	background-position: -5175px 0px; }
	.iti-flag.ug {
	height: 14px;
	background-position: -5197px 0px; }
	.iti-flag.um {
	height: 11px;
	background-position: -5219px 0px; }
	.iti-flag.us {
	height: 11px;
	background-position: -5241px 0px; }
	.iti-flag.uy {
	height: 14px;
	background-position: -5263px 0px; }
	.iti-flag.uz {
	height: 10px;
	background-position: -5285px 0px; }
	.iti-flag.va {
	height: 15px;
	background-position: -5307px 0px; }
	.iti-flag.vc {
	height: 14px;
	background-position: -5324px 0px; }
	.iti-flag.ve {
	height: 14px;
	background-position: -5346px 0px; }
	.iti-flag.vg {
	height: 10px;
	background-position: -5368px 0px; }
	.iti-flag.vi {
	height: 14px;
	background-position: -5390px 0px; }
	.iti-flag.vn {
	height: 14px;
	background-position: -5412px 0px; }
	.iti-flag.vu {
	height: 12px;
	background-position: -5434px 0px; }
	.iti-flag.wf {
	height: 14px;
	background-position: -5456px 0px; }
	.iti-flag.ws {
	height: 10px;
	background-position: -5478px 0px; }
	.iti-flag.xk {
	height: 15px;
	background-position: -5500px 0px; }
	.iti-flag.ye {
	height: 14px;
	background-position: -5522px 0px; }
	.iti-flag.yt {
	height: 14px;
	background-position: -5544px 0px; }
	.iti-flag.za {
	height: 14px;
	background-position: -5566px 0px; }
	.iti-flag.zm {
	height: 14px;
	background-position: -5588px 0px; }
	.iti-flag.zw {
	height: 10px;
	background-position: -5610px 0px; }

	.iti-flag {
	width: 20px;
	height: 15px;
	box-shadow: 0px 0px 1px 0px #888;
	background-image: url("{{ base_url() }}assets/images/flags.png");
	background-repeat: no-repeat;
	background-color: #DBDBDB;
	background-position: 20px 0; }
	@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
	.iti-flag {
	background-image: url("{{ base_url() }}assets/images/flags@2x.png"); } }

	.iti-flag.np {
	background-color: transparent; }

	.intl-tel-input{
	width: 100%;
	}
</style>

<style type="text/css">
          
  #myDropzone{
    border: 2px dashed #0087F7;
    border-radius: 5px;
    background: white;
  }
</style>

<link href="{{ base_url() }}assets/dropzone-master/dist/dropzone.css" type="text/css" rel="stylesheet" />
<script src="{{ base_url() }}assets/dropzone-master/dist/dropzone.js"></script>

<section style="padding-bottom: 30px;" class="top_text review_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="dred">Hi, Thank You For Visiting RealRomance.com<br>

                    Would You Do Us A HUGE Favor And Leave<br>

                    Us A Review Below On The Web Sites… </h1>
                <h3>The Video Below Explains How To Do it…</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="upgrade_box review">
                    <div class="row">
                        <div class="col-md-8 pr0">
                            <iframe src="https://www.youtube-nocookie.com/embed/_BOdEeZmns0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-4">
                            <div class="upgrade_opt">
                                <h1>Your Reward For<br>
                                    Leaving Us A Great<br>
                                    Review :-)</h1>
                                <h2>35% Discount<br>
                                    Next Visit</h2>

                                <a class="btn-orange" href="#"><span>&nbsp; &nbsp; Click Here After Review</span></a>
                                <h4>No Thanks I’ll Pass On The<br>
                                    Annual 25% Off Upgrade</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h3 class="mbot20">Please Click The Following Links Below And Leave Us A Review & Collect Your Prie!</h3>
            </div>
        </div>



        <div class="row review_form">
            <form method="post" name="frmSubmit" id="frmSubmit" action="#"  enctype="multipart/form-data">
				@csrf
                <input type="hidden" name="type" value="video" />
                <input type="hidden" name="campaign_id" value="{{ $campaignID }}" />
                <input type="hidden" name="subID" value="{{ $subscriberID }}" />
                <input type="hidden" value="4" id="ratingValue" name="ratingValue">
                <div class="col-md-12">
                    <p class="mbot20">
                    <div class="step_star">
                        <ul id='stars'>
                            <li class='star selected' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star selected' title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star selected' title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star selected' title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                            <li class='star' title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                            </li>
                        </ul>
                    </div>
                    </p>
                </div>

                <div class="col-md-5 col-md-offset-1 text-left">
                    <input type="text" name="fullname" placeholder="Your Full Name" >
                    <input type="text" name="email" placeholder="Enter Your Email Address" >
                    <input type="text" name="mobile" id="mobile" placeholder="Mobile No." >
                </div>
                <div class="col-md-5 text-left">

                    <div class="dropzone" id="myDropzone"></div>
                    <input type="hidden" name="image_name" id="image_name" value="">
                    <div class="upload-btn-wrapper" style='height:80px;'>
                      
                    </div>
                   
                </div>
                <div class="col-md-5 col-md-offset-1 text-left">
					@if($oCampaign->pro_cons == 1)
						<textarea placeholder="Pros (Separated by coma)" name="pro" rows='2' required></textarea>
					@endif
                </div>
                <div class="col-md-5 text-left">
					@if($oCampaign->pro_cons == 1)
						<textarea placeholder="Cons (Separated by coma)" name="cons" rows='4' required></textarea>
					@endif
                </div>
                <div class="col-md-12">
                    <button class="btn-orange mtop40" type="submit"> &nbsp; &nbsp; <span>Continue</span></button>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        Dropzone.options.myDropzone= {
            url: '{{ site_url("/dropzone/upload_video") }}',
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 600,
            acceptedFiles: 'video/mp4',
            addRemoveLinks: true,
            success: function(response) {
             
              $('#image_name').val(response.xhr.responseText);
            }
        }

        $("#mobile").intlTelInput({
            preferredCountries: [ "us", "in" ]
        });

        $("#frmSubmit").submit(function () {
           
            //e.preventDefault();
            var telExt = $('.highlight').attr('data-dial-code');
            var countryExt = $('.highlight').attr('data-country-code');
            if(telExt > 0){
            
            }
            else{
                telExt = '1';
                countryExt = 'us';
            }
            
            var formdata = new FormData(this);
            formdata.append('telExt', telExt);
            formdata.append('countryExt', countryExt);
            $.ajax({
                url: "{{ base_url('/reviews/saveReviewText') }}",
                type: "POST",
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.status == 'ok') {
                        alert("Review Added Successfully!");
                        window.location.href = response.redirect_url;
                    } else {
                        alert(response.msg);
                    }

                },
                error: function (response) {
                    alert(response.msg);
                }
            });
            return false;
        });
    });
</script>