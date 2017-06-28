<?php
if (isset($_POST['hidContent'])) {
	session_start(); 
	$_SESSION['myheader'] = $_POST['hidHeader'];
	$_SESSION['mycontent'] = $_POST['hidContent'];
	header("Location: example3.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="assets/minimalist-basic/content.css" rel="stylesheet" type="text/css" />
    <link href="contentbuilder/contentbuilder.css" rel="stylesheet" type="text/css" />
        <style>
        body { background:#f7f7f7;margin:0; }
        .is-container {  margin: 90px auto; max-width: 1050px; width:100%; padding:55px 35px; box-sizing:border-box; }
        @media all and (max-width: 1080px) {
            .is-container { margin:0; }
        }
        
        body {margin:0 0 57px} /* give space 70px on the bottom for panel */
        #panelCms {width:100%;height:57px;border-top: #eee 1px solid;background:rgba(255,255,255,0.95);position:fixed;left:0;bottom:0;padding:10px;box-sizing:border-box;text-align:center;white-space:nowrap;z-index:10001;}
        #panelCms button {border-radius:4px;padding: 10px 15px;text-transform:uppercase;font-size: 11px;letter-spacing: 1px;line-height: 1;}
    </style>
</head>
<body>

<!-- HEADER -->
<div style="background:#eaeaea;float:left;width:100%">

    <div id="headerarea" class="is-container container">
		<?php
		session_start(); 
		if(empty($_SESSION['myheader'])==true) {
			/* Optional initial content */
			echo '<div class="row clearfix">
				<div class="column full">
				<div class="display"><h1>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h1></div>
				</div></div>';
		} else {
			echo $_SESSION['myheader'];
		}
		?>
    </div>

</div>

<!-- CONTENT -->
<div style="background:#f7f7f7;float:left;width:100%">

	<div id="contentarea" class="is-container container">
		<?php
		session_start(); 
		if(empty($_SESSION['mycontent'])==true) {
			/* Optional initial content */
			echo '<div class="row clearfix">
				<div class="column full">
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus leo ante, consectetur sit amet vulputate vel, dapibus sit amet lectus.</p>
				</div></div>';
		} else {
			echo $_SESSION['mycontent'];
		}
		?>
	</div>

</div>


<!-- Hidden Form Fields to post content -->
<form id="form1" method="post" style="display:none">
	<input type="hidden" id="hidHeader" name="hidHeader" />
	<input type="hidden" id="hidContent" name="hidContent" />
	<input type="submit" id="btnPost" value="submit" />
</form>

<!-- CUSTOM PANEL (can be used for "save" button or your own custom buttons) -->
<div id="panelCms">
    <button onclick="save()" class="btn btn-primary"> Save </button>
</div>

<script src="contentbuilder/jquery.min.js" type="text/javascript"></script>
<script src="contentbuilder/jquery-ui.min.js" type="text/javascript"></script>
<script src="contentbuilder/contentbuilder.js" type="text/javascript"></script>
<script src="contentbuilder/saveimages.js" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function ($) {

        $("#headerarea, #contentarea").contentbuilder({
            snippetFile: 'assets/minimalist-basic/snippets.html',
            snippetOpen: true,
            toolbar: 'left',
            iconselect: 'assets/ionicons/selecticon.html'
        });

    });


    function save() {
        
        //Save all images first
        $("body").saveimages({
            handler: 'saveimage.php',
            onComplete: function () {

                //Then save the content
				var sHeader = $('#headerarea').data('contentbuilder').html(); //Get header
                var sContent = $('#contentarea').data('contentbuilder').html(); //Get content

				$('#hidHeader').val(sHeader);
                $('#hidContent').val(sContent);
                $('#btnPost').click();

            }
        });
        $("body").data('saveimages').save();

        $("html").fadeOut(1000);
    }

</script>

</body>
</html>
