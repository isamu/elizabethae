<script language="JavaScript">
<!--
$(this).submit(function(event){
                     event.preventDefault();
                     $.post("/wiki/index.json",
                            $("form").serialize(),
                            function(res){
                                alert(res.text);
                            },
                            "json");
                 });

//-->
</script>

<form action="/wiki/write" >
<textarea name=text></textarea>
<input type=hidden name="pagename" value="testpage">
<input type="submit">

</form>