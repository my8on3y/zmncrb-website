<?php
	$_GMACE_CCS = array(
		
    	'html' => array(
    		'name' => 'HTML',
    		'tags' => array(
    			array(
	    			'name' => 'html',
	    			'code' => '<!DOCTYPE>\n<html>\n\t<head>\n\t\t\n\t</head>\n\t<body>\n\t\t\n\t</body>\n</html>',
	    			'offset_col' => 1,
	    			'offset_row' => -2
	    		),
    			array(
	    			'name' => 'p',
	    			'code' => '<p></p>',
	    			'offset_col' => -4
	    		),
    			array(
	    			'name' => 'span',
	    			'code' => '<span></span>',
	    			'offset_col' => -7
	    		),
    			array(
	    			'name' => 'font',
	    			'code' => '<font></font>',
	    			'offset_col' => -7
	    		),
    			array(
	    			'name' => 'div',
	    			'code' => '<div></div>',
	    			'offset_col' => -6
	    		),
    			array(
	    			'name' => 'header',
	    			'code' => '<header></header>',
	    			'offset_col' => -9
	    		),
    			array(
	    			'name' => 'footer',
	    			'code' => '<footer></footer>',
	    			'offset_col' => -9
	    		),
    			array(
	    			'name' => 'article',
	    			'code' => '<article></article>',
	    			'offset_col' => -10
	    		),
    			array(
	    			'name' => 'php',
	    			'code' => '<?php  ?>',
	    			'offset_col' => -3,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'onClick',
	    			'code' => ' onClick=""',
	    			'offset_col' => -1,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'onChange',
	    			'code' => ' onChange=""',
	    			'offset_col' => -1,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'onSubmit',
	    			'code' => ' onSubmit=""',
	    			'offset_col' => -1,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'id',
	    			'code' => ' id=""',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		),
    			array(
	    			'name' => 'class',
	    			'code' => ' class=""',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		),
    			array(
	    			'name' => 'style',
	    			'code' => ' style=""',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		)
    		)
    	),
    	
    	'css' => array(
    		'name' => "CSS",
    		'tags' => array(
    			array(
	    			'name' => 'background',
	    			'code' => 'background: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		),
    			array(
	    			'name' => 'color',
	    			'code' => 'color: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		),
    			array(
	    			'name' => 'text-align',
	    			'code' => 'text-align: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'options' => array('left', 'center', 'right', 'justify')
	    		),
    			array(
	    			'name' => 'text-decoration',
	    			'code' => 'text-decoration: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'options' => array('none', 'underline', 'overline', 'line-through')
	    		),
    			array(
	    			'name' => 'text-transform',
	    			'code' => 'text-transform: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'options' => array('none', 'uppercase', 'lowercase', 'capitalize')
	    		),
    			array(
	    			'name' => 'font-size',
	    			'code' => 'font-size: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		),
    			array(
	    			'name' => 'font-family',
	    			'code' => 'font-family: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr'
	    		),
    			array(
	    			'name' => 'font-weight',
	    			'code' => 'font-weight: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'options' => array('normal', 'lighter', 'bold')
	    		),
    			array(
	    			'name' => 'margin',
	    			'code' => 'margin: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'sub-elems' => array(
	    				array(
		    				'name' => 'margin-top',
			    			'code' => 'margin-top: ;',
			    			'offset_col' => -1,
		    			),
	    				array(
		    				'name' => 'margin-left',
			    			'code' => 'margin-left: ;',
			    			'offset_col' => -1,
		    			),
	    				array(
		    				'name' => 'margin-right',
			    			'code' => 'margin-right: ;',
			    			'offset_col' => -1,
		    			),
	    				array(
		    				'name' => 'margin-bottom',
			    			'code' => 'margin-bottom: ;',
			    			'offset_col' => -1,
		    			)
	    			)
	    		),
    			array(
	    			'name' => 'padding',
	    			'code' => 'padding: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'sub-elems' => array(
	    				array(
		    				'name' => 'padding-top',
			    			'code' => 'padding-top: ;',
			    			'offset_col' => -1,
		    			),
	    				array(
		    				'name' => 'padding-left',
			    			'code' => 'padding-left: ;',
			    			'offset_col' => -1,
		    			),
	    				array(
		    				'name' => 'padding-right',
			    			'code' => 'padding-right: ;',
			    			'offset_col' => -1,
		    			),
	    				array(
		    				'name' => 'padding-bottom',
			    			'code' => 'padding-bottom: ;',
			    			'offset_col' => -1,
		    			)
	    			)
	    		),
    			array(
	    			'name' => 'display',
	    			'code' => 'display: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'options' => array('none', 'block', 'inline', 'inline-block', 'flex', 'inline-flex', 'table', 'inline-table')
	    		),
    			array(
	    			'name' => 'position',
	    			'code' => 'position: ;',
	    			'offset_col' => -1,
	    			'type' => 'attr',
	    			'options' => array('static', 'absolute', 'relative', 'fixed')
	    		)
    		)
    	),
    	
    	'js' => array(
    		'name' => "JavaScript",
    		'tags' => array(
    			array(
	    			'name' => 'console.log',
	    			'code' => 'console.log();',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'alert',
	    			'code' => 'alert();',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'array',
	    			'code' => 'var array = new Array();',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'if',
	    			'code' => 'if() {  }',
	    			'offset_col' => -6,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'if-else',
	    			'code' => 'if() {  } else {  }',
	    			'offset_col' => -16,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'for',
	    			'code' => 'for(var icount = 0; icount < 10; icount++) {  }',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'while',
	    			'code' => 'while() {  }',
	    			'offset_col' => -6,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'do-while',
	    			'code' => 'do {  } while();',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'return',
	    			'code' => 'return true;',
	    			'offset_col' => -1,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'continue',
	    			'code' => 'continue;',
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'break',
	    			'code' => 'break;',
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'split',
	    			'code' => '.split("")',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'join',
	    			'code' => '.join("")',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'replace',
	    			'code' => '.replace(//g, "")',
	    			'offset_col' => -7,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'getElementById',
	    			'code' => '.getElementById("")',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		),
    			array(
	    			'name' => 'getElementsByClassName',
	    			'code' => '.getElementsByClassName("")',
	    			'offset_col' => -2,
	    			'type' => 'script'
	    		)
    		)
    	),
    	
    	'php' => array(
    		'name' => "PHP",
    		'tags' => array(
    			array(
	    			'name' => 'print',
	    			'code' => 'print("");',
	    			'offset_col' => -3,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'print_r',
	    			'code' => 'print_r($array);',
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'printf',
	    			'code' => 'printf("%s", $par1);',
	    			'offset_col' => -10,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'var_dump',
	    			'code' => 'var_dump($var);',
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'array',
	    			'code' => '$array = array();',
	    			'offset_col' => -2,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'if',
	    			'code' => 'if() {  }',
	    			'offset_col' => -6,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'if-else',
	    			'code' => 'if() {  } else {  }',
	    			'offset_col' => -16,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => '<if: endif>',
	    			'code' => '<?php if(): ?>\n\t\n<?php endif; ?>',
	    			'offset_row' => -2,
	    			'offset_col' => -6,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => '<if: else: endif>',
	    			'code' => '<?php if(): ?>\n\t\n<?php else: ?>\n\t\n<?php endif; ?>',
	    			'offset_row' => -4,
	    			'offset_col' => -6,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'for',
	    			'code' => 'for($icount = 0; $icount < 10; $icount++) {  }',
	    			'offset_col' => -2,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'while',
	    			'code' => 'while() {  }',
	    			'offset_col' => -6,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'do-while',
	    			'code' => 'do {  } while();',
	    			'offset_col' => -2,
	    			'type' => 'php'
	    		),
    			array(
	    			'name' => 'return',
	    			'code' => 'return $var;',
	    			'offset_col' => -1,
	    			'type' => 'php'
	    		)
    		)
    	)
    );
?>