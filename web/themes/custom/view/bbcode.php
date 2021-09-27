<script>
function tag(text1, text2) {
    text2 = text2 || '';
    if ((document.selection)) {
        document.message.messages.focus();
        document.message.document.selection.createRange().text = text1 + document.message.document.selection.createRange().text + text2;
    } else if (document.forms['message'].elements['messages'].selectionStart != undefined) {
        var element = document.forms['message'].elements['messages'];
        var len = document.message.messages.selectionStart;
        var str = element.value;
        var scroll = document.message.messages.scrollTop;
        var start = element.selectionStart;
        var length = element.selectionEnd - element.selectionStart;
        element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
        var scroll2 = scroll + text1.length + text2.length + length;
        document.message.messages.scrollTop = scroll2;
        var len2 = text1.length + len + text2.length + length;
        document.message.messages.setSelectionRange(len2,len2);
        document.message.messages.focus();
    } else {
        document.message.messages.value += text1 + text2;
    }
}
function uploadFile(target) {
    document.querySelector('.select_file > :last-child').innerHTML = target.files[0].name;
}
function smile() {
    var s = document.getElementById("smile");
    if (s.style.maxHeight == "") s.style.maxHeight = "100px"; else s.style.maxHeight = "";
}
</script>
<style>
    .bbcode i {
        color: #686868;
        margin-right: 5px;
        padding: 0px 4px;
        cursor: pointer;
        border: 2px solid #686868;
        border-radius: 2px;
        transition: color .3s, border .3s;
    }
    .bbcode i:hover {
        color: #c74242;
        border-color: #c74242;
    }
    .bbcode i[class^="icon-"]:before, i[class*=" icon-"]:before {
        margin: 0;
    }

    .bbcode i.red{}
</style>
<div class='bbcode'>
<a onclick="smile()"><i class="icon-smile"></i></a>
<a onclick="tag('[b]', '[/b]')"><i class="icon-bold"></i></a>
<a onclick="tag('[i]', '[/i]')"><i class="icon-italic"></i></a>
<a onclick="tag('[u]', '[/u]')"><i class="icon-underline"></i></a>
<a onclick="tag('[color=#]', '[/color]')"><i class="icon-palette"></i></a>
<a onclick="tag('[url=http://]', '[/url]')"><i class="icon-link-1"></i></a>
<a onclick="tag('[img]', '[/img]')"><i class="icon-picture-1"></i></a>
<a onclick="tag('[cit]', '[/cit]')"><i class="icon-quote-right"></i></a>
<a onclick="tag('[code]', '[/code]')"><i class="icon-code"></i></a>
<a onclick="tag('[youtube]', '[/youtube]')"><i class="icon-youtube-2"></i></a>
</div>
<div id="smile"><hr>
<? //smile('', true); ?>
</div>
