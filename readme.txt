﻿ContentBuilder.js ver. 1.9.6


*** USAGE ***

1. Includes:

	<link href="contentbuilder/contentbuilder.css" rel="stylesheet" type="text/css" />

	<script src="contentbuilder/contentbuilder.js" type="text/javascript"></script>

2. Run:

	$("#contentarea").contentbuilder({
		  snippetFile: 'snippets.html'
		  });

	The snippetFile parameter refers to a html file containing snippets collection. You can add your own snippets in this file (snippets.html).

3. To get HTML:

    var sHTML = $('#contentarea').data('contentbuilder').html();



*** OPTIONAL ***

To have left editor toolbar:

    $("#contentarea,#headerarea").contentbuilder({
        toolbar: 'left',
		.....
    });

To enable & specify Icon Selection dialog:

	$("#contentarea").contentbuilder({		
		  ...,
		  iconselect: 'assets/ionicons/selecticon.html'
		  });

To open snippet panel on first load:

	$("#contentarea").contentbuilder({
            snippetOpen: true,
            .....
            });

To view HTML:

	$('#contentarea').data('contentbuilder').viewHtml();



*** OTHERS ***

To enable custom image or file select dialog:

	$("#contentarea").contentbuilder({
            imageselect: 'images.html',
            fileselect: 'files.html',
            .....
            });

	- imageselect specifies custom page to open from the image dialog.
	- fileselect specifies custom page to open from the link dialog.
	
	Please see images.html (included in this package) as a simple example. 
	Use selectAsset() function as shown in the images.html to return a value to the dialog.

To load HTML at runtime:

	$("#contentarea").data('contentbuilder').loadHTML('<h1>Heading text</h1>');

To disable/destroy the plugin at runtime:

    if ($('#contentarea').data('contentbuilder')) $('#contentarea').data('contentbuilder').destroy();

To run custom script when a block is dropped (added) to the content:

    $("#contentarea").contentbuilder({
        onDrop: function (event, ui) {
            alert(ui.item.html());  //custom script here
        },
        .....
    });

To run custom script when content renders/updated:

    $("#contentarea").contentbuilder({
        onRender: function () {
            //custom script here
        },
        .....
    });

To make the snippet tool slide from left, use 'snippetTool' property, for example:

	$("#contentarea").contentbuilder({
            snippetTool: 'left',
            .....
            });

To disable Direct Image Embed:

    $("#contentarea").contentbuilder({
        imageEmbed: false,
        .....
    });

To disable HTML source editing:

    $("#contentarea").contentbuilder({
        sourceEditor: false,
        .....
    });


If you have multiple DIVs (drop area) which are vertically positioned (ex. top/middle/bottom DIVs, and not left/center/right DIVs), this option will make sorting blocks more easy (see example7.html):
    
	$("#contentarea,#headerarea").contentbuilder({
        axis: 'y',
		.....
    });

Now it's possible to make an image not replaceable. Just add data-fixed="1" to the <img> element on the snippet file (snippets.html), for example:

	<img data-fixed="1" src=".." />

To make a snippet not editable, add data-mode="readonly" on the snippet's DIV, for example:

	<div data-thumb="..../01.png">
		<div class="row clearfix" data-mode="readonly"> 
			......
		</div>
	</div>

To have the editing toolbar always displayed (after cursor is placed on text):

    $("#contentarea").contentbuilder({
        toolbarDisplay: 'always',
        .....
    });

Now you can put assets folder not on its default location. Path adjustment will be needed using snippetPathReplace parameter, for example:

    $("#contentarea").contentbuilder({
        snippetPathReplace: ['assets/minimalist-basic/', 'mycustomfolder/assets/minimalist-basic/'],
        .....
    });

To show scroll up/down helper, use "scrollHelper" parameter  (default: false)

    $("#contentarea").contentbuilder({
        scrollHelper: true,   
        .....
    });

To implement different sliding effect for snippets, use "snippetPageSliding" parameter (default: false).
If set true, when snippets opens, the entire page will also slide.

        $("#contentarea").contentbuilder({
            snippetPageSliding: true,   
            .....
        });

To implement custom actions on image embed process, use the following events:
	- onImageBrowseClick: Triggered when image browse icon is clicked 
	- onImageSettingClick: Triggered when image settings icon is clicked
	(Image browse icon and image settings icon are displayed when you hover an image)

    $("#contentarea").contentbuilder({
        onImageBrowseClick: function () { },
        onImageSettingClick: function () { },    
        .....
    });

	- onImageSelectClick: Triggered when custom image select button is clicked 
	- onFileSelectClick: Triggered when custom file select button is clicked
	(If the events are used, custom image select button and custom file select button will be displayed on the Image Settings dialog)

    $("#contentarea").contentbuilder({
        onImageSelectClick: function () { },
        onFileSelectClick: function () { },    
        .....
    });

To activate custom tags insert button, specify "customTags" parameter with your own custom tags. Custom tags is commonly used in a CMS for adding dynamic content (ex. slider, form, etc) within the content (by replacing the tags).
Example:
	$("#contentarea").contentbuilder({
		customTags: [["Contact Form", "{%CONTACT_FORM%}"],
			["Slider", "{%SLIDER%}"],
			["My Plugin", "{%MY_PLUGIN%}"]],         
        ...
    });
