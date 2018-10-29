<div id="filedit">
    <div id="messages"></div>
    <div id="text_file">
    
        <div id="gm_slider">
            <div class="hide-files"><div></div></div>
            <input type="number" value="1" id="linePos" min="1">
        </div>
        
        <div id="gm_hotbar">
            <div title="Plugin settings" data-action="open-actions-menu">
                <span class="fa fa-cog"></span>
            </div>
            <div title="Full mode" data-action="full-mode">
                <span class="fa fa-arrows-alt"></span>
            </div>
            <div title="Add window" data-action="new-window-editor">
            	<span class="fa fa-plus"></span>
            </div>
            <div title="Save file" data-action="action-save-file">
                <span class="fa fa-floppy-o"></span>
            </div>
            <div title="Files list" data-action="open-file-menu">
                <span class="fa fa-files-o"></span>
            </div>
            <div title="Code-completer" data-action="open-code-completer">
                <span class="fa fa-code"></span>
            </div>
        </div>
        
        <div id="gm_editors"></div>
        
        <div id="gm_actions" class="gm-sh-menu">
			<div>
				<div class="data-option">
					<div>
						<p class='gm_p'>Theme editor:</p>
						<select name="theme_editor">
							<option value="chrome">chrome</option>
							<option value="clouds">clouds</option>
							<option value="cobalt">cobalt</option>
							<option value="dreamweaver">dreamweaver</option>
							<option value="eclipse">eclipse</option>
							<option value="github">github</option>
							<option value="monokai">monokai</option>
							<option value="solarized_dark">solarized_dark</option>
							<option value="solarized_light">solarized_light</option>
							<option value="crimson_editor">crimson_editor</option>
							<option value="elefsy">elefsy</option>
						</select>
					</div>
					<p><input type="checkbox" name="wrapping" checked><span> Wrapping</span></p>
					<p><input type="checkbox" name="printMargin"><span> Print margin</span></p>
					<div>
						<p class='gm_p'>Side of sidebar:</p>
						<select name="sidebarside">
							<option value="left">Left side</option>
							<option value="right">Right side</option>
						</select>
					</div>
				</div>
			</div>
			<div class='gm_help_hot_key'>
				<p>[Ctrl-S] : Save</p>
				<p>[Ctrl-B] : ReadOnly On\Off</p>
				<p>[Ctrl-Q] : New window</p>
				<p>[Ctrl-Space] : Autocompletion menu</p>
				<p>[ Available Emmet plugin! ]</p>
			</div>
	    </div>
	    
	    <div id="gm_code_completer" class="gm-sh-menu">
	    	<?php
	    		foreach($_GMACE_CCS as $gmace_cc_key => $gmace_cc)
	    		{
	    			?>
	    			
	    			<div class="gm-cc-<?php print($gmace_cc_key); ?>">
	    				<h3><?php print($gmace_cc['name']); ?></h3>
	    				<div class="elems-container">
		    				<?php
		    					foreach($gmace_cc['tags'] as $tag)
		    					{
		    						if(!$tag['type'])
		    							$tag['type'] = "tag";
		    							$is_consist_sub_elems = is_array($tag['sub-elems']) && count($tag['sub-elems']);
		    							$is_consist_options = is_array($tag['options']) && count($tag['options']);
		    							$is_consist =  $is_consist_sub_elems || $is_consist_options;
		    						
		    						print('<div
		    							name="'.$tag['name'].'"
		    							class="elem-inserter '.( $is_consist ? "consist-list" : "" ).' '.$tag['type'].'"
		    							data-offset-col="'.$tag['offset_col'].'"
		    							data-offset-row="'.$tag['offset_row'].'"
		    							data-i-code="'.htmlspecialchars($tag['code']).'"><font>'.htmlspecialchars($tag['name']).'</font>');
		    							
		    						if($is_consist)
		    						{
		    							print('<div>');
		    							
		    							if($is_consist_sub_elems)
			    							foreach($tag['sub-elems'] as $sub_elem)
			    							{
			    								print('<span
			    									name="'.$sub_elem['name'].'"
					    							class="elem-sub-inserter '.$sub_elem['type'].'"
					    							data-offset-col="'.$sub_elem['offset_col'].'"
					    							data-offset-row="'.$sub_elem['offset_row'].'"
					    							data-i-code="'.htmlspecialchars($sub_elem['code']).'">'.htmlspecialchars($sub_elem['name']).'</span>');
			    							}
			    							
			    						elseif($is_consist_options)
			    							foreach($tag['options'] as $option)
			    							{
			    								print('<span
					    							class="elem-sub-option"
					    							data-i-code="'.htmlspecialchars($option).'">'.htmlspecialchars($option).'</span>');
			    							}
		    							
		    							print('</div>');
		    						}
		    							
		    						print('</div>');
		    					}
		    				?>
	    				</div>
	    			</div>
	    			
	    			<?php
	    		}
	    	?>
	    </div>
	    
    </div>
    <div id="file">
		<div>
			<ul class="folder-objects site-root" data-dir-folder="/">
				<li class="obj-folder">
					<span>/</span>
					<?php print(gmace_scan_to("/"));?>
				</li>
			</ul>
		</div>
    </div>
</div>

<script defer>
	function hideDenied()
	{
	<?php
		global $accessDenied;
		foreach($accessDenied as $dir)
		{
			?>
			if(jQuery("[data-dir-folder='<?php print($dir); ?>']:not(.blocked)").length)
	    	{
	    		jQuery("[data-dir-folder='<?php print($dir); ?>']").closest("li.obj-folder").data("obj-blocked", true).addClass("blocked");
	    	}
	    	<?php
		}
	?>
	}
	hideDenied();
</script>

<?php
// killself();
?>