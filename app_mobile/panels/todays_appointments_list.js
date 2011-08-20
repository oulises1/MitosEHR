
Ext.regModel('CalendarEventsModel', {
    fields: [
        {name: 'id', 			type: 'int'},
        {name: 'pid', 			type: 'int'},
        {name: 'group', 	type: 'string'},
        {name: 'fullname', 	type: 'string'}
    ]
});

demos.CalendarEventsStore  = new Ext.data.Store({
    model: 'CalendarEventsModel',
    sorters: [
        {
            property : 'group',
            direction: 'DESC'
        }
    ],
    getGroupString : function(record) {
        return record.get('group');
    },
    proxy: {
        type: 'ajax',
        url : 'app_mobile/panels/data/calendar_events.json.php',
        reader: {
            type: 'json',
            root: 'row'
        }
    },
    autoLoad: true
});


demos.CalendarEvents = new Ext.Panel ({
    title: 'Todays Appointments List',
    layout: 'fit',
    cls: 'demo-list',
    items: [{
        width: Ext.is.Phone ? undefined : 300,
        height: Ext.is.Phone ? undefined : 500,
        xtype: 'list',
        onItemDisclosure: function(record, btn, index) {
            Ext.Msg.alert('Tap', 'Disclose more info for ' + record.get('fullname'), Ext.emptyFn);
        },
        store: demos.CalendarEventsStore, //getRange(0, 9),
        itemTpl: '<div class="contact"><strong>{fullname}</strong> {lastName}</div>',
        grouped: true
    }]
});