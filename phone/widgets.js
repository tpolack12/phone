$(document).on("click", ".dropdown-menu li a", function($this) {
   $(this).parents(".dir-search-widget").find('.dropdown-toggle').html($(this).text() + ' <span class="caret"></span>');
   $(this).parents(".dir-search-widget").find('.dropdown-toggle').val($(this).data('value'));
});

$(document).on("click", ".btn-search", function($this) {
   var location=$(this).parents(".dir-search-widget").find('.dropdown-toggle').text();
   var searchtext=$(this).parents(".dir-search-widget").find('.search-data').val();

   $.ajax({
      method: "POST",
      url: "ajax/directory.php",
      data: { location: location, text: searchtext },
      dataType: 'html',
      success: function(data) {
              //alert(data);
              $('.dir-search-results-container').html(data);
              //elem.replaceWith(data);
      }
   });
});

$(document).on("input", ".search-data", function($this){
      var location=$(this).parents(".dir-search-widget").find('.dropdown-toggle').text();
      var searchtext=$(this).parents(".dir-search-widget").find('.search-data').val();

    $.ajax({
       method: "POST",
       url: "ajax/directory.php",
       data: { location: location, text: searchtext },
       dataType: 'html',
       success: function(data) {
                //alert(data);
                $('.dir-search-results-container').html(data);
                //elem.replaceWith(data);
       }
    });
});

var dirSearch="<div class='dir-search-widget'><div class='dir-search-widget-selector'><span class='label label-default'>Directory Search</span><p /><div class='input-group directory-search'><div class='input-group-btn'><button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Select Location <span class='caret'></span></button><ul class='dropdown-menu'><li><a href='#' data-value='Florida'>Florida</a></li><li><a href='#' data-value='Jamaica'>Jamaica</a></li><li><a href='#' data-value='DID'>DID</a></li><!----- add php code here for admin search <li role='separator' class='divider'></li><li><a href='#'>Separated link</a></li>------></ul></div><input type='text' class='form-control search-data' aria-label='...'><div class='input-group-btn'><button type='button' class='btn btn-default btn-search'>Search</button></div></div></div><hr><div class='dir-search-results-container'><!---- search results go here ----></div></div></div></div>";

//------------------------------

var chart;

function requestData() {
var counter=0;
     $.ajax({
        url:'stations.php',
	dataType:'json',
        success: function(point) {
	while(chart.series.length > 0) {chart.series[0].remove(true)};
	var series = chart.series;

	var cData=[];
	var Total=[]; var InActive=[]; var Active=[]; var TodayUse=[];
        $.each(point, function(key, value) {	     
	   cData.push(key);
	   var aData = $.map(value, function(el) { return el });			     	
		$.each(value, function(i, j) {
			var dVar = i;
			window['var'+dVar]=j
        	});
	   Total.push(varTotal);
		for(var i=0; i<Total.length; i++) { Total[i] = parseInt(Total[i], 10); }
	   InActive.push(varInActive);
		for(var i=0; i<InActive.length; i++) { InActive[i] = parseInt(InActive[i], 10); }
	   Active.push(varActive);
		for(var i=0; i<Active.length; i++) { Active[i] = parseInt(Active[i], 10); }
	   TodayUse.push(varTodayUse);
		for(var i=0; i<TodayUse.length; i++) { TodayUse[i] = parseInt(TodayUse[i], 10); }

	});
	chart.xAxis[0].setCategories(cData);

        chart.addSeries({
               name: "Total",
               data: Total
        });
        chart.addSeries({
               name: "InActive",
               data: InActive
        });
        chart.addSeries({
               name: "Active",
               data: Active
        });
        chart.addSeries({
               name: "TodayUse",
               data: TodayUse
        });

	console.log(chart.series.length);
        // call it again after one second
        setTimeout(requestData, 12000000);    
        },
        cache: false
    });
};

var dispChart = function(dispElem) {
	chart = new Highcharts.Chart({
        	chart: {
            		type: 'bar',
            		renderTo: dispElem,
			events: {
                		load: requestData
            		}
        	},
		title: {
            		text: 'Station Usage (Refreshed 20 mins)'
        	},
        
		xAxis: {
            		title: {
                		text: null
            		}
        	},
        	yAxis: {
            		min: 0,
            		title: {
                		text: 'Number of Stations',
                		align: 'high'
            		},
            		labels: {
                		overflow: 'justify'
            		}
        	},
		plotOptions: {
            		bar: {
                		borderWidth: 4 ,
				padding: 0,
				allowOverlap: 1,
                		dataLabels: {
                    			enabled: false,
                    			format: '{y:.f}'
                		}
            		}
        	},
		legend: {
            		layout: 'vertical',
            		align: 'right',
            		verticalAlign: 'top',
            		x: 5,
            		y: 200,
            		floating: true,
            		borderWidth: 1,
            		backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            		shadow: true
        	},
        	series: [{
            		name: 'Random data',
            		data: []
        	}]
	});        
};

//------------------------------


