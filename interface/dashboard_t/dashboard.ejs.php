<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../library/ext-4.0.1/resources/css/ext-all.css" />
    <link rel="stylesheet" type="text/css" href="portal.css" />
    <script type="text/javascript" src="../../library/ext-4.0.1/builds/ext-core.js"></script>
    <!-- shared example code -->
    <script type="text/javascript" src="../../library/ext-4.0.1/examples/shared/examples.js"></script>
    <script type="text/javascript" src="classes.js"></script>
    <script type="text/javascript" src="portal.js"></script>
    <script type="text/javascript">
        Ext.Loader.setPath('Ext.app', 'classes');
        Ext.require([
            'Ext.layout.container.*',
            'Ext.resizer.Splitter',
            'Ext.fx.target.Element',
            'Ext.fx.target.Component',
            'Ext.window.Window',
            'Ext.app.Portlet',
            'Ext.app.PortalColumn',
            'Ext.app.PortalPanel',
            'Ext.app.Portlet',
            'Ext.app.PortalDropZone',
            'Ext.app.GridPortlet',
            'Ext.app.ChartPortlet'
        ]);
        Ext.onReady(function(){
            Ext.create('Ext.app.Portal');
        });
    </script>
</head>
<body>
    <span id="app-msg" style="display:none;"></span>
</body>
</html>