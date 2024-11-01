jQuery(document).ready(function($){
  jQuery.widget( "custom.timelineColorsMenu", jQuery.ui.selectmenu, {
      _renderItem: function( ul, item ) {
        var li = jQuery( "<li>", { text: item.label } );
        var color = "#f2f2f2";

        if(item.element.attr( "data-color" )){
          color = item.element.attr( "data-color" );
        }
 
        if ( item.disabled ) {
          li.addClass( "ui-state-disabled" );
        }
  
        jQuery( "<span>", {
          style: 'background-color:'+color+';width: 20px;height: 20px;display: inline-block;vertical-align: middle;margin-right: 5px;'
          //"class": "ui-icon " + item.element.attr( "data-class" )
        }).prependTo( li );
 
        return li.appendTo( ul );
      }
    });
    //jQuery("#timeline-color").selectmenu();
    $( "#timeline-color" ).timelineColorsMenu().timelineColorsMenu( "menuWidget" ).addClass( "ui-menu-icons" );
});
