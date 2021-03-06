<?php 
//******************************************************************************
// layout.ejs.php
// Description: Layout Screen Panel
// v0.0.1
// 
// Author: GI Technologies, 2011
// Modified: n/a
// 
// MitosEHR (Eletronic Health Records) 2011
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
delete Ext.mitos.Panel;
Ext.onReady(function() {
	Ext.define('Ext.mitos.Panel',{
		extend:'Ext.panel.Panel',
		uses:[
			'Ext.mitos.CRUDStore',
			'Ext.mitos.GridPanel',
			'Ext.mitos.RenderPanel',
			'Ext.mitos.SaveCancelWindow'
		],
		initComponent: function(){
		
            /** @namespace Ext.QuickTips */
            Ext.QuickTips.init();
            
            var panel = this;
			var form_id = 'Demographics'; 	// Stores the current form group selected by the user.
			var rowPos; 					// Stores the current Grid Row Position (int)
			var currRec; 					// A stored current record selected by the user.

			// *************************************************************************************
			// Layout Record Structure
			// *************************************************************************************
			Ext.define('layoutModel', {
                extend: 'Ext.data.Model',
                fields: [
					{name: 'item_id',			type: 'int'},
					{name: 'form_id',			type: 'string'},
					{name: 'field_id',			type: 'string'},
					{name: 'group_name',		type: 'string'},
					{name: 'listDesc',			type: 'string'},
					{name: 'title',				type: 'string'},
					{name: 'seq',				type: 'int'},
					{name: 'data_type',			type: 'string'},
					{name: 'uor',				type: 'string'},
					{name: 'fld_length',		type: 'string'},
					{name: 'max_length',		type: 'string'},
					{name: 'list_id',			type: 'string'},
					{name: 'titlecols',			type: 'string'},
					{name: 'datacols',			type: 'string'},
					{name: 'default_value',		type: 'string'},
					{name: 'edit_options',		type: 'string'},
					{name: 'description',		type: 'string'},
					{name: 'group_order',		type: 'string'}
				]
			});

            panel.LayoutStore = Ext.create('Ext.data.TreeStore', {
                model: 'layoutModel',
                proxy: {
                    type: 'ajax',
                    //the store will get the content from the .json file
                    api:{
                       	read		: 'app/administration/layout/data_read2.ejs.php',
                        create		: 'app/administration/layout/data_create.ejs.php',
                        update      : 'app/administration/layout/data_update.ejs.php',
                        destroy 	: 'app/administration/layout/data_destroy.ejs.php'
                    }
                },
                folderSort: true
            });

			// *************************************************************************************
			// Form List Record Structure & Store
			// *************************************************************************************
			panel.formlistStore = Ext.create('Ext.mitos.CRUDStore',{
				fields: [
					{name: 'id',		type: 'string'},
					{name: 'form_id',	type: 'string'}
				],
				model 		:'formlistModel',
				idProperty 	:'id',
				read		: 'app/administration/layout/component_data.ejs.php',
				extraParams	: {"task": "form_list"}
			});
	
			// *************************************************************************************
			// Form List Record Structure & Store
			// *************************************************************************************
			panel.uorStore = Ext.create('Ext.mitos.CRUDStore',{
				fields: [
					{name: 'id',	type: 'string'},
					{name: 'uor',	type: 'string'}
				],
				model 		:'uorModel',
				idProperty 	:'id',
				read		: 'app/administration/layout/component_data.ejs.php',
				extraParams	: {"task": "uor"}
			});
	
			// *************************************************************************************
			// Data Types Record Structure & Store
			// *************************************************************************************
			panel.datatypesStore = Ext.create('Ext.mitos.CRUDStore',{
				fields: [
					{name: 'id',	type: 'string'},
					{name: 'type',	type: 'string'}
				],
				model 		:'typeModel',
				idProperty 	:'id',
				read		: 'app/administration/layout/component_data.ejs.php',
				extraParams	: {"task": "data_types"}
			});
	
			// *************************************************************************************
			// List Options Record Structure & Store
			// *************************************************************************************
			panel.listoptionStore = Ext.create('Ext.mitos.CRUDStore',{
				fields: [
					{name: 'id',		type: 'int'},
					{name: 'title',		type: 'string'},
					{name: 'list_id',	type: 'string'},
					{name: 'option_id',	type: 'string'}
				],
				model 		:'listoptionModel',
				idProperty 	:'id',
				read		: 'app/administration/layout/component_data.ejs.php',
				extraParams	: {"task": "lists"}
			});
	
			// *************************************************************************************
			// List Options Record Structure & Store
			// *************************************************************************************
			panel.whereStore = Ext.create('Ext.mitos.CRUDStore',{
				fields: [
					{name: 'group_name',type: 'string'}
				],
				model 		:'whereModel',
				idProperty 	:'group_name',
				read		: 'app/administration/layout/component_data.ejs.php',
				extraParams	: {"task": "groups", "form_id": form_id}
			});
	
			// *************************************************************************************
			// User form
			// *************************************************************************************
    		panel.whereForm = new Ext.create('Ext.mitos.FormPanel', {
        		fieldDefaults: { msgTarget: 'side', labelWidth: 100 },
        		defaults: {
            		anchor: '100%'
        		},
        		items: [{
                    xtype:'textfield',
                    fieldLabel:'Title/Lable'
                },{
                    xtype:'textfield',
                    fieldLabel:'Type'

                },{
                    xtype:'textfield',
                    fieldLabel:'name'

                },{
                    xtype:'checkboxfield',
                    fieldLabel:'Required'

                },{
                    xtype:'textfield',
                    fieldLabel:'Title/Lable'

                },{
					xtype			: 'combo',
					name			: 'where',
					displayField	: 'group_name',
					valueField		: 'group_name', 
					editable		: false, 
					store			: panel.whereStore, 
					queryMode		: 'local'
        		},{
                    
                }]
    		});
	
			// *************************************************************************************
			// window - Add Field Window
			// *************************************************************************************
			panel.winAddField = Ext.create('Ext.mitos.Window', {
				title		: '<?php i18n("Select a group to add the field."); ?>',
				width		: 450,
				items		: [ panel.whereForm ],
				buttons:[{
					text		:'<?php i18n("Add"); ?>',
					name		: 'cmdSave',
					id			: 'cmdSave',
					iconCls		: 'save',
            		handler: function(){
						currRec = new layoutModel();								// Create a new record object based from the model
						var fieldValues = panel.whereForm.getForm().getValues();	// Get the values from the FORM
						currRec.set('group_name', fieldValues['where']);			// Set the hidden values of the record
						currRec.set('form_id', form_id);							// Set the hidden values of the record
						currRec.set('seq', 1);										// Set the seq value
						currRec.set('titlecols', 0);
						currRec.set('datacols', 0);
						panel.LayoutStore.insert(0, currRec );						// Add the new record to the STORE
						panel.winAddField.hide();									// Finally hide the dialog window
						panel.rowEditing.startEdit(currRec, 0);						// inject the record to the GRID and start editing
					}
				},'-',{
					text:'<?php i18n("Close"); ?>',
					iconCls: 'delete',
		            handler: function(){
            			panel.winAddField.hide();
		            }
				}]
			});
	
			// *************************************************************************************
			// Grouping - group_name
			// *************************************************************************************
    		panel.groupingLayout = Ext.create('Ext.grid.feature.Grouping',{
    			enableNoGroups: false,
        		groupHeaderTpl: '<?php i18n("Group"); ?>: {name} ({rows.length} <?php i18n("Field"); ?>{[values.rows.length > 1 ? "s" : ""]})'
    		});
    


			// *************************************************************************************
			// Layout fields Grid Panel
			// *************************************************************************************
			panel.layoutGrid = Ext.create('Ext.tree.Panel', {
				store	: panel.LayoutStore,
        		region	: 'center',
   	    		border	: true,
  	    		frame	: true,
  	    		sortable: false,
                collapsible: true,
                useArrows: true,
                rootVisible: false,
  	    		multiSelect: true,
                singleExpand: true,
   	    		title	: '<?php i18n("Field editor"); ?> (<?php i18n("Demographics"); ?>)',
        		columns	: [
					{
                        xtype       : 'treecolumn',
						name		: 'seq',
						text     	: '<?php i18n("Label/Title"); ?>',
						sortable 	: false,
						dataIndex	: 'title',
						width		: 220
		            },
					{
						text     	: '<?php i18n("Data Type"); ?>',
						sortable 	: false,
						dataIndex	: 'data_type',
						width		: 120,
						align		: 'left'
		            },
					{
						text     	: '<?php i18n("Description"); ?>',
						sortable 	: false,
						dataIndex	: 'description',
						flex		: 1,
						align		: 'left',
		            	editor		: {
        		    		name: 'description',
	            		    xtype: 'textfield'
        		    	}
		            },
					{ text: 'item_id', hidden: true, dataIndex: 'item_id' },
					{ text: 'form_id', hidden: true, dataIndex: 'form_id' }
				],
				listeners: {
					itemclick: {
            			fn: function(DataView, record, item, rowIndex, e){ 
		            		panel.rowEditing.cancelEdit();
        		    		currRec = panel.LayoutStore.getAt(rowIndex);
            				rowPos = rowIndex;
            				panel.cmdDelete.enable();
            			}
					}
				},
				dockedItems: [{
					xtype: 'toolbar',
					dock: 'top',
					items: [
						panel.cmdDelete = new Ext.create('Ext.Button', {
							name: 'cmdAddField',
							text: '<?php i18n("Add field"); ?>',
							iconCls: 'icoAddRecord',
							handler: function(){
								panel.winAddField.show();
							}
						})
					,'-',
						panel.cmdDelete = new Ext.create('Ext.Button', {
							name: 'cmdDelField',
							text: '<?php i18n("Delete field"); ?>',
							iconCls: 'delete',
							disabled: true,
							handler: function(){
								panel.rowEditing.cancelEdit();
								Ext.Msg.show({
									title: '<?php i18n("Please confirm..."); ?>', 
									icon: Ext.MessageBox.QUESTION,
									msg:'<?php i18n("Are you sure to delete this field?<br>WARNING: This will also detele the field and data on the table."); ?>',
									buttons: Ext.Msg.YESNO,
									fn:function(btn,msgGrid){
										if(btn=='yes'){
											panel.LayoutStore.remove( currRec );
											panel.LayoutStore.sync();
											panel.LayoutStore.load();
						    		    }
									}
								});
							}
						})
					]
				}]
		    }); // END LayoutGrid Grid
    
    		// *************************************************************************************
    		// Panel to choose Layouts
    		// *************************************************************************************
    		panel.chooseGrid = Ext.create('Ext.grid.Panel', {
				store		: panel.formlistStore,
				region		: 'east',
				border		: true,
				frame		: true,
				title		: '<?php i18n("Form list"); ?>',
				width		: 100,
				collapsible	: true,
		        columns		: [
					{
						hidden		: true,
						sortable 	: true,
						dataIndex	: 'id'
            		},
					{
						text     : '<?php i18n("Name"); ?>',
						flex     : 1,
						sortable : true,
						dataIndex: 'form_id'
        		    }
				],
				listeners: {
					itemclick: {
        		    	fn: function(DataView, record, item, rowIndex, e){
            				panel.rowEditing.cancelEdit();
							form_id = record.get('form_id');
							panel.LayoutStore.load({params:{form_id: form_id }});
							panel.whereStore.load({params:{task: 'groups', form_id: form_id} });
							panel.layoutGrid.setTitle('<?php i18n("Field editor"); ?> ('+form_id+')');
        		    	}
					}
				}
		    }); // END LayoutChoose
    
			//***********************************************************************************
			// Top Render Panel 
			// This Panel needs only 3 arguments...
			// PageTigle 	- Title of the current page
			// PageLayout 	- default 'fit', define this argument if using other than the default value
			// PageBody 	- List of items to display [foem1, grid1, grid2]
			//***********************************************************************************
    		new Ext.create('Ext.mitos.RenderPanel', {
        		pageTitle: '<?php i18n("Layout Form Editor"); ?>',
        		pageLayout: 'border',
        		pageBody: [panel.layoutGrid, panel.chooseGrid]
    		});
			panel.callParent(arguments);
			
		} // end of initComponent
		
	}); //ens LayoutPanel class
    Ext.create('Ext.mitos.Panel');
    
}); // End ExtJS
</script>