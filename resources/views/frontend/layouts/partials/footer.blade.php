<div class="footer-wrap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto">{{ (__('home.footer.copyright_text')) }}</div>
            <div class="col-auto term-policy"><a href="/pages/terms-and-condition">{{ (__('home.footer.terms_and_condition')) }}</a> <a href="/pages/refund-policy">{{ (__('home.footer.refund_policy')) }}</a> <a href="/pages/privacy-policy">  {{ (__('home.footer.privacy_policy')) }}</a></div>
            <div class="col-auto"><a href="https://www.design-master.com/" target="_blank">{{ (__('home.footer.footer_extra_text')) }}</a></div>
        </div>
    </div>
</div>
<input type="hidden" id="selectedLang" value="{{App::getLocale()}}">
