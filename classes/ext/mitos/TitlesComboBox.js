Ext.define('Ext.mitos.TitlesComboBox',{
	extend      : 'Ext.form.ComboBox',
    alias       : 'mitos.titlescombobox',
    width       : 50,
    name        : 'title',
    editable    : false,
    displayField: 'title',
    valueField  : 'option_id',
    queryMode   : 'local',
    initComponent: function(){	
    	var me = this;

    	// *************************************************************************************
		// Structure, data for Types
		// AJAX -> component_data.ejs.php
		// *************************************************************************************
		if (!Ext.ModelManager.isRegistered('Titles')){
		Ext.define("Titles", {extend: "Ext.data.Model", fields: [
			{name: 'option_id', type: 'string'},
		    {name: 'title', type: 'string'}
		],
			idProperty: 'option_id'
		});
		}
		me.storeTypes = new Ext.data.Store({
			model		: 'Titles',
			proxy		: {
				type		: 'ajax',
				url			: 'lib/layoutEngine/listOptions.json.php',
				extraParams	: {"filter": "titles"},
				reader	: {
					type			: 'json',
					idProperty		: 'option_id',
					totalProperty	: 'totals',
					root			: 'row'
				}
			},
			autoLoad: true
		}); // end storeTypes
			

    	Ext.apply(this, {
    		store: me.storeTypes
		});
		me.callParent();
	} // end initComponent
});