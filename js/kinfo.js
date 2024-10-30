var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
var eventer = window[eventMethod];
var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

// Listen to message from child window to adjust the height once content is loaded

eventer(messageEvent, function (e) {
    if (JSON.parse(e.data)) {
        var data = JSON.parse(e.data);                
        // Old code for compatibility, no placement definition                

        if (data.type == 'positions') {            
            document.getElementById('kinfo-iframe-widget-positions-' + data.accountId).style.height = data.height + 'px';
            var iframeWidth = document.getElementById('kinfo-iframe-widget-positions-' + data.accountId).width;            
            document.getElementById('kinfo-iframe-widget-positions-' + data.accountId + "-link").style.height = data.height + 'px';
            document.getElementById('kinfo-iframe-widget-positions-' + data.accountId + "-link").style.width= iframeWidth + 'px';
        }
        if (data.type == 'performance') {
            document.getElementById('kinfo-iframe-widget-performance-' + data.accountId).style.height = data.height + 'px';
            var iframeWidth = document.getElementById('kinfo-iframe-widget-performance-' + data.accountId).width;
            
            document.getElementById('kinfo-iframe-widget-performance-' + data.accountId + "-link").style.height = data.height + 'px';
            document.getElementById('kinfo-iframe-widget-performance-' + data.accountId + "-link").style.width= iframeWidth + 'px';
        }
        
        if (data.type == 'positions-widget') {            
            document.getElementById('kinfo-iframe-widget-positions-' + data.accountId).style.height = data.height + 'px';
            var iframeWidth = document.getElementById('kinfo-iframe-widget-positions-' + data.accountId).width;            
            document.getElementById('kinfo-iframe-widget-positions-' + data.accountId + "-link").style.height = data.height + 'px';
            document.getElementById('kinfo-iframe-widget-positions-' + data.accountId + "-link").style.width= iframeWidth + 'px';
        }
        if (data.type == 'performance-widget') {
            document.getElementById('kinfo-iframe-widget-performance-' + data.accountId).style.height = data.height + 'px';
            var iframeWidth = document.getElementById('kinfo-iframe-widget-performance-' + data.accountId).width;
            
            document.getElementById('kinfo-iframe-widget-performance-' + data.accountId + "-link").style.height = data.height + 'px';
            document.getElementById('kinfo-iframe-widget-performance-' + data.accountId + "-link").style.width= iframeWidth + 'px';
        }
        
        if (data.type == 'positions-shortCode') {            
            document.getElementById('kinfo-iframe-shortcode-positions-' + data.accountId).style.height = data.height + 'px';
            var iframeWidth = document.getElementById('kinfo-iframe-shortcode-positions-' + data.accountId).width;            
            document.getElementById('kinfo-iframe-shortcode-positions-' + data.accountId + "-link").style.height = data.height + 'px';
            document.getElementById('kinfo-iframe-shortcode-positions-' + data.accountId + "-link").style.width= iframeWidth + 'px';
        }
        if (data.type == 'performance-shortCode') {
            document.getElementById('kinfo-iframe-shortcode-performance-' + data.accountId).style.height = data.height + 'px';
            var iframeWidth = document.getElementById('kinfo-iframe-shortcode-performance-' + data.accountId).width;
            
            document.getElementById('kinfo-iframe-shortcode-performance-' + data.accountId + "-link").style.height = data.height + 'px';
            document.getElementById('kinfo-iframe-shortcode-performance-' + data.accountId + "-link").style.width= iframeWidth + 'px';
        }
    }
    
}, false);
