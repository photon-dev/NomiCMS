<script>
function tag(text1, text2) {
    text2 = text2 || '';
    if ((document.selection)) {
        document.form.message.focus();
        document.form.document.selection.createRange().text = text1 + document.form.document.selection.createRange().text + text2;
    } else if (document.forms['form'].elements['message'].selectionStart != undefined) {
        var element = document.forms['form'].elements['message'];
        var len = document.form.message.selectionStart;
        var str = element.value;
        var scroll = document.form.message.scrollTop;
        var start = element.selectionStart;
        var length = element.selectionEnd - element.selectionStart;
        element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
        var scroll2 = scroll + text1.length + text2.length + length;
        document.form.message.scrollTop = scroll2;
        var len2 = text1.length + len + text2.length + length;
        document.form.message.setSelectionRange(len2,len2);
        document.form.message.focus();
    } else {
        document.form.message.value += text1 + text2;
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
    .bbcode {
        line-height: 1.8;
    }
    .bbcode i {
        color: #5A5A5A;
        padding: 0px 4px;
        cursor: pointer;
        border: 2px solid #5A5A5A;
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
    .bbcode > span {
        margin-right: 2px;
    }
    .bbcode > span:last-child {
        margin-right: 0;
    }
</style>
<div class='bbcode'>
<span onclick="smile()"><i class="icon-smile"></i></span>
<span onclick="tag('[b]', '[/b]')"><i class="icon-bold"></i></span>
<span onclick="tag('[i]', '[/i]')"><i class="icon-italic"></i></span>
<span onclick="tag('[u]', '[/u]')"><i class="icon-underline"></i></span>
<span onclick="tag('[color=#]', '[/color]')"><i class="icon-palette"></i></span>
<span onclick="tag('[url=http://]', '[/url]')"><i class="icon-link-1"></i></span>
<span onclick="tag('[img]', '[/img]')"><i class="icon-picture-1"></i></span>
<span onclick="tag('[cit]', '[/cit]')"><i class="icon-quote-right"></i></span>
<span onclick="tag('[code]', '[/code]')"><i class="icon-code"></i></span>
<span onclick="tag('[video]', '[/video]')"><i class="icon-video"></i></span>
<span onclick="tag('[youtube]', '[/youtube]')"><i class="icon-youtube-2"></i></span>
</div>
<div id="smile"><hr>
<?php smile(); ?>
</div>
