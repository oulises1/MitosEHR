
Ext.regModel('UserModel', {
    fields: [
        {name: 'id', 			type: 'int'},
        {name: 'fname', 	type: 'string'},
        {name: 'lname', 	type: 'string'},
        {name: 'mname', 	type: 'string'}
    ]
});

demos.UserStore  = new Ext.data.Store({
    model: 'UserModel',

    proxy: {
        type: 'ajax',
        url : 'app_mobile/panels/data/my_account.json.php',
        reader: {
            type: 'json',
            root: 'row'
        }
    },
    autoLoad: true
});


demos.UserStore.on('load',function(){
    var rec = demos.UserStore.getAt(0); // get the record from the store
    demos.MyAccount.load(rec);
});



demos.MyAccount = new Ext.form.FormPanel({
        title: 'Basic',
        xtype: 'form',
        scroll: 'vertical',
        items: [{
            xtype: 'fieldset',
            title: 'Personal Info',
            defaults: {
                // labelAlign: 'right'
                labelWidth: '35%'
            },
            items: [{
                xtype: 'textfield',
                disabled: true,
                name: 'fname',
                label: 'First'
            }, {

                xtype: 'textfield',
                disabled: true,
                name: 'mname',
                label: 'Middle'
            }, {

                xtype: 'textfield',
                disabled: true,
                name: 'lname',
                label: 'Last'
            }]
        }, {
            xtype: 'fieldset',
            title: 'Change Password',
            defaults: {
                xtype: 'passwordfield',
                labelWidth: '35%'
            },
            instructions: '* Required fields',
            items: [{
                name: 'password',
                label: 'Current',
                required: true,
                useClearIcon: true

            }, {
                name: 'password',
                label: 'New',
                required: true,
                useClearIcon: true
            }, {
                name: 'password',
                label: 'Re-type',
                required: true,
                useClearIcon: true
            }]
        }, {
            layout: 'vbox',
           
            items: [ {
                xtype: 'button',
               flex: 1,
                style: 'margin: .5em;',
                text: 'Save New Password',
                ui: 'confirm',
                handler: function(){

                    
                }


            }]
        }]
    
});



// if (Ext.is.Android) {
//     demos.Forms.insert(0, {
//         xtype: 'component',
//         styleHtmlContent: true,
//         html: '<span style="color: red">Forms on Android are currently under development. We are working hard to improve this in upcoming releases.</span>'
//     });
// }