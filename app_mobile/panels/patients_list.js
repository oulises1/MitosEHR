Ext.regModel('Patient', {
    fields: [
        {name: 'id', 			type: 'int'},
        {name: 'pid', 			type: 'int'},
        {name: 'pubpid', 		type: 'int'},
        {name: 'fname', 	type: 'string'},
        {name: 'lname', 	type: 'string'},
        {name: 'mname', 	type: 'string'},
        {name: 'DOB', 	type: 'string'},
        {name: 'ss', 	type: 'string'},
        {name: 'fullname', 	type: 'string'}
    ]
});

demos.ListStore  = new Ext.data.Store({
    model: 'Patient',
    sorters: 'fullname',
    getGroupString : function(record) {
        return record.get('fullname')[0];
    },
    proxy: {
        type: 'ajax',
        url : 'app_mobile/panels/data/patients_list.json.php',
        reader: {
            type: 'json',
            root: 'row'
        }
    },
    autoLoad: true
});

demos.PatientsList = new Ext.Panel ({
    layout: 'fit',
    cls: 'demo-list',
    items: [{
        width: Ext.is.Phone ? undefined : 300,
        height: 500,
        xtype: 'list',
        store: demos.ListStore,
        itemTpl: '<div class="contact"><strong>{fullname}</strong> ( {pid} )</div>',
        grouped: true,
        indexBar: true
    }]
});