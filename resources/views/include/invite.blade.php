<div class="aside-right">
    <div class="title">Invite people to add content</div>
    <div class="invite-box">
        <input type="email" placeholder="Email" id="invite-email" />
        <textarea name="message" id="invite-message" placeholder="Enter a message"></textarea>
    </div>

    <div class="share-details">
        <div class="icon">
            <!-- Facebook -->
            <div class="img">
                <a href="#" id="share-facebook" target="_blank">
                    <img src="{{ asset('images/facebook.png') }}" alt="Facebook" />
                </a>
            </div>
            <!-- Messenger -->
            <div class="img">
                <a href="#" id="share-messenger" target="_blank">
                    <img src="{{ asset('images/messenger.png') }}" alt="Messenger" />
                </a>
            </div>
            <!-- WhatsApp -->
            <div class="img">
                <a href="#" id="share-whatsapp" target="_blank">
                    <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" />
                </a>
            </div>
            <!-- Twitter -->
            <div class="img">
                <a href="#" id="share-twitter" target="_blank">
                    <img src="{{ asset('images/twitter.png') }}" alt="Twitter" />
                </a>
            </div>
            <!-- Flipboard -->
            <div class="img">
                <a href="#" id="share-flipboard" target="_blank">
                    <img src="{{ asset('images/flipboard.png') }}" alt="Flipboard" />
                </a>
            </div>
            <!-- Email -->
            <div class="img">
                <a href="#" id="share-email" target="_blank">
                    <img src="{{ asset('images/email.png') }}" alt="Email" />
                </a>
            </div>
        </div>
    </div>
</div>

<script>

    var appUrl = '{{ env('APP_URL') }}';

    document.getElementById('invite-message').addEventListener('input', function() {
        let message = encodeURIComponent(this.value);


        document.getElementById('share-facebook').href = "https://www.facebook.com/sharer/sharer.php?u=" + appUrl + "&quote=" + message;
        document.getElementById('share-messenger').href = "https://m.me/?text=" + message;
        document.getElementById('share-whatsapp').href = "https://wa.me/?text=" + message;
        document.getElementById('share-twitter').href = "https://twitter.com/intent/tweet?url=" + appUrl + "&text=" + message;
        document.getElementById('share-flipboard').href = "https://flipboard.com/subscribe/bookmarklet?url=" + appUrl + "&title=" + message;
        document.getElementById('share-email').href = "mailto:?subject=Check this out&body=" + message;
    });
</script>
