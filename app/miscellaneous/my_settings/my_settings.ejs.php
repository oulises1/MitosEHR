<?php 
//******************************************************************************
// new.ejs.php
// New Patient Entry Form
// v0.0.1
// 
// Author: Ernest Rodriguez
// Modified: GI Technologies, 2011
// 
// MitosEHR (Electronic Health Records) 2011
//******************************************************************************
session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');

include_once($_SESSION['site']['root']."/classes/I18n.class.php");

//******************************************************************************
// Reset session count 10 secs = 1 Flop
//******************************************************************************
$_SESSION['site']['flops'] = 0;

?>
<script type="text/javascript">
Ext.onReady(function(){
	// *************************************************************************************
	// User Settings Form
	// Add or Edit purpose
	// *************************************************************************************
	var uSettingsForm = new Ext.create('Ext.mitos.FormPanel', {
	  	id          : 'uSettingsForm',
	  	bodyStyle   : 'padding: 10px;',
		cls			: 'form-white-bg',
		frame		: true,
		hideLabels  : true,
	 	items: [{
	 		xtype: 'textfield', hidden: true, id: 'id', name: 'id'
	 	},{
		 	xtype:'fieldset',
	        title: '<?php i18n('Appearance Settings'); ?>',
	        collapsible: true,
	        defaultType: 'textfield',
	        layout: 'anchor',
	        defaults: {
				labelWidth: 89,
			    anchor: '100%',
			    layout: {
			    	type: 'hbox',
			        defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
			    }
			},
	        items :[{
				// fields
			},{
			
			},{
			
		    }]
	    },{
	    	xtype:'fieldset',
	        title: '<?php i18n('Locale Settings'); ?>',
	        collapsible: true,
	        defaultType: 'textfield',
	        layout: 'anchor',
	        defaults: {
				labelWidth: 89,
			    anchor: '100%',
			    layout: {
			    	type: 'hbox',
			        defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
			    }
			},
	        items :[{
		       // fields
		    },{
			
			},{
			
		    }]
	    },{ 
	    	xtype:'fieldset',
	        title: '<?php i18n('Calendar Settings'); ?>',
	        collapsible: true,
	        defaultType: 'textfield',
	        layout: 'anchor',
	        defaults: {
				labelWidth: 89,
			    anchor: '100%',
			    layout: {
			    	type: 'hbox',
			        defaultMargins: {top: 0, right: 5, bottom: 0, left: 0}
			    }
			},
	        items :[{
		    	// fields
		    },{
			
			},{
			
		    }]  
		}],
		dockedItems: [{
	  	  	xtype: 'toolbar',
		  	dock: 'top',
		  	items: [{
			    text      	: '<?php i18n("Save"); ?>',
			    iconCls   	: 'save',
			    id        	: 'cmdSave',
			    disabled	: true,
			    handler   : function(){
				
			    }
		  	}]
		}]
	});

	
	//***********************************************************************************
	// Top Render Panel 
	// This Panel needs only 3 arguments...
	// PageTitle 	- Title of the current page
	// PageLayout 	- default 'fit', define this argument if using other than the default value
	// PageBody 	- List of items to display [form1, grid1, grid2]
	//***********************************************************************************
    new Ext.create('Ext.mitos.RenderPanel', {
        pageTitle: '<?php i18n('My Settings'); ?>',
        pageBody: [uSettingsForm]
    });
}); // End ExtJS
</script>




