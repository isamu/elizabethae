<script language="JavaScript">
<!--
$(this).submit(function(event){
                     event.preventDefault();
                     $.post("/wiki/<?= $this->controller->data['page_name']; ?>.json",
                            $("form").serialize(),
                            function(res){
                                $('#wiki_content').html(res);
                            },
                            "json");
                 });

//-->
</script>
<div id="wiki_content">
<?= $this->controller->data['text_html']; ?>
</div>
<form action="/wiki/<?= $this->controller->data['page_name']; ?>" >
<textarea name=text><?= $this->controller->data['text']; ?></textarea><br/>
<input type=hidden name="pagename" value="testpage">
<input type="submit">

</form>