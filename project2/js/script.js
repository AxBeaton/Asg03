$(function  (){

     var printArray = new Array();
       $('#myButton').on('click',	function	(e)	{
          
          $.get("json/printRules.json", function(data){
              var numberOfImage= $('#printTable img' ).length;
              
              for (let i=0;i<numberOfImage;i++){
                printArray = data;
                var sizes='#sizeSelect'+i;
                var stocks='#paperSelect'+i;
                var frames='#frameSelect'+i;
                var quantities='#quantity'+i;
                var totalColumn='totalColumn' +i;
            
                //Insert size drop down and set attribute value to size id
                var sel = $(sizes);
                var temp = $(sizes +' option');
                if(temp.size()==0){
                    for(let i=0; i<printArray.sizes.length; i++){
                        sel.append($("<option>").attr('value',printArray.sizes[i].id).text(printArray.sizes[i].name));
                    }
                }
              
                //Insert paper drop down and set attribute to paper id  
                temp = $(stocks + ' option')
                var sel2 = $(stocks);
                if(temp.size()==0){
                    for(let i=0; i<printArray.stock.length; i++){
                        sel2.append($("<option>").attr('value',printArray.stock[i].id).text(printArray.stock[i].name));
                    }
                }
            
                var sship = $('#standardShip');
                sship.attr('value', printArray.shipping[0].id);
                var eship = $('#expressShip');
                eship.attr('value', printArray.shipping[1].id);
            
            
                //Insert frame drop down and set attribute to frame id
                var sel3 = $(frames);
                if(temp.size()==0){
                    for(let i=0; i<printArray.frame.length; i++){
                        sel3.append($("<option>").attr('value',printArray.frame[i].id).text(printArray.frame[i].name));
                    }
                }
            
     
     
                //Calculate the cost for the stock and the size
                if(($(sizes).val()=='0' || $(sizes).val()=='1') && $(stocks).val()=='0'){
                    var sizeCost=printArray.sizes[$(sizes).val()].cost;
                    var paperCost=printArray.stock[ $(stocks).val()].small_cost;
                }
                
                if(($(sizes).val()=='2' || $(sizes).val()=='3') && $(stocks).val()=='0'){
                    var sizeCost=printArray.sizes[$(sizes).val()].cost;
                    var paperCost=printArray.stock[ $(stocks).val()].large_cost;
                }
                
                if(($(sizes).val()=='0' || $(sizes).val()=='1') && $(stocks).val()=='1'){
                    var sizeCost=printArray.sizes[$(sizes).val()].cost;
                    var paperCost=printArray.stock[ $(stocks).val()].small_cost;
                }
                
                if(($(sizes).val()=='2' || $(sizes).val()=='3') && $(stocks).val()=='1'){
                    var sizeCost=printArray.sizes[$(sizes).val()].cost;
                    var paperCost=printArray.stock[ $(stocks).val()].large_cost;
                }
                
                if(($(sizes).val()=='0' || $(sizes).val()=='1') && $(stocks).val()=='2'){
                    var sizeCost=printArray.sizes[$(sizes).val()].cost;
                    var paperCost=printArray.stock[ $(stocks).val()].small_cost;
                }
                
                if(($(sizes).val()=='2' || $(sizes).val()=='3') && $(stocks).val()=='2'){
                    var sizeCost=printArray.sizes[$(sizes).val()].cost;
                    var paperCost=printArray.stock[ $(stocks).val()].large_cost;
                }
        
        
        
                //Calculate the cost for the frame
                if($(sizes).val()=='0'  && (($(frames).val()=='0') || $(frames).val()=='1'
                || $(frames).val()=='2' || $(frames).val()=='3' || $(frames).val()=='4')){ 
                    var frameCost=printArray.frame[ $(frames).val()].costs[0];
                }
        
                if($(sizes).val()=='1'  && (($(frames).val()=='0') || $(frames).val()=='1'
                || $(frames).val()=='2' || $(frames).val()=='3' || $(frames).val()=='4')){ 
                    var frameCost=printArray.frame[ $(frames).val()].costs[1];
                }      
        
                if($(sizes).val()=='2'  && (($(frames).val()=='0') || $(frames).val()=='1'
                || $(frames).val()=='2' || $(frames).val()=='3' || $(frames).val()=='4')){ 
                    var frameCost=printArray.frame[ $(frames).val()].costs[2];
                }       
        
                if($(sizes).val()=='3'  && (($(frames).val()=='0') || $(frames).val()=='1'
                || $(frames).val()=='2' || $(frames).val()=='3' || $(frames).val()=='4')){ 
                    var frameCost=printArray.frame[ $(frames).val()].costs[3];
                }
                
                if($(sizes).val()=='4'  && (($(frames).val()=='0') || $(frames).val()=='1'
                || $(frames).val()=='2' || $(frames).val()=='3' || $(frames).val()=='4')){ 
                    var frameCost=printArray.frame[ $(frames).val()].costs[4];
                }
                
                //Calculate the total based on quantity
                var quant=$(quantities).val();
                var total=quant*(sizeCost+paperCost+frameCost);
                
                document.getElementById(totalColumn).innerHTML="$"+total;
              
                //Calculate shipping cost
              }
                if ($(frames).val=='0' && $(sship).is(':checked'))
                {
                    var sCost=printArray.shipping[0].rules[0];
                    document.getElementById('shippingCost').innerHTML= "$"+sCost;
                } else if ($(frames).val==0 && $(eship).is(':checked)')){
                    var eCost=printArray.shipping[1].rules[0];
                    document.getElementById('shippingCost').innerHTML="$"+eCost;
                }
            });
       });
  
       //event listeners for the print favourite images
       $("#printTable").on("mouseover", function(e) {
          if(e.target && e.target.nodeName.toLowerCase() === "img") {
              var src =$(e.target).attr("src");
              var imageSrc = src.split("/", 3);
              var hoverImg = "images/square-medium/" + imageSrc[2];
              var preview = $("<div></div>");
              preview.attr("id", "preview");
              var image = $("<img></img>");
              image.attr("src", hoverImg);
              preview.append(image);
              var numberOfImage= $('#printTable img' ).length;
              var temp = $(e.target).parent();
              var triggerImg = temp.attr("id");
              for (let x = 0; x < numberOfImage; x++) {
                  
                  var column= '#frameColumn' + x;
                  var imgColumn = 'imageColumn' + x;
                  console.log(column);
                  var select = $(column + " option:selected");
                  if (triggerImg == imgColumn) {
                  if ($(select).val() != 0) {
                      var id = $(select).val();
                      for(let i = 0; i < printArray.frame.length; i++) {
                          if (id == printArray.frame[i].id) {
                              preview.css("borderStyle", "solid");
                              preview.css("borderColor", printArray.frame[i].color);
                              preview.css("borderWidth", printArray.frame[i].border);
                              break;
                      }
                  }
                }
                else {
                    preview.css("borderStyle", "");
                    preview.css("borderColor", "");
                    preview.css("borderWidth", "");
                }
                  }
              }
              var leftCords = e.pageX + 25;
              var topCords = e.pageY - 25;
              preview.css("left", leftCords);
              preview.css("top", topCords);
              $("#preview").css("position", "absolute");
              $('#myModal').append(preview);
          } 
       });
       
       $("#printTable").on("mouseout", function(e) {
          if(e.target && e.target.nodeName.toLowerCase() === "img") {
              $("#preview").remove();
          } 
       });
       
       $("#printTable").on("mousemove", function(e) {
           if(e.target && e.target.nodeName.toLowerCase() === "img") {
           var leftCords = e.pageX + 25;
           var topCords = e.pageY - 25;
           $("#preview").css("left", leftCords);
           $("#preview").css("top", topCords);
           $("#preview").css("position", "absolute");
           $('#myModal').append($("#preview"));
           }
       });
       
       
       
       
       
       
       
       $(document).ready( function() { 
           $.get("json/printRules.json", function(data){
               printArray=data;
       var numberOrders= $('#ordersTable img' ).length;
              for (let i=0;i<numberOrders;i++){
              var o_sizes='#orderSize'+i;
              var o_stocks='#orderPaper'+i;
              var o_frames='#orderFrame'+i;
              
        
          
              var temp = $(o_sizes).attr("title");
               for(let j=0; j<printArray.sizes.length; j++){
                   if(temp==printArray.sizes[j].id){
                       $(o_sizes).text(printArray.sizes[j].name);
                       break;
                   }}
                   temp = $(o_stocks).attr("title");
               for(let j=0; j<printArray.stock.length; j++){
                   if(temp==printArray.stock[j].id){
                       $(o_stocks).text(printArray.stock[j].name);
                       break;
                   }}
                   temp = $(o_frames).attr("title");
               for(let j=0; j<printArray.frame.length; j++){
                   if(temp==printArray.frame[j].id){
                       $(o_frames).text(printArray.frame[j].name);
                       break;
                   }}
                   
                                 }   
              var o_ship='#shipping';
              var temp = $(o_ship).attr("title");
               for(let j=0; j<printArray.shipping.length; j++){
                   if(temp==printArray.shipping[j].id){
                       $(o_ship).text(printArray.shipping[j].name);
                       break;
                   }}
       });
       });
       
});


    