(function($)
{
	$(document).on('ready', function()
	{
		let IS_REWRITING = false;
		let StatusBar = ace.require("ace/ext/statusbar").StatusBar;
		let THEME_EDITOR = "dreamweaver";
		let ggm_statusBar;

		if(getCookie("gmace_pars"))
		{
			THEME_EDITOR = JSON.parse(getCookie("gmace_pars")).theme || "dreamweaver";
			$("#filedit").addClass(JSON.parse(getCookie("gmace_pars")).side || "left");
			
			$("#gm_actions [name='theme_editor']").val( THEME_EDITOR );
			$("#gm_actions [name='sidebarside']").val( JSON.parse(getCookie("gmace_pars")).side || "left" );
		}
		
		let lastTabIndex = 0, dirNameAction, dirAction, unlinkUl;
		let archiveFormats = new Array("zip", "rar", "gzip");
		let openingFormats = new Array("bmp", "cpt", "gif", "hdr", "jpeg", "jpg", "jpe", "pcx", "pdf", "pdn", "png", "psd", "raw", "tga", "js", "css", "txt", "html", "xml");
		
		$("head").append( $("<style>", { html: "#filedit #text_file #gm_slider p.tab_editor.select, #filedit #text_file #gm_slider p.tab_editor:not(.select):hover, #gm_autocomplete .option-list p:hover { background-color: "+ $("#adminmenu li.current a.menu-top").css("background-color") +" ; color: white; }" }) );
		$("#gm_slider, #gm_hotbar").css({
			"background": $("#wpadminbar").css("background"),
			"border-color": $("#wpadminbar").css("background")
		});
		$("#file ul.folder-objects[data-dir-folder='/']").addClass("expand").parent().addClass("open");
		

		/* Restoring last opened tabs */
		{
			let openTabs = getCookie("opentabs");
			if(openTabs)
			{
				openTabs = JSON.parse(openTabs);
				if(openTabs.files.length)
				{
					for(let i = 0; i < openTabs.files.length; i++) if(openTabs.files[i]) addNewWindowEditor(openTabs.files[i]);
				}
				else addNewWindowEditor();
			}
			else addNewWindowEditor();
		}
		
		
	/* ------------------------ EVENT HOTBAR'S BUTTON ------------------------- */
		$("#gm_hotbar div[data-action='full-mode']").on('click', function()
		{
			if($("#filedit").hasClass("full-mode"))
			{
	    		$("#filedit").removeClass("full-mode");
	    		$("#filedit #text_file").after($("#filedit #file"));
	    	}
	    	else
	    	{
	    		$("#filedit").addClass("full-mode");
	    		$("#filedit #file").appendTo($("#filedit #text_file"));
	    	}

	    	changePar("resize");
		});


		$("#gm_hotbar div[data-action='new-window-editor']").on('click', function()
		{
			addNewWindowEditor();
		});


		$("#gm_hotbar div[data-action='action-save-file']").on('click',function()
		{
			writeToFile($("#gm_editors > div.shown").data("editor"));
		});


		$("#gm_hotbar div[data-action='open-code-completer']").on('click', function()
		{
			let editor = $("#gm_editors > div.shown").data("editor");
			
			let allClassesInEditor = getAllAttrValuesInEditor();
			if(allClassesInEditor.length)
			{
				let codeInserter_Class = $("#gm_code_completer .elems-container .elem-inserter[name='class']").addClass("consist-list");
				codeInserter_Class.children("div").remove().end().append("<div></div>");
				for(let i = 0; i<allClassesInEditor.length; i++)
				{
					codeInserter_Class.children("div").append(
						$("<span>", {
							text: allClassesInEditor[i],
							click: function()
							{
								let isInClass = isInAttr("class");
								if(isInClass > 0)
								{
									editor.insert();
									editor.moveCursorTo(editor.selection.getCursor().row, isInClass);
									editor.insert($(this).data("className") + " ");
								}
								else
								{
									editor.insert(" class=\"" + $(this).data("className") + "\"");
									editor.moveCursorTo(editor.selection.getCursor().row, editor.selection.getCursor().column - 1);
								}
								
								return false;
							}
						}).data("className", allClassesInEditor[i])
					);
				}
			}
			
			$("#gm_actions, #file").removeClass("expand");
			$("#gm_code_completer").toggleClass("expand");
		});


		$("#gm_hotbar div[data-action='open-actions-menu']").on('click', function()
		{
			$("#file, #gm_code_completer").removeClass("expand");
			$("#gm_actions").toggleClass("expand");
		});


		$("#gm_hotbar div[data-action='open-file-menu']").on('click', function()
		{
			$("#gm_actions, #gm_code_completer").removeClass("expand");
			$("#file").toggleClass("expand");
		});
		

		$("#gm_slider .hide-files").on('wheel', function(e)
		{
			let currentPosLeft = $("#gm_slider .hide-files > div").position().left;
			let scrollSize = 40;
			
			if(e.originalEvent.deltaY > 0 && $("#gm_slider .hide-files > div").width() + currentPosLeft > $("#gm_slider .hide-files").width())
			{
				$("#gm_slider .hide-files > div").css("left", currentPosLeft - scrollSize);
			}
			else if(e.originalEvent.deltaY < 0 && currentPosLeft + scrollSize <= 0)
			{
				$("#gm_slider .hide-files > div").css("left", currentPosLeft + scrollSize);
			}
		});
		

		$("#gm_code_completer > div .elem-inserter").on('click', function(e)
		{
			let _this = $(this), addt_code, tmpText;

			if($(e.target).is("#gm_code_completer > div .elem-inserter .elem-sub-inserter")) _this = $(e.target);
			else if($(e.target).is("#gm_code_completer > div .elem-inserter .elem-sub-option")) addt_code = $(e.target).data("i-code");
			
			let editor = $("#gm_editors > div.shown").data("editor");
			let code = _this.data("i-code")
				.replace(/\\n/g, "\n")
				.replace(/\\t/g, "\t")
				.replace(/\\r/g, "\r");
			
			if(editor.session.getTextRange(editor.getSelectionRange()))
			{
				tmpText = editor.session.getTextRange(editor.getSelectionRange());
			}
			
			let isInCSS_Attr = isInCSSAttr(_this.attr("name"));
			if(addt_code && isInCSS_Attr > 0)
			{
				editor.insert();
				editor.moveCursorTo(editor.selection.getCursor().row, isInCSS_Attr);
				editor.insert(" " + addt_code);
			}
			else
			{
				editor.insert(code);
				let new_pos = editor.selection.getCursor();
				editor.moveCursorTo(new_pos.row + Number(_this.data("offset-row")), new_pos.column + Number(_this.data("offset-col")));
				editor.insert(addt_code);
			}
			
			if(tmpText) editor.insert(tmpText);
			editor.focus();
		});
		

		$("#gm_actions [name='theme_editor']").on('change', function()
		{
	    	changeGMAceParametrs();
	    	changePar("theme", $(this).val());
	    	THEME_EDITOR = $(this).val();
	    });


	    $("#gm_actions [name='sidebarside']").on('change', function()
	    {
	    	changeGMAceParametrs();
	    	$("#filedit").removeClass("left right").addClass($(this).val());
	    });


	    $("#gm_actions input[name='wrapping']").on('change', function()
	    {
	    	changePar("wrapping", $(this).prop("checked"));
	    });


	    $("#gm_actions input[name='printMargin']").on('change', function()
	    {
	    	changePar("printMargin", $(this).prop("checked"));
	    });


	    $("#linePos").on('change', function()
	    {
	    	let sessLen = $("#gm_editors > div.shown").data("editor").session.getLength();
	        if($(this).val() > sessLen)
	        {
	            $(this).data("val", sessLen);
	        }
	    	$("#gm_editors > div.shown").data("editor").gotoLine($(this).val());
	    });


	    setInterval(function()
	    {
	    	if($("#linePos").data("val") != $("#linePos").val())
	    	{
	    		$("#linePos").data("val", $("#linePos").val()).trigger("change");
	    	}
	    	
	    	$(".gm_success:not(.checked), .gm_error:not(.checked)").each(function()
	    	{
				let _this = $(this);
				
				_this.slideDown(350).on('click', function()
				{
					_this.slideUp(350, function(){ _this.remove(); });
				})
				.addClass("checked");
				
				setTimeout(function(){ _this.trigger("click"); }, 10000);
			});
	    }, 100);
	    
	    
	    
	    function getAllAttrValuesInEditor()
	    {
	    	let editorValue = jQuery("#gm_editors > div.shown").data("editor").getValue();
	    	let classesArray = [];
	    	let matches = editorValue.match(/class=["|']([a-zA-Z0-9-_^"^' ]+)["|']/gi);
	    	
	    	if(matches && matches.length)
	    	for(let i = 0; i<matches.length; i++)
	    	{
	    		classesArray = classesArray.concat(matches[i].replace("class=", "").replace(/'/g, "").replace(/"/g, "").split(" "));
	    	}
	    	
	    	return $.unique(classesArray.filter(function(v){return v!==''})).sort(function(a, b)
	    	{
	    		a = a.replace(/-/g, "").replace(/_/g, "");
	    		b = b.replace(/-/g, "").replace(/_/g, "");
			    return ($(b).text()) < ($(a).text()) ? 1 : -1;
			});
	    }
	    
	    
	    
	    function isInAttr(attr)
	    {
	    	let editor = $("#gm_editors > div.shown").data("editor");
	    	
	    	let currentPrevText = editor.session.getTextRange({
	    		end: {
	    			row: editor.selection.getCursor().row,
	    			column: editor.selection.getCursor().column
	    		},
	    		start: {
	    			row: editor.selection.getCursor().row,
	    			column: 0
	    		}
	    	});
	    	
	    	return currentPrevText.substr(currentPrevText.lastIndexOf("\"")-1-attr.length, attr.length) == attr ? currentPrevText.lastIndexOf("\"")+1 : -1;
	    }
	    
	    
	    
	    function isInCSSAttr(attr)
	    {
	    	let editor = $("#gm_editors > div.shown").data("editor");
	    	
	    	let currentPrevText = editor.session.getTextRange({
	    		end: {
	    			row: editor.selection.getCursor().row,
	    			column: editor.selection.getCursor().column
	    		},
	    		start: {
	    			row: editor.selection.getCursor().row,
	    			column: 0
	    		}
	    	});
	    	
	    	return (currentPrevText.split(":").length - 1) > (currentPrevText.split(";").length - 1) && currentPrevText.substr(currentPrevText.lastIndexOf(":")-attr.length, attr.length) == attr ? currentPrevText.lastIndexOf(":")+1 : -1;
	    }
	    
	    
	    
	    
		function changeGMAceParametrs()
		{
			let parsArray = JSON.stringify({
				"theme": $("#gm_actions [name='theme_editor']").val(),
				"side": $("#gm_actions [name='sidebarside']").val()
			});
			
			let date = new Date(new Date().getTime() + 31536000000);
			document.cookie = "gmace_pars="+ parsArray +"; path=/; expires=" + date.toUTCString();
		}
		
		
		function changePar(par, val)
		{
			$("#gm_editors > div").each(function()
			{
				switch(par)
				{
					case "theme":
						$(this).data("editor").setTheme("ace/theme/"+ val);
					break;
					
					case "wrapping":
						$(this).data("editor").getSession().setUseWrapMode(val);
						$(this).data("editor").resize();
					break;
					
					case "resize":
						$(this).data("editor").resize();
					break;
					
					case "printMargin":
						$(this).data("editor").setShowPrintMargin(val);
						$(this).data("editor").resize();
					break;
				}
			});
		}
		
		
		$("#file").on('mousedown', function(e)
		{
			let _this = $(e.target);
			
			if(_this.closest("ul.folder-objects li").length)
			{
				_this = _this.closest("ul.folder-objects li");
				
				if(_this.hasClass("obj-file") && e.which == 2)
				{
					e.preventDefault();
					
					_this.off("mouseup");
					_this.on('mouseup', function(e)
					{
						if(e.which == 2) addNewWindowEditor(_this.closest("ul.folder-objects").data("dir-folder") + "/" + _this.text());
					});
					
					return false;
				}
			}
		})
		.on('click', function(e)
		{
			let _this = $(e.target);
			
			if(_this.closest("ul.folder-objects li").length)
			{
				if(_this.closest("#file li.obj-folder").data("obj-blocked"))
					return;
				
				_this = _this.closest("ul.folder-objects li");
				
				if(_this.hasClass("obj-folder") && !_this.closest("ul.folder-objects").is("#file > div > ul") && e.which == 1)
				{
					if(_this.children("ul.folder-objects").hasClass("expand"))
					{
						_this.removeClass("open").children("ul.folder-objects").slideUp().removeClass("expand");
					}
					else
					{
						_this.addClass("open").children("ul.folder-objects").slideDown().addClass("expand");
					}
				}
				else if(_this.hasClass("obj-file"))
				{
					if($("#gm_editors > div").length)
						readFromFile($("#gm_editors > div.shown").data("editor"), _this.closest("ul.folder-objects").data("dir-folder") + "/" + _this.text());
					else
						addNewWindowEditor(_this.closest("ul.folder-objects").data("dir-folder") + "/" + _this.text());
				}
			}
			
		})
		.on('contextmenu', function(e)
		{
			if(!e.shiftKey && $(e.target).closest("ul.folder-objects li").length)
			{
				openPropertyFile(e.pageY + 5, e.pageX + 5, $(e.target).closest("ul.folder-objects li"));
				e.preventDefault();
				return false;
			}
		})
		.disableSelection();
		
		
		function addNewWindowEditor(directory)
		{
			$("#gm_editors > div.shown").removeClass("shown");
			$("p.tab_editor.select").removeClass("select");
			
			let isTmpFile;
			if(!directory) isTmpFile = true;
			
			let current_datetime = (new Date()).getDate() + "-" + ((new Date()).getMonth() + 1) + "-" + (new Date()).getFullYear() + "_" + (new Date()).getHours() + "." + (new Date()).getMinutes() + "." + (new Date()).getSeconds();
			directory = directory ? directory.replace(new RegExp(/[\/]{2,}/g), "/") : "/gmacetmp/tmp-" + current_datetime + ".txt";
			let nameFile = directory.split("/");
				nameFile = nameFile[nameFile.length - 1];
			
			$("#gm_editors").append(
				$("<div>")
					.data("index", ++lastTabIndex)
					.data("directory", directory)
					.data("isTmpFile", isTmpFile)
					.addClass("shown")
					.attr("id", "gmace-editor-"+ lastTabIndex)
			);
			$("#gm_slider .hide-files > div").append(
				$("<p>", {
					class: "tab_editor select",
					html: "<a class='close_editor'></a><span>"+ nameFile +"</span>",
					click: function(e)
					{
						let _this = $(e.target);
						
						if(_this.is("#gm_slider a.close_editor"))
						{
							_this.parent().trigger("removeTab");
						}
						else if(!$(this).hasClass("select"))
						{
							let currentEditorScreen = $("#gm_editors > div#gmace-editor-" + $(this).data("index"));
							let currentLine = currentEditorScreen.data("editor").getCursorPosition().row + 1;
							
							$("p.tab_editor.select").removeClass("select");
							$("#gm_editors > div.shown").removeClass("shown");
							$("#linePos").data("val", currentLine).val(currentLine);
							currentEditorScreen.addClass("shown").data("editor").focus();
							currentEditorScreen.data("editor").resize();
							$(this).addClass("select");
							
							setStatusBar(currentEditorScreen.data("editor"));
						}
					}
				})
				.data("index", lastTabIndex).attr("id", "gmace-tab-"+ lastTabIndex)
				.on('mousedown', function(e)
				{
					if(e.which == 2)
					{
						e.preventDefault();
						$(this).one('mouseup', function(e) { if(e.which == 2) $(this).trigger("removeTab"); });
						return false;
					}
				})
				.on('removeTab', function()
				{
					let editor = $("#gm_editors > div#gmace-editor-"+ $(this).data("index")).data('editor');

					if($(this).hasClass("select"))
					{
						$("#gm_editors > div#gmace-editor-"+ $(this).data("index")).remove();
						$(this).remove();
						
						if( $("#gm_editors > div").length )
						{
							$("#gmace-editor-"+ $("#gm_slider p.tab_editor:first-child").addClass("select").data("index")).addClass("shown");
							$("#gm_editors > div.shown").data("editor").resize();
						}
					}
					else
					{
						$("#gm_editors > div#gmace-editor-"+ $(this).data("index")).remove();
						$(this).remove();
					}

					editor.destroy();
					editor.container.remove();
					
					$("#gm_slider .hide-files > div").width($("p.tab_editor").width() * $("p.tab_editor").length);
					
					if($("#gm_slider .hide-files > div").width() <= $("#gm_slider .hide-files").width())
					{
						$("#gm_slider .hide-files > div").css("left", 0);
					}
					
					saveOpenedTab();
				})
			);
			
			let editor_n = ace.edit("gmace-editor-"+ lastTabIndex);
			$(editor_n).data("index", lastTabIndex).data("first-change", true); // ace_focus
		
			editor_n.setTheme("ace/theme/"+ THEME_EDITOR);
			editor_n.getSession().setMode("ace/mode/php");
			editor_n.setOption("enableEmmet", true);
			editor_n.setOption("enableBasicAutocompletion", true);
			editor_n.setShowPrintMargin(false);
			editor_n.getSession().setUseWrapMode(true);
			editor_n.getSession().setUseSoftTabs(false);
	
			editor_n.commands.addCommand({
				name: 'save',
				bindKey:{ win: 'Ctrl-S',  mac: 'Command-S' },
				exec: function(editor)
				{
					writeToFile(editor);
				}
			});
			editor_n.commands.addCommand({
				name: 'newwindow',
				bindKey:{ win: 'Ctrl-Q',  mac: 'Command-Q' },
				exec: function(editor)
				{
					addNewWindowEditor();
				}
			});
			editor_n.commands.addCommand({
				name: 'block',
				bindKey:{ win: 'Ctrl-B',  mac: 'Command-B' },
				exec: function(editor)
				{
					if($("#gm_editors > div.shown").data("readonly") == "true")
					{
					    editor.setReadOnly(false);
					    $("#gm_editors > div.shown").data("readonly", "false").removeClass("readonly");
					}
					else
					{
					    editor.setReadOnly(true);
					    $("#gm_editors > div.shown").data("readonly", "true").addClass("readonly");
					}
				},
				readOnly: true
			});
			
			editor_n.on('change', onEditorChange);
			
			editor_n.on('focus', onEditorFocus);

			editor_n.getSession().selection.on('changeCursor', function(e)
			{
				let yPos = $("#gm_editors > div.shown").data("editor").getCursorPosition().row + 1;
			    $("#linePos").data("val", yPos).val(yPos);
			    saveOpenedTab();
			});
			
			$("#gm_editors > div#gmace-editor-"+ lastTabIndex).data("editor", editor_n);
			$("#gm_slider .hide-files > div").width($("p.tab_editor").width() * $("p.tab_editor").length);
			readFromFile(editor_n);
			setStatusBar(editor_n);
		}
		
		
		function readFromFile(editor, directory)
		{
			directory = directory || $("#gm_editors > div.shown").data("directory");
			let fileName = directory.split("/");
				fileName = fileName[fileName.length - 1];
			let shortFileName = fileName.length >= 20?fileName.substring(0, 17)+"...":fileName;
			
			directory.replace("//", "");
			
			$("#gm_editors > div.shown").data("directory", directory);
			$("#gmace-tab-"+ $("#gm_editors > div.shown").data("index")).find("span").text(shortFileName).attr("title", directory);
			
			$.post(ajaxurl, {
				action: 'gmace_manager',
				_op: 'read',
				directory: directory
			}, function(response) {
				setModeEditor(editor, directory);
				editor.setValue(response);
				if(!$("#filedit").hasClass("full-mode"))
					editor.focus();
				editor.gotoLine(0);
				$(window).resize();
			});
			
			saveOpenedTab();
		}
		
		
		function writeToFile(editor)
		{
			let flagAllowRewrite = true;
			let annotations = editor.getSession().getAnnotations();
			
			if(editor.session.$modeId == "ace/mode/php")
			{
				for(let i = 0; i < annotations.length; i++)
				{
					if(annotations[i].type == "error")
					{
						$("#messages").append("<div class='gm_error'>" + annotations[i].text + " (" + annotations[i].row + ", " + annotations[i].column + ")</div>");
						editor.gotoLine(annotations[i].row);
						flagAllowRewrite = false;
						break;
					}
				}
			}
			
			if(flagAllowRewrite)
			{
				let directory = $("#gm_editors > div.shown").data("directory");

				if(!IS_REWRITING)
				{
					IS_REWRITING = true;

					$.post(ajaxurl, {
						action: 'gmace_manager',
						_op: 'rewrite_file',
						directory: $("#gm_editors > div.shown").data("directory"),
						content: editor.getValue()
					}, function(response)
					{
						IS_REWRITING = false;
						
						if(Number(response) == 1)
						{
							if($("#gm_editors > div.shown").data("isTmpFile"))
							{
								if(!$("#file ul.folder-objects[data-dir-folder='/gmacetmp']").length)
								{
									let gmaceTmp = $("<li>", {
										class: "obj-folder open"
									}).append(
										$("<span>", {
											text: "gmacetmp"
										})
									).append(
										$("<ul>", {
											class: "folder-objects expand"
										}).attr("data-dir-folder", "/gmacetmp").data("dir-folder", "/gmacetmp")
									);
									let firstLi = $("#file ul.site-root ul.folder-objects[data-dir-folder='/'] > li:first-child");
									firstLi.after(gmaceTmp);
									gmaceTmp.after(firstLi);
								}
								
								$.post(ajaxurl, {
									action: 'gmace_manager',
									_op: 'update_obj',
									directory: "/gmacetmp"
								}, function(response)
								{
									let parent = $("#file ul.folder-objects[data-dir-folder='/gmacetmp']:not(.site-root)").parent();
									
									parent.children("ul").remove();
									parent.append(response).trigger("click");
									parent.addClass("open").children("ul").addClass("expand");
									
									hideDenied();
								});
							}
							
							$("#messages").append("<div class='gm_success'>File <i>"+ directory+"</i> rewrited</div>");
						}
						else
						{
							$("#messages").append("<div class='gm_error'>File <i>"+ directory+"</i> called error</div>");
						}
					});
				}
			}
		}
		
		
		function setModeEditor(editor, filedir)
		{
			let plangs = {
				'rb': "ruby",
				'css': "css",
				'scss': "scss",
				'sass': "sass",
				'less': "less",
				'json': "json",
				'java': "java",
				'py': "python",
				'js': "javascript",
				'coffee': "coffee",
				'html,htm,xhtml': "html",
				'htaccess,htpasswd': "apache_conf"
			};

			filedir = filedir.split("/");
			filedir = filedir[filedir.length - 1];
			filedir = filedir.split(".");
			filedir = filedir[filedir.length - 1];

			Object.keys(plangs).map(function(key)
			{
				let plang = plangs[key];
				if( key.indexOf(filedir) >= 0 )
				{
					editor.getSession().setMode("ace/mode/"+ plang);
				}
			});
		}
		
		
		function setStatusBar(editor)
		{
			if(ggm_statusBar) ggm_statusBar.remove();
			ggm_statusBar = $("<div>", { id: "gm_statusBar" }).appendTo($("#text_file"));
			
			new StatusBar(editor, ggm_statusBar[0]);
		}
		
		
		function saveOpenedTab()
		{
			let openedtab = { files: [] };
			
			$("#gm_editors > div").each(function(){
				openedtab.files[openedtab.files.length] = encodeURIComponent( $(this).data("directory") );
			});
			
			openedtab = JSON.stringify(openedtab);
			
			let date = new Date(new Date().getTime() + 31536000000);
			document.cookie = "opentabs="+ openedtab +"; path=/; expires=" + date.toUTCString();
			
		}
		
		
		function getCookie(name)
		{
			let matches = document.cookie.match(new RegExp(
					"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
				));
			return matches ? decodeURIComponent(matches[1]) : undefined;
		}
		
		
		function openPropertyFile(y, x, elementFile)
		{
			if(elementFile.closest("#file li.obj-folder").data("obj-blocked"))
				return;
			
			let directory = (elementFile.closest("ul.folder-objects").data("dir-folder") + "/" + elementFile.children("span").text()).replace(/[\/]{2,}/g, "/");
			let fileName = directory.split("/");
				fileName = fileName[fileName.length - 1];
			let fileDir = directory.substring(0, directory.length - fileName.length - 1);
				fileDir = fileDir ? fileDir : "/";
			let type_obj = elementFile.hasClass("obj-file")?"file":"folder";
			
			$("#property_menu").remove();
			
			$("<div>", {
				"id" : "property_menu",
				"data-file" : fileName,
				"data-dir" : fileDir
			}).css({"left": x, "top": y}).append(
				$("<span>",{
					text : fileName ? fileName : location.host
				})
			).append(
				$("<p>",{
					"class" : "copy",
					text : "Copy",
					click: function()
					{
						dirAction = "copy";
						dirNameAction = directory;
						$("#property_menu").remove();
					}
				})
			).append(
				$("<p>",{
					"class" : "cut",
					text : "Cut",
					click: function()
					{
						$("li.obj-folder.transparent").removeClass("transparent");
						elementFile.addClass("transparent");
						unlinkUl = type_obj == "file"? elementFile : elementFile;
						dirAction = "cut";
						dirNameAction = directory;
						$("#property_menu").remove();
					}
				})
			).append(
				$("<p>",{
					"class" : "paste",
					text : "Paste",
					"buffered" : dirNameAction == null || dirAction == null ? "false" : "true",
					click: function()
					{
						if(dirNameAction != null && dirAction != null)
						{
							$.post(ajaxurl, {
								action: 'gmace_manager',
								_op: 'paste_file',
								type: dirAction,
								"to-directory": fileDir+"/"+fileName,
								"from-directory": dirNameAction
							}, function(response)
							{
								elementFile.children("ul").remove();
								elementFile.append(response).trigger("click");
								elementFile.addClass("open").children("ul").addClass("expand");
								
								$("#property_menu").addClass("info_run").css({
									"width":"280px",
									"height":"65px"
								});
								if(dirAction == "copy")
								{
									$("#property_menu").html("<bold><p>Successfully copied</p></bold>");
								}
								else if(dirAction == "cut")
								{
									$("#property_menu").html("<bold><p>Successfully moved</p></bold>");
								}
								
								if(unlinkUl != null)
								{
									unlinkUl.remove();
								}
								
								unlinkUl = dirNameAction = dirAction  = null;
								
								hideDenied();
							});
						}
					}
				})
			).append(
				$("<p>",{
					"class" : "rename newhead",
					text : "Rename",
					click: function()
					{
						$("#property_menu").addClass("menu-control").html("<p class='dg-prm-head'>Renaming " + directory + "</p><input type='text' value='"+ fileName +"'><input type='button' class='button button-primary' value='Apply'>");
						
						$("#property_menu input.button-primary").on('click', function()
						{
							$.post(ajaxurl, {
								action: 'gmace_manager',
								_op: 'rename_and_delete_file',
								type: "rename",
								newname: $("#property_menu input[type='text']").val(),
								directory: fileDir,
								file: fileName
							}, function(response)
							{
								let parent = elementFile.parent("ul").parent();
								
								parent.children("ul").remove();
								parent.append(response);
								parent.addClass("open").children("ul").addClass("expand");
								
								$("#property_menu").html("<bold><p>Successfully renamed</p></bold>");
							
								hideDenied();
							});
						});
					}
				})
			).append(
				$("<p>",{
					"class" : "delete",
					text : "Delete",
					click: function()
					{
						elementFile.addClass("red");
						
						setTimeout(function()
						{
							if(confirm("Are you sure you want to delete an object \""+ fileName +"\"?"))
							{
								$.post(ajaxurl, {
									action: 'gmace_manager',
									_op: 'rename_and_delete_file',
									type: "delete",
									directory: fileDir,
									file: fileName
								}, function(response)
								{
									let parent = elementFile.parent("ul").parent();
									
									parent.children("ul").remove();
									parent.append(response).trigger("click");
									parent.addClass("open").children("ul").addClass("expand");
									
									$("#property_menu").addClass("info_run").css({
										"width":"280px",
										"height":"65px"
									}).html("<bold><p>Successfully deleted</p></bold>");
									
									hideDenied();
								});
							}
							else elementFile.removeClass("red");
						}, 10);
					}
				})
			).append(
				$("<p>",{
					"class" : "new_file newhead",
					text : "New file",
					click: function()
					{
						$("#property_menu").addClass("menu-control").html("<p class='dg-prm-head'>Creating file in " + directory + "</p><input type='text'><input type='button' class='button button-primary' value='Create'>");
						
						$("#property_menu input.button-primary").on('click', function()
						{
							$.post(ajaxurl, {
								action: 'gmace_manager',
								_op: 'create',
								type: "file",
								directory: fileDir +"/"+ fileName,
								name: $("#property_menu input[type='text']").val()
							},
							function(response)
							{
								let parent = elementFile.parent("ul").parent();
								
								elementFile.children("ul").remove();
								elementFile.append(response).trigger("click");
								elementFile.addClass("open").children("ul").addClass("expand");
								
								$("#property_menu").html("<bold><p>Successfully created</p></bold>");
								
								hideDenied();
							});
						});
					}
				})
			).append(
				$("<p>",{
					"class" : "new_folder",
					text : "New folder",
					click: function()
					{
						$("#property_menu").addClass("menu-control").html("<p class='dg-prm-head'>Creating folder in " + directory + "</p><input type='text'><input type='button' class='button button-primary' value='Create'>");
						
						$("#property_menu input.button-primary").on('click', function()
						{
							$.post(ajaxurl, {
								action: 'gmace_manager',
								_op: 'create',
								type: "folder",
								directory: fileDir +"/"+ fileName,
								name: $("#property_menu input[type='text']").val()
							}, function(response)
							{
								let parent = elementFile.parent("ul").parent();
								
								elementFile.children("ul").remove();
								elementFile.append(response).trigger("click");
								elementFile.addClass("open").children("ul").addClass("expand");
								
								$("#property_menu").html("<bold><p>Successfully created</p></bold>");
							
								hideDenied();
							});
						});
					}
				})
			).append(
				$("<p>",{
					"class" : "upload_file",
					text : "Upload file",
					click: function()
					{
						
					}
				})
			).append(
				$("<p>",{
					"class" : "download newhead",
					text : "Download file",
					click: function()
					{
						window.open("/wp-admin/admin.php?page=gmace-editor&gm-download-file="+ fileDir.replace("/www", "") +"/"+ fileName, "_blank");
					}
				})
			).append(
				$("<p>",{
					"class" : "unzip",
					text : "Extract",
					click: function()
					{
						$.post(ajaxurl, {
							action: 'gmace_manager',
							_op: 'extract_file',
							directory: fileDir,
							file: fileName
						}, function(response)
						{
							let parent = elementFile.parent("ul").parent();
							
							parent.children("ul").remove();
							parent.append(response).trigger("click");
							parent.addClass("open").children("ul").addClass("expand");
							
							$("#property_menu").remove();
								
							hideDenied();
						});
					}
				})
			).append(
				$("<p>",{
					"class" : "openinnewtab",
					text : "Open in new tab",
					click: function()
					{
						window.open(fileDir.replace("/www", "") +"/"+ fileName, "_blank");
					}
				})
			).append(
				$("<p>",{
					"class" : "update-folder newhead",
					text : "Update folder",
					click: function()
					{
						$.post(ajaxurl, {
							action: 'gmace_manager',
							_op: 'update_obj',
							directory: directory
						}, function(response)
						{
							let parent = $("#file ul.folder-objects[data-dir-folder='"+ directory +"']:not(.site-root)").parent();
							
							parent.children("ul").remove();
							parent.append(response).trigger("click");
							parent.addClass("open").children("ul").addClass("expand");
							
							$("#property_menu").remove();
								
							hideDenied();
						});
					}
				})
			).append(
				$("<p>",{
					"class" : "property newhead",
					text : "Property",
					click: function()
					{
						$.post(ajaxurl, {
							action: 'gmace_manager',
							_op: 'get_property',
							directory: fileDir,
							file: fileName
						}, function(response)
						{
							$("#property_menu").addClass("info_run").html("<p class='dg-prm-head'>" + directory + "</p>" + response);
						});
					}
				})
			).appendTo("#filedit");
			
			if(!fileName && type_obj == "folder")
			{
				$("#property_menu .copy, #property_menu .cut, #property_menu .rename, #property_menu .delete").remove();
			}
			if(type_obj == "file")
			{
				$("#property_menu .paste, #property_menu .new_folder, #property_menu .new_file, #property_menu .update-folder, #property_menu .upload_file").remove();
				
				if($.inArray(elementFile.attr("type"), archiveFormats) < 0)
				{
					$("#property_menu .unzip").remove();
				}
				if($.inArray(elementFile.attr("type"), openingFormats) < 0)
				{
					$("#property_menu .openinnewtab").remove();
				}
			}
			else
			{
				$("#property_menu .property").removeClass("newhead");
				$("#property_menu .download, #property_menu .unzip, #property_menu .openinnewtab").remove();
			}
			
			
			if(x + $("#property_menu").width() > $(window).width()) $("#property_menu").css({"left": "auto", "right": 0});
			if(y + $("#property_menu").height() > $(window).height()) $("#property_menu").css({"top": "auto", "bottom": 0});
			
			
			// Deleting property menu
			$(document).off("mousedown").on('mousedown', function(e)
			{
				if(!$(e.target).closest("#property_menu").length)
				{
					$("#property_menu").remove();
				}
			});
		}


		function onEditorFocus()
		{
			$("#gm_actions, #file, #gm_code_completer").removeClass("expand");
			$("#gm_editors > div.focus").removeClass("focus");
			$( $("#gm_editors > div.shown").data('editor') ).data('first-change', false);
		}


		_GMACE_AUTOCOMPLETERS = {};
		_GMACE_AUTOCOMPLETERS_KEYS = {};
		function onEditorChange(e)
		{
			let editorCnt = $("#gm_editors > div.shown");
			let editor = editorCnt.data("editor");

			try {
				if( e.data.action == "insertLines" || e.data.action == "removeLines" || e.data.text.charCodeAt(0) == 10 )
				{
					$("#gm_autocomplete").remove();
					return;
				}
			} catch(err) {}
			if( $(editor).data('first-change') ) return;

			let langMode = editor.getSession().$modeId == "ace/mode/php" ? "php" : ( editor.getSession().$modeId == "ace/mode/javascript" ? "js" : false );
			if(!langMode) return;

			let range = editor.getSelectionRange();
				range.start.column = 0;
				range.end.column += 1;
			let text = editor.getSession().doc.getTextRange(range);
				text = text.split(" ");
				text = text[text.length - 1].split(".");
				text = text[text.length - 1];

			if(!text || text.length < 3 || ( e.data.action == "removeText" && !$("#gm_autocomplete").length )) $("#gm_autocomplete").remove();
			else
			{
				let dropdownAutocompleter = $("<div>", { id: "gm_autocomplete" })
				.append("<div class='option-list'></div>")
				.data('text', text).data('range', range)
				.on('mouseout', function(e) {
					if(!$(e.relatedTarget).closest("#gm_autocomplete").length && !$(e.relatedTarget).is(".tooltip-desc"))
						$("#gm_autocomplete .tooltip-desc").remove();
				});

				if(_GMACE_AUTOCOMPLETERS[langMode])
				{
					for(let i = 0; i < _GMACE_AUTOCOMPLETERS_KEYS[langMode].length; i++)
					{
						let tag = _GMACE_AUTOCOMPLETERS_KEYS[langMode][i];

						if( text.toLowerCase() !== tag.toLowerCase().substr(0, text.length) ) continue;
						dropdownAutocompleter.find(".option-list").append(
							$('<p><span>'+ tag +'</span><i class="fa fa-'+ _GMACE_AUTOCOMPLETERS[langMode][tag].type +'"></i></p>').data('tag', tag)
						);
					}
				}

				if(dropdownAutocompleter.find("p").length)
				{
					$("#gm_autocomplete").remove();
					dropdownAutocompleter.css({
						'top': $("#gm_slider").outerHeight() + editorCnt.find(".ace_cursor").position().top - 5,
						'left': $(".ace_gutter").outerWidth() + editorCnt.find(".ace_cursor").position().left + 30
					})
					.appendTo( $("#text_file") );

					dropdownAutocompleter.find("p")
					.on('click', function()
					{
						let tag = _GMACE_AUTOCOMPLETERS[langMode][$(this).data('tag')];
						let insertText = $(this).data('tag') +"(";
						let insertPars = [];

						for(let i = 0; i < tag.params.length; i++)
						{
							if(tag.params[i].required === "yes" || true)
							{
								if(editor.getSession().$modeId == "ace/mode/php")
								{
									tag.params[i].param.split(" ").forEach(function(word)
									{
										if(word.substring(0, 1) == "$") insertPars.push(word.replace(",", ""));
									});
								}
								else insertPars.push( tag.params[i].param );
							}
						}
						insertText += insertPars.join(", ") + ")";

						let text = editor.getSession().doc.getTextRange( dropdownAutocompleter.data('range') );
							text = text.substring(0, text.length - dropdownAutocompleter.data('text').length);
							text += insertText;

						editor.getSession().replace( dropdownAutocompleter.data('range'), text );
						editor.focus();
					})
					.on('hover', function()
					{
						$("#gm_autocomplete .tooltip-desc").remove();

						let tag = _GMACE_AUTOCOMPLETERS[langMode][$(this).data('tag')];
						dropdownAutocompleter.append(
							$("<div>", { class: "tooltip-desc" })
							.append("<h5>"+ $(this).data('tag').replace(" = ''", "") +"()</h5>")
							.append("<div class='fdesc'>"+ tag.desc +"</div>")
							.append("<div class='fpars'>"+ (tag.params.slice(0).map(function(param)
							{
								return "<div><h6>"+ param.param.replace(" = ''", "") +"<span>"+ (param.required == "yes" ? "(Required)" : "(Optional)") +"</span></h6><p>"+ (param.hasOwnProperty('desc') ? param.desc : "") +"</p></div>";
							})).join("") +"</div>")
						);

						let offsetLeft = dropdownAutocompleter.position().left + $("#gm_autocomplete .tooltip-desc").position().left;
						if( offsetLeft + $("#gm_autocomplete .tooltip-desc").outerWidth() > $("#text_file").width() - 32 )
						{
							$("#gm_autocomplete .tooltip-desc").width( $("#text_file").width() - 32 - offsetLeft );
						}
					});
				}
				else $("#gm_autocomplete").remove();
			}
		}


		function addAutocompleter(functions, group)
		{
			if( !_GMACE_AUTOCOMPLETERS[ group ] ) _GMACE_AUTOCOMPLETERS[ group ] = {};

			_GMACE_AUTOCOMPLETERS[ group ] = Object.assign(_GMACE_AUTOCOMPLETERS[ group ], functions);
			Object.keys(_GMACE_AUTOCOMPLETERS).forEach(function(key)
			{
				_GMACE_AUTOCOMPLETERS_KEYS[ group ] = Object.keys(_GMACE_AUTOCOMPLETERS[ group ]).sort();
			});
		}
		addAutocompleter(autocomplete_wordpress, 'php');
		addAutocompleter(autocomplete_php, 'php');
		addAutocompleter(autocomplete_js, 'js');
	});
})(jQuery);