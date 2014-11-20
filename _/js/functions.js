// COLUMNIZER FROM https://github.com/weblinc/jquery-columnlist
(function($){$.fn.columnlist=function(options){function returnColumn(inc){return $('<li class="'+options.incrementClass+inc+" "+options["class"]+'"></li>')}return options=$.extend({},$.fn.columnlist.defaults,options),this.each(function(){var $list=$(this),size=options.size||$list.data("columnList")||1,$children=$list.children("li"),perColumn=Math.ceil($children.length/size),$column;for(var i=0;i<size;i++){$column=$("<ul />").appendTo(returnColumn(i));for(var j=0;j<perColumn;j++)$children.length>i*perColumn+j&&$column.append($children[i*perColumn+j]);$list.append($column.parent())}})},$.fn.columnlist.defaults={"class":"column-list",incrementClass:"column-list-"}})(jQuery)

jQuery(document).ready(function($) {
    
    $('ul.column-list-js').columnlist({
        size : 2,
        'class' : 'column-list',
        incrementClass : 'column-list-'
    });

     $('a:has(img)').addClass('imglink');

      $('#loginform input').focus(function() {
       $(this).prev('label').text('');
    });
     
    $('p').each(function() {
    var $this = $(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
    });

    // ADD CLASS TO FORMS FOR FUNCTION BELOW WHICH PUTS LABELS IN INPUTS

   // $("label").inFieldLabels();
    
     function adjustStyle(width) {
             width = $('body').innerWidth();
             if (width >= 601) {
     
                $("#header .mmcolumn").each(function() {
                        var $left = $(this);
                        var $right = $left.next();
                        $left.height('auto');
                        $right.height('auto');
                        var maxHeight = Math.max($left.height(), $right.height());
                        $left.height(maxHeight);
                        $right.height(maxHeight);
                         $('.site-title').fadeIn();
                });
       }
    }
    
     $(function() {
            $(window).load(function() {
                adjustStyle($(this).width());
               
            });
            
            $(window).resize(function() {
                adjustStyle($(this).width());
            });
        });
     
    
    
    // Create the dropdown base
    $("<select />").appendTo(".nav");
    
    // Create default option "Go to..."
    $("<option />", {
       "selected": "selected",
       "value"   : "",
       "text"    : "Go to..."
    }).appendTo(".nav  select");
    
    // Populate dropdown with menu items
    $(".nav .megaMenuContainer > ul > li > a").each(function() {
     var el = $(this);
     $("<option />", {
         "value"   : el.attr("href"),
         "text"    : el.text()
     }).appendTo(".nav select");
    });
    
    $(".nav select").change(function() {
      window.location = $(this).find("option:selected").val();
    });
    
    // PUT LABELS WITHIN INPUT FIELDS
    jQuery.fn.labelify = function(settings) {
      settings = jQuery.extend({
        text: "title",
        labelledClass: ""
      }, settings);
      var lookups = {
        title: function(input) {
          return $(input).attr("title");
        },
        label: function(input) {
          return $("label[for=" + input.id +"]").text();
        }
      };
      var lookup;
      var jQuery_labellified_elements = $(this);
      return $(this).each(function() {
        if (typeof settings.text === "string") {
          lookup = lookups[settings.text]; // what if not there?
        } else {
          lookup = settings.text; // what if not a fn?
        };
        // bail if lookup isn't a function or if it returns undefined
        if (typeof lookup !== "function") { return; }
        var lookupval = lookup(this);
        if (!lookupval) { return; }
    
        // need to strip newlines because the browser strips them
        // if you set textbox.value to a string containing them    
        $(this).data("label",lookup(this).replace(/\n/g,''));
        $(this).focus(function() {
          if (this.value === $(this).data("label")) {
            this.value = this.defaultValue;
            $(this).removeClass(settings.labelledClass);
          }
        }).blur(function(){
          if (this.value === this.defaultValue) {
            this.value = $(this).data("label");
            $(this).addClass(settings.labelledClass);
          }
        });
        
        var removeValuesOnExit = function() {
          jQuery_labellified_elements.each(function(){
            if (this.value === $(this).data("label")) {
              this.value = this.defaultValue;
              $(this).removeClass(settings.labelledClass);
            }
          })
        };
        
        $(this).parents("form").submit(removeValuesOnExit);
        $(window).unload(removeValuesOnExit);
        
        if (this.value !== this.defaultValue) {
          // user already started typing; don't overwrite their work!
          return;
        }
        // actually set the value
        this.value = $(this).data("label");
        $(this).addClass(settings.labelledClass);
    
      });
    };
    
});