Or if used in an email building application:
	$("#contentarea").contentbuilder({
        customTags: [["First Name", "{%first_name%}"],
            ["Last Name", "{%last_name%}"],
            ["Email", "{%email%}"]],       
        ...
    });

To make all path absolute (for used in an email building application), set "absolutePath" parameter to true.
	$("#contentarea").contentbuilder({
        absolutePath: true,       
        ...
    });


*** EXAMPLES ***


- example1.html (basic)


- example2.php and example2.aspx (with saving example)

	This example saves all images first and then save the html content. To save all embedded images:

	Step 1: Include SaveImages.js plugin:

		<script src="contentbuilder/saveimages.js" type="text/javascript"></script>

	Step 2: Implement Saving as follows:

		function save() {
        
			//Save all images
			$("#contentarea").saveimages({
				handler: 'saveimage.php',
				onComplete: function () {

					//Get content
					var sHTML = $('#contentarea').data('contentbuilder').html();

					//Save content
					.....

				}
			});
			$("#contentarea").data('saveimages').save();

		}

	Step 3: Specify folder on the server for storing images on saveimage.php (or saveimage.ashx if you're using .NET).

- example3.php and example3.aspx (multiple instance example)

- example4.html (enable custom image or file select dialog)

	To try, hover an image, click the link icon to open the link dialog. Here you will see additional button to open your custom image/file select dialog)

- example5.html (simple custom snippets)


*** SPECIAL HOLIDAY GIFT (Dec 2016) ***

New Extra Blocks for email building using Foundation for Emails framework (assets/emailsnippets/snippets.html).

Checkout the example: example-email.html 

Usage: 

    $("#contentarea").contentbuilder({
        snippetFile: 'assets/emailsnippets/snippets.html',
        absolutePath:true,
        snippetOpen: true,
        toolbar: 'left',   
        customTags: [["First Name", "{%first_name%}"],
            ["Last Name", "{%last_name%}"],
            ["Email", "{%email%}"]],         
        snippetCategories: [
            [0,"Default"],
            [-1, "All"],
            [1, "Logo"],
            [2,"Title"],
            [3,"Title, Subtitle"],
            [4,"Info, Title"],
            [5,"Info, Title, Subtitle"],
            [6,"Heading, Paragraph"],
            [7,"Paragraph"],
            [8, "Buttons"],
            [9, "Callouts"],
            [10,"Images + Caption"],
            [11,"Images + Long Caption"],
            [12, "Images"],
            [13, "List"],
            [14,"Call to Action"],
            [15, "Pricing"],
            [16, "Quotes"],
            [17, "Profile"],
            [18, "Contact Info"],
            [19, "Footer"],
            [20,"Separator"]
            ]
    });

More about Foundation for Email framework: http://foundation.zurb.com/emails/getting-started.html


*** SNIPPETS ***


All examples use a snippets collection named "minimalist-basic", which is available at:
	
		- assets/minimalist-basic/snippets.html

	This collection is a basic version of our large snippets collection which is available at:

	http://innovastudio.com/content-builder/never-write-boring-content-again.aspx

	Here are the default snippets' categories:

		$("#contentarea").contentbuilder({
				 ...
				 snippetCategories: [
						[0,"Default"],
						[-1,"All"],
						[1,"Title"],
						[2,"Title, Subtitle"],
						[3,"Info, Title"],
						[4,"Info, Title, Subtitle"],
						[5,"Heading, Paragraph"],
						[6,"Paragraph"],
						[7,"Paragraph, Images + Caption"],
						[8,"Heading, Paragraph, Images + Caption"],
						[9,"Images + Caption"],
						[10,"Images + Long Caption"],
						[11,"Images"],
						[12,"Single Image"],
						[13,"Call to Action"],
						[14,"List"],
						[15,"Quotes"],
						[16,"Profile"],
						[17,"Map"],
						[20,"Video"],
						[18,"Social"],
						[21,"Services"],
						[22,"Contact Info"],
						[23,"Pricing"],
						[24,"Team Profile"],
						[25,"Products/Portfolio"],
						[26,"How It Works"],
						[27,"Partners/Clients"],
						[28,"As Featured On"],
						[29,"Achievements"],
						[32,"Skills"],
						[30,"Coming Soon"],
						[31,"Page Not Found"],
						[19,"Separator"]
					 ]
			 });

	On the snippets file, you can add, for example, data-cat="0,6" means it will be displayed on "Default" and "Paragraph" category.

	For example:
 
		<div data-thumb="assets/minimalist/thumbnails/g01.png" data-cat="0,6">
			.....HTML snippet here....
		</div>

	With this format, you can add your own snippets.
	

*** SUPPORT ***

Email us at: builder@innovastudio.com



---- IMPORTANT NOTE : ---- 
1. Custom Development is beyond of our support scope.
 
Once you get the HTML content, then it is more of to user's custom application (eg. posting it to the server for saving into a file, database, etc).
PHP programming, ASP.NET programming or server side implementation is beyond of our support scope. 
We also do not provide free custom development of extra features or functionalities.

2. Our support doesn't cover custom integration into users' applications. It is users' responsibility.
------------------------------------------
